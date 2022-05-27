<?php

namespace App\Http\Controllers\Generated;

use App\Http\Controllers\Controller;
use App\Http\Requests\Generated\Exam\UpdateExamRequest;
use App\Http\Requests\Generated\Exam\StoreExamRequest;
use App\Http\Resources\Generated\ExamResource;
use App\Models\Generated\Exam;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Exam::class, 'exam');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['exams' => ExamResource::collection(Exam::all())]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreExamRequest $request
     * @return JsonResponse
     */
    public function store(StoreExamRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $exam = new Exam();
        $exam = $exam->create($validated);
        if (isset($validated['Student'])) {
            $exam->Student()->associate($validated['Student'])->save();
        }
        if (isset($validated['SubjectRegistration'])) {
            $exam->SubjectRegistration()->associate($validated['SubjectRegistration'])->save();
        }

        return $this->Success('Exam has been stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Exam $exam
     * @return JsonResponse
     */
    public function show(Exam $exam): JsonResponse
    {
        return $this->Data(['exam' => new ExamResource($exam)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateExamRequest $request
     * @param Exam $exam
     * @return JsonResponse
     */
    public function update(UpdateExamRequest $request, Exam $exam): JsonResponse
    {
        $validated = $request->validated();
        //{{ columns }}
        $exam->update($validated);
        $exam->Student()->dissociate();
        if (isset($validated['Student'])) {
            $exam->Student()->associate($validated['Student'])->save();
        }
        $exam->SubjectRegistration()->dissociate();
        if (isset($validated['SubjectRegistration'])) {
            $exam->SubjectRegistration()->associate($validated['SubjectRegistration'])->save();
        }

        return $this->Success('Exam has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Exam $exam
     * @return JsonResponse
     */
    public function destroy(Exam $exam): JsonResponse
    {

        $exam->delete();
        return $this->Success('Exam has been destroyed successfully');
    }

    /**
     * Get Trashed resource in storage.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function get_trashed(): JsonResponse
    {
        $this->authorize('get_trashed', Exam::class);
        return $this->Data(['exams' => ExamResource::collection(Exam::onlyTrashed()->get())]);
    }

    /**
     * Update role resource in storage.
     *
     * @param Exam $trashed_exam
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function restore($trashed_exam): JsonResponse
    {
        $this->authorize('restore', $trashed_exam);
        $trashed_exam = Exam::onlyTrashed()->findOrFail($trashed_exam);
        $trashed_exam->restore();
        return $this->Success('Exam has been Restored Successfully');
    }
}
