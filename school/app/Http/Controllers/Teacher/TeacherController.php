<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\ChangePasswordRequest;
use App\Http\Requests\Teacher\StoreRequest;
use App\Http\Requests\Teacher\UpdateRequest;
use App\Http\Requests\Teacher\UpdateStatusRequest;
use App\Http\Resources\Teacher\TeacherResource;
use App\Models\Teacher;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Teacher::class, 'teacher');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['teachers' => TeacherResource::collection(Teacher::owner()->get())]);
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
        $teacher = new Teacher();
        $teacher->email = $validated['email'];
        $teacher->password = Hash::make($validated['password']);
        $teacher->first_name = $validated['first_name'];
        $teacher->last_name = $validated['last_name'];
        $teacher->model_number = $validated['model_number'];
        $teacher->user_type = 'teacher';
        $teacher->phone = $validated['phone']??null;
        $teacher->avatar_id = $validated['avatar_id']??null;
        $teacher->save();
        return $this->Success('Teacher has been stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Teacher $teacher
     * @return JsonResponse
     */
    public function show(Teacher $teacher): JsonResponse
    {
        return $this->Data(['teacher' => new TeacherResource($teacher)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Teacher $teacher
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Teacher $teacher): JsonResponse
    {
        $validated = $request->validated();
        $teacher->first_name = $validated['first_name'];
        $teacher->last_name = $validated['last_name'];
        $teacher->email = $validated['email'];
        $teacher->model_number = $validated['model_number'];
        $teacher->phone = $validated['phone']??null;
        $teacher->avatar_id = $validated['avatar_id']??null;
        $teacher->save();
        return $this->Success('Teacher has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Teacher $teacher
     * @return JsonResponse
     */
    public function destroy(Teacher $teacher): JsonResponse
    {
        $teacher->delete();
        return $this->Success('Teacher has been destroyed successfully');
    }

    /**
     * Update password resource in storage.
     *
     * @param ChangePasswordRequest $request
     * @param Teacher $teacher
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function change_password(ChangePasswordRequest $request, Teacher $teacher): JsonResponse
    {
        $this->authorize('change_password', $teacher);
        $validated = $request->validated();
        $teacher->password = Hash::make($validated['password']);
        $teacher->save();
        return $this->Success('Password has been updated successfully');
    }

    /**
     * Update status resource in storage.
     *
     * @param UpdateStatusRequest $request
     * @param Teacher $teacher
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function change_status(UpdateStatusRequest $request, Teacher $teacher): JsonResponse
    {
        $this->authorize('change_status', $teacher);
        $validated = $request->validated();
        $teacher->status = $validated['status'];
        if ($validated['status'] == 'blocked' && isset($validated['blocked_reason'])) {
            $teacher->blocked_reason = $validated['blocked_reason'] ?? null;
        } else {
            $teacher->blocked_reason = null;
        }
        $teacher->save();
        if ($teacher->status === 'blocked') {
            $teacher->tokens()->delete();
        }
        return $this->Success("Teacher has been $teacher->status successfully");
    }



    public function get_trashed(): JsonResponse
    {

        $this->authorize('get_trashed', Teacher::class);
        return $this->Data(['teachers' => TeacherResource::collection(Teacher::onlyTrashed()->get())]);
    }

    /**
     * Update role resource in storage.
     *
     * @param Teacher $trashed_teacher
     * @return JsonResponse
     */
    public function restore(Teacher $trashed_teacher): JsonResponse
    {
        $this->authorize('restore', $trashed_teacher);
        $trashed_teacher->restore();
        return $this->Success('Teacher has been Restored Successfully');
    }
}
