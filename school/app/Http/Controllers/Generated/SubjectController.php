<?php

namespace App\Http\Controllers\Generated;

use App\Http\Controllers\Controller;
use App\Http\Requests\Generated\Subject\FilterSubjectRequest;
use App\Http\Requests\Generated\Subject\UpdateSubjectRequest;
use App\Http\Requests\Generated\Subject\StoreSubjectRequest;
use App\Http\Resources\Generated\SubjectResource;
use App\Models\Generated\ClassLevel;
use App\Models\Generated\Classroom;
use App\Models\Generated\Subject;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Subject::class, 'subject');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['subjects' => SubjectResource::collection(Subject::all())]);
    }

    public function filter(FilterSubjectRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $ClassLevel = ClassLevel::findOrFail($validated['class_level']);
        $ClassRooms = ClassRoom::findOrFail($validated['classroom']);
        $Semester = $validated['semester'];
        $all_subjects = $ClassLevel->subjects->where('semester', $Semester);
        $subjects = Subject::where('class_level_id', $ClassLevel->id)->where('semester', $Semester)->whereDoesntHave('subject_registrations', function ($query) use ($ClassRooms) {
            $query->where('classroom_id', $ClassRooms->id);
        })->get();
        return $this->Data([
            'subjects' => SubjectResource::collection($subjects),
            'all_subjects' => SubjectResource::collection($all_subjects)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSubjectRequest $request
     * @return JsonResponse
     */
    public function store(StoreSubjectRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $subject = new Subject();
        $subject = $subject->create($validated);
        if (isset($validated['class_level'])) {
            $subject->class_level()->associate($validated['class_level'])->save();
        }

        return $this->Success('Subject has been stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Subject $subject
     * @return JsonResponse
     */
    public function show(Subject $subject): JsonResponse
    {
        return $this->Data(['subject' => new SubjectResource($subject)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSubjectRequest $request
     * @param Subject $subject
     * @return JsonResponse
     */
    public function update(UpdateSubjectRequest $request, Subject $subject): JsonResponse
    {
        $validated = $request->validated();
        //{{ columns }}
        $subject->update($validated);
        return $this->Success('Subject has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Subject $subject
     * @return JsonResponse
     */
    public function destroy(Subject $subject): JsonResponse
    {
        if (count($subject->subject_registrations) > 0) {
            return $this->Error('some teachers are teaching this subject you should delete or change the subject for the teacher before deleting this subject');
        } else {

            $subject->subject_registrations()->delete();
            $subject->delete();
            return $this->Success('Subject has been destroyed successfully');
        }
    }

    /**
     * Get Trashed resource in storage.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public
    function get_trashed(): JsonResponse
    {
        $this->authorize('get_trashed', Subject::class);
        return $this->Data(['subjects' => SubjectResource::collection(Subject::onlyTrashed()->get())]);
    }

    /**
     * Update role resource in storage.
     *
     * @param Subject $trashed_subject
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public
    function restore($trashed_subject): JsonResponse
    {
        $this->authorize('restore', $trashed_subject);
        $trashed_subject = Subject::onlyTrashed()->findOrFail($trashed_subject);
        $trashed_subject->restore();
        return $this->Success('Subject has been Restored Successfully');
    }
}
