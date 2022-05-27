<?php

namespace App\Http\Controllers\Family;

use App\Http\Controllers\Controller;
use App\Http\Requests\Family\ChangePasswordRequest;
use App\Http\Requests\Family\StoreRequest;
use App\Http\Requests\Family\UpdateRequest;
use App\Http\Requests\Family\UpdateStatusRequest;
use App\Http\Resources\Family\FamilyResource;
use App\Models\Family;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class FamilyController extends Controller
{
//    public function __construct()
//    {
//        $this->authorizeResource(Family::class, 'family');
//    }
//
//    /**
//     * Display a listing of the resource.
//     *
//     * @return JsonResponse
//     */
//    public function index(): JsonResponse
//    {
//        return $this->Data(['families' => FamilyResource::collection(Family::owner()->get())]);
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param StoreRequest $request
//     * @return JsonResponse
//     */
//    public function store(StoreRequest $request): JsonResponse
//    {
//        $validated = $request->validated();
//        $family = new Family();
//        $family->email = $validated['email']??null;
//        $family->password = Hash::make($validated['password']);
//        $family->first_name = $validated['first_name'];
//        $family->last_name = $validated['last_name'];
//        $family->user_type = 'family';
//        $family->phone = $validated['phone'];
//        $family->avatar_id = $validated['avatar_id']??null;
//        $family->save();
//        return $this->Success('Family has been stored successfully');
//    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param Family $family
//     * @return JsonResponse
//     */
//    public function show(Family $family): JsonResponse
//    {
//        return $this->Data(['family' => new FamilyResource($family)]);
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param UpdateRequest $request
//     * @param Family $family
//     * @return JsonResponse
//     */
//    public function update(UpdateRequest $request, Family $family): JsonResponse
//    {
//        $validated = $request->validated();
//        $family->first_name = $validated['first_name'];
//        $family->last_name = $validated['last_name'];
//        $family->email = $validated['email']??null;
//        $family->phone = $validated['phone'];
//        $family->avatar_id = $validated['avatar_id']??null;
//        $family->save();
//        return $this->Success('Family has been updated successfully');
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param Family $family
//     * @return JsonResponse
//     */
//    public function destroy(Family $family): JsonResponse
//    {
//        $family->delete();
//        return $this->Success('Family has been destroyed successfully');
//    }
//
//    /**
//     * Update password resource in storage.
//     *
//     * @param ChangePasswordRequest $request
//     * @param Family $family
//     * @return JsonResponse
//     * @throws AuthorizationException
//     */
//    public function change_password(ChangePasswordRequest $request, Family $family): JsonResponse
//    {
//        $this->authorize('change_password', $family);
//        $validated = $request->validated();
//        $family->password = Hash::make($validated['password']);
//        $family->save();
//        return $this->Success('Password has been updated successfully');
//    }
//
//    /**
//     * Update status resource in storage.
//     *
//     * @param UpdateStatusRequest $request
//     * @param Family $family
//     * @return JsonResponse
//     * @throws AuthorizationException
//     */
//    public function change_status(UpdateStatusRequest $request, Family $family): JsonResponse
//    {
//        $this->authorize('change_status', $family);
//        $validated = $request->validated();
//        $family->status = $validated['status'];
//        if ($validated['status'] == 'blocked' && isset($validated['blocked_reason'])) {
//            $family->blocked_reason = $validated['blocked_reason'] ?? null;
//        } else {
//            $family->blocked_reason = null;
//        }
//        $family->save();
//        if ($family->status === 'blocked') {
//            $family->tokens()->delete();
//        }
//        return $this->Success("Family has been $family->status successfully");
//    }
//
//
//
//    public function get_trashed(): JsonResponse
//    {
//
//        $this->authorize('get_trashed', Family::class);
//        return $this->Data(['families' => FamilyResource::collection(Family::onlyTrashed()->get())]);
//    }
//
//    /**
//     * Update role resource in storage.
//     *
//     * @param Family $trashed_family
//     * @return JsonResponse
//     */
//    public function restore(Family $trashed_family): JsonResponse
//    {
//        $this->authorize('restore', $trashed_family);
//        $trashed_family->restore();
//        return $this->Success('Family has been Restored Successfully');
//    }
}
