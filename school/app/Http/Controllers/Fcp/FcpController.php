<?php

namespace App\Http\Controllers\Fcp;
use App\Http\Controllers\Controller;
use App\Http\Resources\Student\StudentRegistrationResource;
use App\Models\Family;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FcpController extends Controller
{
    public function last_years()
    {
        $family_id = Auth::id();
        $family = Family::findOrFail($family_id);
        $student = Student::findOrFail($family->student->id);
        return $this->Data(['last_years' => StudentRegistrationResource::collection($student->student_registrations)]);

    }
}
