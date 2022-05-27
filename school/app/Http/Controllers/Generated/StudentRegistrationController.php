<?php

namespace App\Http\Controllers\Generated;

use App\Http\Controllers\Controller;
use App\Http\Requests\Generated\StudentRegistration\UpdateStudentRegistrationRequest;
use App\Http\Requests\Generated\StudentRegistration\StoreStudentRegistrationRequest;
use App\Http\Resources\Generated\StudentRegistrationResource;
use App\Models\Generated\StudentRegistration;
use App\Models\Generated\Year;
use App\Models\Student;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class StudentRegistrationController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(StudentRegistration::class, 'student_registration');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['student_registrations' => StudentRegistrationResource::collection(StudentRegistration::all())]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreStudentRegistrationRequest $request
     * @return JsonResponse
     */
    public function store(StoreStudentRegistrationRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $student = Student::findOrFail($validated['student']);
        if ($student->latest_student_registration())
            if ($student->latest_student_registration()?->debt() > 0)
                return $this->Error('please pay old dept before register student as new');
        $classrooms = $student->classrooms->where('year_id', Year::latest('id')->first()->id);
        if (count($classrooms) > 0) {
            return $this->Error('Student already registered in this year');
        }
        $student_registration = new StudentRegistration();
        $student_registration->save();
        $student_registration->student()->associate($student->id)->save();
        $student_registration->classroom()->associate($validated['classroom'])->save();
        return $this->Success('Student has been Registered successfully');
//        dd($classrooms);
    }

    /**
     * Display the specified resource.
     *
     * @param StudentRegistration $student_registration
     * @return JsonResponse
     */
    public function show(StudentRegistration $student_registration): JsonResponse
    {
        return $this->Data(['student_registration' => new StudentRegistrationResource($student_registration)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateStudentRegistrationRequest $request
     * @param StudentRegistration $student_registration
     * @return JsonResponse
     */
    public function update(UpdateStudentRegistrationRequest $request, StudentRegistration $student_registration): JsonResponse
    {
        $validated = $request->validated();
        //{{ columns }}
        $student_registration->update($validated);
        $student_registration->Student()->dissociate();
        if (isset($validated['Student'])) {
            $student_registration->Student()->associate($validated['Student'])->save();
        }
        $student_registration->Classroom()->dissociate();
        if (isset($validated['Classroom'])) {
            $student_registration->Classroom()->associate($validated['Classroom'])->save();
        }

        return $this->Success('StudentRegistration has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param StudentRegistration $student_registration
     * @return JsonResponse
     */
    public function destroy(StudentRegistration $student_registration): JsonResponse
    {
        $student_registration->Payment()->delete();

        $student_registration->delete();
        return $this->Success('StudentRegistration has been destroyed successfully');
    }

    /**
     * Get Trashed resource in storage.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function get_trashed(): JsonResponse
    {
        $this->authorize('get_trashed', StudentRegistration::class);
        return $this->Data(['student_registrations' => StudentRegistrationResource::collection(StudentRegistration::onlyTrashed()->get())]);
    }

    /**
     * Update role resource in storage.
     *
     * @param StudentRegistration $trashed_student_registration
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function restore($trashed_student_registration): JsonResponse
    {
        $this->authorize('restore', $trashed_student_registration);
        $trashed_student_registration = StudentRegistration::onlyTrashed()->findOrFail($trashed_student_registration);
        $trashed_student_registration->restore();
        return $this->Success('StudentRegistration has been Restored Successfully');
    }
}
