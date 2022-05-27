<?php

namespace App\Http\Controllers\Generated;

use App\Http\Controllers\Controller;
use App\Http\Requests\Generated\Program\UpdateProgramRequest;
use App\Http\Requests\Generated\Program\StoreProgramRequest;
use App\Http\Resources\Generated\ProgramResource;
use App\Models\Generated\Program;
use App\Models\Generated\SubjectRegistration;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class ProgramController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Program::class, 'program');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['programs' => ProgramResource::collection(Program::all())]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProgramRequest $request
     * @return JsonResponse
     */
    public function store(StoreProgramRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $subject_registration = SubjectRegistration::findOrFail($validated['subject_registration']);
        $teacher = $subject_registration->teacher;
        $classroom = $subject_registration->classroom;
        $start_at = $validated['start_at'];
        $finish_at = $validated['finish_at'];
        $day = $validated['day'];
        $teacher_program = $teacher->programs()->where('day', $day)->where(function ($or_query) use ($start_at, $finish_at) {
                $or_query->where(function ($query) use ($start_at) {
                    $query->whereTime('start_at', '<=', $start_at);
                    $query->whereTime('finish_at', '>', $start_at);
                });
                $or_query->orWhere(function ($query) use ($finish_at) {
                    $query->whereTime('start_at', '<', $finish_at);
                    $query->whereTime('finish_at', '>=', $finish_at);
                });
                $or_query->orWhere(function ($query) use ($start_at, $finish_at) {
                    $query->whereTime('start_at', '>', $start_at);
                    $query->whereTime('finish_at', '<', $finish_at);
                });
            })->first();
        $classroom_program = $classroom->programs()->where('day', $day)->where(function ($or_query) use ($start_at, $finish_at) {
                $or_query->where(function ($query) use ($start_at) {
                    $query->whereTime('start_at', '<=', $start_at);
                    $query->whereTime('finish_at', '>', $start_at);
                });
                $or_query->orWhere(function ($query) use ($finish_at) {
                    $query->whereTime('start_at', '<', $finish_at);
                    $query->whereTime('finish_at', '>=', $finish_at);
                });
                $or_query->orWhere(function ($query) use ($start_at, $finish_at) {
                    $query->whereTime('start_at', '>', $start_at);
                    $query->whereTime('finish_at', '<', $finish_at);
                });
            })->first();
        if ($teacher_program)
            return $this->Error('teacher has another subject at the same time');
        if ($classroom_program)
            return $this->Error('classroom has another subject at the same time');
        $program = new Program();
        $program->start_at = $validated['start_at'];
        $program->finish_at = $validated['finish_at'];
        $program->day = $validated['day'];
        $program->save();
        $program->subject_registration()->associate($validated['subject_registration'])->save();

        return $this->Success('Program has been stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Program $program
     * @return JsonResponse
     */
    public function show(Program $program): JsonResponse
    {
        return $this->Data(['program' => new ProgramResource($program)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProgramRequest $request
     * @param Program $program
     * @return JsonResponse
     */
    public function update(UpdateProgramRequest $request, Program $program): JsonResponse
    {
        $validated = $request->validated();
        //{{ columns }}
        $program->update($validated);
        $program->SubjectRegistration()->dissociate();
        if (isset($validated['SubjectRegistration'])) {
            $program->SubjectRegistration()->associate($validated['SubjectRegistration'])->save();
        }

        return $this->Success('Program has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Program $program
     * @return JsonResponse
     */
    public function destroy(Program $program): JsonResponse
    {

        $program->delete();
        return $this->Success('Program has been destroyed successfully');
    }

    /**
     * Get Trashed resource in storage.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function get_trashed(): JsonResponse
    {
        $this->authorize('get_trashed', Program::class);
        return $this->Data(['programs' => ProgramResource::collection(Program::onlyTrashed()->get())]);
    }

    /**
     * Update role resource in storage.
     *
     * @param Program $trashed_program
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function restore($trashed_program): JsonResponse
    {
        $this->authorize('restore', $trashed_program);
        $trashed_program = Program::onlyTrashed()->findOrFail($trashed_program);
        $trashed_program->restore();
        return $this->Success('Program has been Restored Successfully');
    }
}
