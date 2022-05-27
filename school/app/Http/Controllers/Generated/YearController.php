<?php

namespace App\Http\Controllers\Generated;

use App\Http\Controllers\Controller;
use App\Http\Requests\Generated\Year\UpdateYearRequest;
use App\Http\Requests\Generated\Year\StoreYearRequest;
use App\Http\Resources\Generated\YearResource;
use App\Models\Generated\Year;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class YearController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Year::class, 'year');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['years' => YearResource::collection(Year::all())]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreYearRequest $request
     * @return JsonResponse
     */
    public function store(StoreYearRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $year = new Year();
        $year = $year->create($validated);

        return $this->Success('Year has been stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Year $year
     * @return JsonResponse
     */
    public function show(Year $year): JsonResponse
    {
        return $this->Data(['year' => new YearResource($year)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateYearRequest $request
     * @param Year $year
     * @return JsonResponse
     */
    public function update(UpdateYearRequest $request, Year $year): JsonResponse
    {
        $validated = $request->validated();
        //{{ columns }}
        $year->update($validated);

        return $this->Success('Year has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Year $year
     * @return JsonResponse
     */
    public function destroy(Year $year): JsonResponse
    {
        if ($year->student_registrations->count != 0 || $year->subject_registrations->count != 0) {
            $year->delete();
            return $this->Success('Year has been destroyed successfully');
        } else {
            return $this->Error('This Year content student_registrations and subject_registrations please delete it first');

        }

    }

    /**
     * Get Trashed resource in storage.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function get_trashed(): JsonResponse
    {
        $this->authorize('get_trashed', Year::class);
        return $this->Data(['years' => YearResource::collection(Year::onlyTrashed()->get())]);
    }

    /**
     * Update role resource in storage.
     *
     * @param Year $trashed_year
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function restore($trashed_year): JsonResponse
    {
        $this->authorize('restore', $trashed_year);
        $trashed_year = Year::onlyTrashed()->findOrFail($trashed_year);
        $trashed_year->restore();
        return $this->Success('Year has been Restored Successfully');
    }
}
