<?php

namespace App\Http\Controllers\Generated;

use App\Http\Controllers\Controller;
use App\Http\Requests\Generated\SubjectRegistration\UpdateSubjectRegistrationRequest;
use App\Http\Requests\Generated\SubjectRegistration\StoreSubjectRegistrationRequest;
use App\Http\Resources\Generated\ExamResource;
use App\Http\Resources\Generated\SubjectRegistrationExamsResource;
use App\Http\Resources\Generated\SubjectRegistrationResource;
use App\Models\Generated\Exam;
use App\Models\Generated\Subject;
use App\Models\Generated\SubjectRegistration;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SubjectRegistrationController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(SubjectRegistration::class, 'subject_registration');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['subject_registrations' => SubjectRegistrationResource::collection(SubjectRegistration::all())]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSubjectRegistrationRequest $request
     * @return JsonResponse
     */
    public function store(StoreSubjectRegistrationRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $subject=Subject::findOrFail($validated['subject']);
        $subject_registration = new SubjectRegistration();
        $subject_registration->chat_status = 0;
        $subject_registration->subject_id = $validated['subject'];
        $subject_registration->teacher_id = $validated['teacher'];
        $subject_registration->percentage = $subject->percentage;
        $subject_registration->classroom_id = $validated['classroom'];
        $subject_registration->save();
        return $this->Success('SubjectRegistration has been stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param SubjectRegistration $subject_registration
     * @return JsonResponse
     */
    public function show(SubjectRegistration $subject_registration): JsonResponse
    {
//        dd($subject_registration->subject_registration_exams->pluck('student')->toArray());

        return $this->Data([
            'exams_types' => ExamResource::collection($subject_registration->exams),
            'students' => SubjectRegistrationExamsResource::collection($subject_registration->subject_registration_exams),
            'subject_registrations'=> new SubjectRegistrationResource($subject_registration)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSubjectRegistrationRequest $request
     * @param SubjectRegistration $subject_registration
     * @return JsonResponse
     */
    public function update(UpdateSubjectRegistrationRequest $request, SubjectRegistration $subject_registration): JsonResponse
    {
        $validated = $request->validated();
        $subject_registration->teacher_id = $validated['teacher'];
        $subject_registration->save();
        return $this->Success('SubjectRegistration has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SubjectRegistration $subject_registration
     * @return JsonResponse
     */
    public function destroy(SubjectRegistration $subject_registration): JsonResponse
    {
        $subject_registration->exams()->delete();
        $subject_registration->messages()->delete();
        $subject_registration->programs()->delete();
        $subject_registration->delete();
        return $this->Success('SubjectRegistration has been destroyed successfully');
    }

    /**
     * Get Trashed resource in storage.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function get_trashed(): JsonResponse
    {
        $this->authorize('get_trashed', SubjectRegistration::class);
        return $this->Data(['subject_registrations' => SubjectRegistrationResource::collection(SubjectRegistration::onlyTrashed()->get())]);
    }

    /**
     * Update role resource in storage.
     *
     * @param SubjectRegistration $trashed_subject_registration
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function restore($trashed_subject_registration): JsonResponse
    {
        $this->authorize('restore', $trashed_subject_registration);
        $trashed_subject_registration = SubjectRegistration::onlyTrashed()->findOrFail($trashed_subject_registration);
        $trashed_subject_registration->restore();
        return $this->Success('SubjectRegistration has been Restored Successfully');
    }
}
