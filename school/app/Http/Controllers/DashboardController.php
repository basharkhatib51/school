<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Generated\ClassLevel;
use App\Models\Generated\Classroom;
use App\Models\Generated\Exam;
use App\Models\Generated\Fee;
use App\Models\Generated\Message;
use App\Models\Generated\Notification;
use App\Models\Generated\Payment;
use App\Models\Generated\Result;
use App\Models\Generated\StudentRegistration;
use App\Models\Generated\Subject;
use App\Models\Generated\SubjectRegistration;
use App\Models\Generated\Year;
use App\Models\Page;
use App\Models\Post;
use App\Models\Student;
use App\Models\Tag;
use App\Models\Teacher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */

    public function index(): JsonResponse
    {
        $admins = Admin::all()->count();
        $students = Student::all()->count();
        $teachers = Teacher::all()->count();
        $classLevels = ClassLevel::all()->count();
        $classrooms = Classroom::all()->count();
        $subjects = Subject::all()->count();
        $exams = Exam::all()->count();
        $fees = Fee::all()->count();
        $payments = Payment::all()->count();
//        $message = Message::all()->count();
//        $results = Result::all()->count();
        $notification = Notification::all()->count();
        $year = Year::all()->count();
        $posts = Post::all()->count();
        $pages = Page::all()->count();
        $tags = Tag::all()->count();

        $admins = array(
            "data" => $admins,
            "icon" => 'users'
        );
        $students = array(
            "data" => $students,
            "icon" => 'user-graduate'
        );
        $teachers = array(
            "data" => $teachers,
            "icon" => 'user-graduate'
        );
        $classLevels = array(
            "data" => $classLevels,
            "icon" => 'layer-group'
        );
        $classrooms = array(
            "data" => $classrooms,
            "icon" => 'door-closed'
        );
        $subjects = array(
            "data" => $subjects,
            "icon" => 'tachometer-alt'
        );
        $exams = array(
            "data" => $exams,
            "icon" => 'chalkboard'
        );
        $fees = array(
            "data" => $fees,
            "icon" => 'money-check-alt'
        );
        $payments = array(
            "data" => $payments,
            "icon" => 'money-check-alt'
        );
//        $results = array(
//            "data" => $results,
//            "icon" => 'font'
//        );
//        $message = array(
//            "data" => $message,
//            "icon" => 'comments'
//        );
        $notification = array(
            "data" => $notification,
            "icon" => 'bell'
        );
        $year = array(
            "data" => $year,
            "icon" => 'calendar-plus'
        );
        $posts = array(
            "data" => $posts,
            "icon" => 'newspaper'
        );
        $pages = array(
            "data" => $pages,
            "icon" => 'file-alt'
        );
        $tags = array(
            "data" => $tags,
            "icon" => 'tags'
        );


        return $this->Data(
            ['data' =>
                [
                    'Admins' => $admins,
                    'students' => $students,
                    'Teachers' => $teachers,
                    'ClassLevels' => $classLevels,
                    'classrooms' => $classrooms,
                    'subjects' => $subjects,
                    'exams' => $exams,
//                    'Results' => $results,
                    'fees' => $fees,
                    'payments' => $payments,
//                    'messages' => $message,
                    'Years' => $year,
                    'notifications' => $notification,
                    'posts' => $posts,
                    'pages' => $pages,
                    'tags' => $tags,
                ]
            ]);
    }

}
