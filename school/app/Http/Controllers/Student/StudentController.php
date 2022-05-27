<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\ChangePasswordRequest;
use App\Http\Requests\Student\StoreRequest;
use App\Http\Requests\Student\UpdateRequest;
use App\Http\Requests\Student\UpdateStatusRequest;
use App\Http\Resources\Student\StudentResource;
use App\Models\Family;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Student::class, 'student');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['students' => StudentResource::collection(Student::owner()->get())]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $family = new Family();
        $family->email = $validated['family_email'] ?? null;
        $family->password = Hash::make($validated['family_password']);
        $family->first_name = $validated['family_first_name'];
        $family->last_name = $validated['last_name'];
        $family->user_type = 'family';
        $family->phone = $validated['family_phone'];
        $family->save();

        $student = new Student();
//        $student->email = $validated['email']??null;
        $student->model_number = $validated['model_number'];
        $student->password = Hash::make($validated['password']);
        $student->first_name = $validated['first_name'];
        $student->last_name = $validated['last_name'];
        $student->user_type = 'student';
        $student->phone = $validated['phone'] ?? null;
        $student->avatar_id = $validated['avatar_id'] ?? null;
        $student->family_id = $family->id;
        $student->save();


        return $this->Success('Student has been stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Student $student
     * @return JsonResponse
     */
    public function show(Student $student): JsonResponse
    {
        return $this->Data(['student' => new StudentResource($student)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Student $student
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Student $student): JsonResponse
    {
        $validated = $request->validated();
        $student->first_name = $validated['first_name'];
        $student->last_name = $validated['last_name'];
//        $student->email = $validated['email'] ?? null;
        $student->model_number = $validated['model_number'];
        $student->phone = $validated['phone'] ?? null;
        $student->avatar_id = $validated['avatar_id'] ?? null;
        $student->save();

        $family = $student->family;
        $family->email = $validated['family_email'] ?? null;
        $family->first_name = $validated['family_first_name'];
        $family->last_name = $validated['last_name'];
        $family->user_type = 'family';
        $family->phone = $validated['family_phone'];
        $family->save();


        return $this->Success('Student has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Student $student
     * @return JsonResponse
     */
    public function destroy(Student $student): JsonResponse
    {
        $student->delete();
        return $this->Success('Student has been destroyed successfully');
    }

    /**
     * Update password resource in storage.
     *
     * @param ChangePasswordRequest $request
     * @param Student $student
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function change_password(ChangePasswordRequest $request, Student $student): JsonResponse
    {
        $this->authorize('change_password', $student);
        $validated = $request->validated();
        $student->password = Hash::make($validated['password']);
        $student->save();
        return $this->Success('Password has been updated successfully');
    }

    /**
     * Update status resource in storage.
     *
     * @param UpdateStatusRequest $request
     * @param Student $student
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function change_status(UpdateStatusRequest $request, Student $student): JsonResponse
    {
        $this->authorize('change_status', $student);
        $validated = $request->validated();
        $student->status = $validated['status'];
        if ($validated['status'] == 'blocked' && isset($validated['blocked_reason'])) {
            $student->blocked_reason = $validated['blocked_reason'] ?? null;
        } else {
            $student->blocked_reason = null;
        }
        $student->save();
        if ($student->status === 'blocked') {
            $student->tokens()->delete();
        }
        return $this->Success("Student has been $student->status successfully");
    }


    public function get_trashed(): JsonResponse
    {

        $this->authorize('get_trashed', Student::class);
        return $this->Data(['students' => StudentResource::collection(Student::onlyTrashed()->get())]);
    }

    /**
     * Update role resource in storage.
     *
     * @param Student $trashed_student
     * @return JsonResponse
     */
    public function restore(Student $trashed_student): JsonResponse
    {
        $this->authorize('restore', $trashed_student);
        $trashed_student->restore();
        return $this->Success('Student has been Restored Successfully');
    }
}
