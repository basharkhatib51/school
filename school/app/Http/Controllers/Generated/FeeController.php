<?php

namespace App\Http\Controllers\Generated;

use App\Http\Controllers\Controller;
use App\Http\Requests\Generated\Fee\UpdateFeeRequest;
use App\Http\Requests\Generated\Fee\StoreFeeRequest;
use App\Http\Resources\Generated\FeeResource;
use App\Models\Generated\Fee;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class FeeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Fee::class, 'fee');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['fees' => FeeResource::collection(Fee::all())]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFeeRequest $request
     * @return JsonResponse
     */
    public function store(StoreFeeRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $fee = new Fee();
        $fee = $fee->create($validated);
        if (isset($validated['class_level'])) {
            $fee->class_level()->associate($validated['class_level'])->save();
        }
        if (isset($validated['year'])) {
            $fee->year()->associate($validated['year'])->save();
        }

        return $this->Success('Fee has been stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Fee $fee
     * @return JsonResponse
     */
    public function show(Fee $fee): JsonResponse
    {
        return $this->Data(['fee' => new FeeResource($fee)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFeeRequest $request
     * @param Fee $fee
     * @return JsonResponse
     */
    public function update(UpdateFeeRequest $request, Fee $fee): JsonResponse
    {
        $validated = $request->validated();
        //{{ columns }}
        $fee->update($validated);
        $fee->class_level()->dissociate();
        if (isset($validated['class_level'])) {
            $fee->class_level()->associate($validated['class_level'])->save();
        }
        $fee->year()->dissociate();
        if (isset($validated['year'])) {
            $fee->year()->associate($validated['year'])->save();
        }

        return $this->Success('Fee has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Fee $fee
     * @return JsonResponse
     */
    public function destroy(Fee $fee): JsonResponse
    {

        $fee->delete();
        return $this->Success('Fee has been destroyed successfully');
    }

    /**
     * Get Trashed resource in storage.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function get_trashed(): JsonResponse
    {
        $this->authorize('get_trashed', Fee::class);
        return $this->Data(['fees' => FeeResource::collection(Fee::onlyTrashed()->get())]);
    }

    /**
     * Update role resource in storage.
     *
     * @param Fee $trashed_fee
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function restore($trashed_fee): JsonResponse
    {
        $this->authorize('restore', $trashed_fee);
        $trashed_fee = Fee::onlyTrashed()->findOrFail($trashed_fee);
        $trashed_fee->restore();
        return $this->Success('Fee has been Restored Successfully');
    }
}
