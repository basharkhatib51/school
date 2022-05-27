<?php

namespace App\Http\Controllers\Generated;

use App\Http\Controllers\Controller;
use App\Http\Requests\Generated\ClassLevel\UpdateClassLevelRequest;
use App\Http\Requests\Generated\ClassLevel\StoreClassLevelRequest;
use App\Http\Resources\Generated\ClassLevelResource;
use App\Models\Generated\ClassLevel;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class ClassLevelController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ClassLevel::class, 'class_level');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['class_levels' => ClassLevelResource::collection(ClassLevel::all())]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreClassLevelRequest $request
     * @return JsonResponse
     */
    public function store(StoreClassLevelRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $class_level = new ClassLevel();
        $class_level=$class_level->create($validated);

        return $this->Success('ClassLevel has been stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param ClassLevel $class_level
     * @return JsonResponse
     */
    public function show(ClassLevel $class_level): JsonResponse
    {
        return $this->Data(['class_level' => new ClassLevelResource($class_level)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateClassLevelRequest $request
     * @param ClassLevel $class_level
     * @return JsonResponse
     */
    public function update(UpdateClassLevelRequest $request, ClassLevel $class_level): JsonResponse
    {
        $validated = $request->validated();
        //{{ columns }}
        $class_level->update($validated);

        return $this->Success('ClassLevel has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ClassLevel $class_level
     * @return JsonResponse
     */
    public function destroy(ClassLevel $class_level): JsonResponse
    {
        $ClassLevel->Subject()->delete();
$ClassLevel->Classroom()->delete();
$ClassLevel->Fee()->delete();
$ClassLevel->notifications()->detach();

        $class_level->delete();
        return $this->Success('ClassLevel has been destroyed successfully');
    }
    /**
     * Get Trashed resource in storage.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function get_trashed(): JsonResponse
    {
        $this->authorize('get_trashed', ClassLevel::class);
        return $this->Data(['class_levels' => ClassLevelResource::collection(ClassLevel::onlyTrashed()->get())]);
    }
    /**
     * Update role resource in storage.
     *
     * @param ClassLevel $trashed_class_level
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function restore($trashed_class_level): JsonResponse
    {
        $this->authorize('restore', $trashed_class_level);
        $trashed_class_level = ClassLevel::onlyTrashed()->findOrFail($trashed_class_level);
        $trashed_class_level->restore();
        return $this->Success('ClassLevel has been Restored Successfully');
    }
}
