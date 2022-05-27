<?php

namespace App\Http\Controllers\Scp;

use App\Events\Chat;
use App\Http\Controllers\Controller;
use App\Http\Requests\Scp\SendMessageRequest;
use App\Http\Requests\Scp\SendFileRequest;
use App\Http\Resources\Scp\MessagesResource;
use App\Http\Resources\Scp\ProgramResource;
use App\Http\Resources\Scp\ResultResource;
use App\Http\Resources\Scp\SubjectRegistrationResource;
use App\Http\Resources\Student\StudentRegistrationResource;
use App\Models\Generated\Message;
use App\Models\Generated\Notification;
use App\Models\Generated\SubjectRegistration;
use App\Models\Student;
use App\Models\Upload;
use Illuminate\Support\Facades\Auth;

class ScpController extends Controller
{
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
        $student = $subjectRegistration->classroom->student_registrations()->whereHas('student', function ($query) {
            $query->where('id', Auth::id());
        })->first();
        if (!$student) {
            return $this->Error('You don\'t have enough permission to use this chat');
        }
        $message = new Message();
        $message->content = $validated['message'];
        $message->sender_type = 'student';
        $message->student_id = Auth::id();
        $message->reciver_type = 'subject';
        $message->subject_registration_id = $subjectRegistration->id;
        $message->save();
        $this->pusher($message);
        return $this->Success();
    }

    public function student_result()
    {
        $student_id = Auth::id();
        $student = Student::findOrFail($student_id);
        return $this->Data(['results' => ResultResource::collection($student->latest_student_registration()->results)->groupBy('subject.name')]);
    }

    public function get_notifications()
    {
        $student_id = Auth::id();
        $student = Student::findOrFail($student_id);
        $classroom_id = $student->latest_student_registration()->classroom->id;
        $class_level_id = $student->latest_student_registration()->classroom->class_level->id;
        $notification = Notification::where('classroom_id', $classroom_id)->orWhereHas('class_levels', function ($q) use ($class_level_id) {
            $q->where('class_level_id', $class_level_id);
        })->latest()->take(10)->get();
        return $this->Data(["notifications" => $notification]);
    }

    public function student_subjects()
    {
        $student_id = Auth::id();
        $student = Student::findOrFail($student_id);
        return $this->Data(['subjects' => SubjectRegistrationResource::collection($student->latest_student_registration()->classroom->subject_registrations)]);
    }

    public function student_program()
    {
        $student_id = Auth::id();
        $student = Student::findOrFail($student_id);
        return $this->Data(['programs' => ProgramResource::collection($student->latest_student_registration()->classroom->programs()->orderBy('start_at', 'asc')->get())->groupBy('day')]);

    }

    public function last_years()
    {
        $student_id = Auth::id();
        $student = Student::findOrFail($student_id);
        return $this->Data(['last_years' => StudentRegistrationResource::collection($student->student_registrations)]);

    }

    public function send_file_message(SendFileRequest $request, SubjectRegistration $subjectRegistration)
    {
        $validated = $request->validated();
        $student = $subjectRegistration->classroom->student_registrations()->whereHas('student', function ($query) {
            $query->where('id', Auth::id());
        })->first();
        if (!$student) {
            return $this->Error('You don\'t have enough permission to use this chat');
        }
        $message = new Message();
        $message->content = Upload::findOrFail($validated['file'])->url;
        $message->sender_type = 'student';
        $message->teacher_id = Auth::id();
        $message->reciver_type = 'subject';
        $message->upload_id = Upload::findOrFail($validated['file'])->id;
        $message->subject_registration_id = $subjectRegistration->id;
        $message->save();
        $this->pusher($message);
        return $this->Success();
    }
}

