<?php

namespace App\Http\Controllers\Tcp;

use App\Events\Chat;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tcp\StoreExamRequest;
use App\Http\Requests\Tcp\StoreResultRequest;
use App\Http\Requests\Tcp\StoreResultsRequest;
use App\Http\Resources\Tcp\ExamResultsResource;
use App\Http\Requests\Tcp\SendMessageRequest;
use App\Http\Requests\Tcp\SendFileRequest;
use App\Http\Resources\Tcp\MessagesResource;
use App\Http\Resources\Tcp\TeacherProgramResource;
use App\Http\Resources\Tcp\TeacherSubjectRegistrationResource;
use App\Models\Generated\Exam;
use App\Models\Generated\Result;
use App\Models\Generated\Message;
use App\Models\Generated\SubjectRegistration;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Upload;
use Illuminate\Support\Facades\Auth;

class TcpController extends Controller
{
    public function get_programs()
    {
        $teacher_id = Auth::id();
        $teacher = Teacher::findOrFail($teacher_id);
        return $this->Data(['programs' => TeacherProgramResource::collection($teacher->programs()->orderBy('start_at', 'asc')->get())->groupBy('day')]);
    }

    public function get_subject_registrations()
    {
        $teacher_id = Auth::id();
        $teacher = Teacher::findOrFail($teacher_id);
        return $this->Data(['subject_registrations' => TeacherSubjectRegistrationResource::collection($teacher->current_subject_registrations)]);
    }

    public function get_subject_registration(SubjectRegistration $subjectRegistration)
    {
        return $this->Data(['subject_registration' => new  TeacherSubjectRegistrationResource($subjectRegistration)]);
    }

    public function get_exam(Exam $exam)
    {
        return $this->Data(['exam' => new  ExamResultsResource($exam)]);
    }

    public function update_result(StoreResultRequest $request, Exam $exam)
    {
        $max_value = $exam->subject_registration->percentage;
        $validated = $request->validated();
        if ($validated['value'] > $max_value) {
            return $this->Error('the grade of the user must be smaller than ' . $max_value . '');
        }
        if (Student::findOrFail($validated['student_id'])->results->where('exam_id', $validated['exam_id'])->first()) {
            $result = Student::findOrFail($validated['student_id'])->results->where('exam_id', $validated['exam_id'])->first();
            $result->value = $validated['value'];
            $result->save();
            return $this->Success('Student Result Has been Updated successfully');
        } else {
            $result = new Result();
            $result->value = $validated['value'];
            $result->student_id = $validated['student_id'];
            $result->exam_id = $validated['exam_id'];
            $result->save();
            return $this->Success('Student Result Has been Updated successfully');
        }
    }

    public function update_results(StoreResultsRequest $request, Exam $exam)
    {
        $max_value = $exam->subject_registration->percentage;
        $validated = $request->validated();
        foreach ($validated['results'] as $result) {
            if ($result['value'] > $max_value) {
                return $this->Error(Student::findOrFail($result['student_id'])->name . ' grade is grater than ' . $max_value);
            }
            if (Student::findOrFail($result['student_id'])->results->where('exam_id', $validated['exam_id'])->first()) {
                $student_result = Student::findOrFail($result['student_id'])->results->where('exam_id', $validated['exam_id'])->first();
                $student_result->value = $result['value'];
                $student_result->save();
            } else {
                $newResult = new Result();
                $newResult->value = $result['value'];
                $newResult->student_id = $result['student_id'];
                $newResult->exam_id = $validated['exam_id'];
                $newResult->save();
            }
        }
        return $this->Success('Student Result Has been Updated successfully');
    }

    public function create_exam(StoreExamRequest $examRequest)
    {
        $validated = $examRequest->validated();
        $exams = SubjectRegistration::findOrFail($validated['subject_registration'])->exams;
        if (($exams->sum('percentage') + $validated['percentage']) > 100) {
            return $this->Error('the percentage of all exams must be 100 or less');
        }
        $exam = new Exam();
        $exam->type = $validated['type'];
        $exam->date = $validated['date'];
        $exam->percentage = $validated['percentage'];
        $exam->subject_registration_id = $validated['subject_registration'];
        $exam->save();
        return $this->Success('Exam Has been created successfully');

    }

    public function delete_exam(Exam $exam)
    {
        $exam->results()->delete();
        $exam->delete();
        return $this->Success('Exam Has been deleted successfully');
    }

    public function change_chat_status(SubjectRegistration $subjectRegistration)
    {
        if ($subjectRegistration->chat_status === 0) {
            $subjectRegistration->chat_status = 1;
            $subjectRegistration->save();
        } else {
            $subjectRegistration->chat_status = 0;
            $subjectRegistration->save();
        }
        return $this->Success('Chat Status has been changed successfully');
    }

    public function pusher($massege)
    {
        event(new Chat(new MessagesResource($massege)));
    }

    public function messages(SubjectRegistration $subjectRegistration)
    {
        $messages = MessagesResource::collection($subjectRegistration->messages);
        return $this->Data(['messages' => $messages]);
    }

    public function send_message(SendMessageRequest $request, SubjectRegistration $subjectRegistration)
    {
        $validated = $request->validated();
        if (Auth::id() !== $subjectRegistration->teacher_id) {
            return $this->Error('You don\'t have enough permission to use this chat');
        }
        $message = new Message();
        $message->content = $validated['message'];
        $message->sender_type = 'teacher';
        $message->teacher_id = Auth::id();
        $message->reciver_type = 'subject';
        $message->subject_registration_id = $subjectRegistration->id;
        $message->save();
        $this->pusher($message);
        return $this->Success();
    }

    public function send_file_message(SendFileRequest $request, SubjectRegistration $subjectRegistration)
    {
        $validated = $request->validated();
        if (Auth::id() !== $subjectRegistration->teacher_id) {
            return $this->Error('You don\'t have enough permission to use this chat');
        }
        $message = new Message();
        $message->content = Upload::findOrFail($validated['file'])->url;
        $message->sender_type = 'teacher';
        $message->teacher_id = Auth::id();
        $message->reciver_type = 'subject';
        $message->upload_id = Upload::findOrFail($validated['file'])->id;
        $message->subject_registration_id = $subjectRegistration->id;
        $message->save();
        $this->pusher($message);
        return $this->Success();
    }
}

