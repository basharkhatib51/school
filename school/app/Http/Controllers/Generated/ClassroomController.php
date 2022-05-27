<?php

namespace App\Http\Controllers\Generated;

use App\Http\Controllers\Controller;
use App\Http\Requests\Generated\Classroom\FilterClassroomRequest;
use App\Http\Requests\Generated\Classroom\UpdateClassroomRequest;
use App\Http\Requests\Generated\Classroom\StoreClassroomRequest;
use App\Http\Resources\Generated\ClassroomResource;
use App\Models\Generated\ClassLevel;
use App\Models\Generated\Classroom;
use App\Models\Generated\Year;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClassroomController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Classroom::class, 'classroom');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['classrooms' => ClassroomResource::collection(Classroom::all())]);
    }

    public function filter(FilterClassroomRequest $request): JsonResponse
    {
        $this->authorize('FilterClassroom');
        $validated = $request->validated();
        $classLevel = ClassLevel::findOrFail($validated['class_level']);
        $classroom = $classLevel->classrooms->where('year_id', Year::latest('id')->first()->id);
        return $this->Data(['classrooms' => ClassroomResource::collection($classroom)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreClassroomRequest $request
     * @return JsonResponse
     */
    public function store(StoreClassroomRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $classroom = new Classroom();
        $classroom = $classroom->create($validated);
        if (isset($validated['class_level'])) {
            $classroom->class_level()->associate($validated['class_level'])->save();
        }
        $classroom->year()->associate(Year::latest('id')->first()->id)->save();
        return $this->Success('Classroom has been stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Classroom $classroom
     * @return JsonResponse
     */
    public function show(Classroom $classroom): JsonResponse
    {
//        dd($classroom->student_registrations[0]->student);
        return $this->Data(['classroom' => new ClassroomResource($classroom)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateClassroomRequest $request
     * @param Classroom $classroom
     * @return JsonResponse
     */
    public function update(UpdateClassroomRequest $request, Classroom $classroom): JsonResponse
    {
        $validated = $request->validated();
        //{{ columns }}
        $classroom->update($validated);
        $classroom->ClassLevel()->dissociate();
        if (isset($validated['ClassLevel'])) {
            $classroom->ClassLevel()->associate($validated['ClassLevel'])->save();
        }

        return $this->Success('Classroom has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Classroom $classroom
     * @return JsonResponse
     */
    public function destroy(Classroom $classroom): JsonResponse
    {
        if (count($classroom->student_registrations) > 0) {
            return $this->Error('you should transfer the student in this classroom to another classroom or delete them');
        } elseif (count($classroom->subject_registrations) > 0) {
            return $this->Error('some teachers are teaching in this classroom you should unlink them from this classroom');
        } else {
            $classroom->subject_registrations()->delete();
            $classroom->student_registrations()->delete();
            $classroom->notifications()->update(['classroom_id' => null]);
            $classroom->delete();
            return $this->Success('Classroom has been destroyed successfully');
        }
    }

}
