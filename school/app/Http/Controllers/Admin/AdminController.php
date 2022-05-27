<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\ChangeRoleRequest;
use App\Http\Requests\Admin\ChangePasswordRequest;
use App\Http\Requests\Admin\StoreRequest;
use App\Http\Requests\Admin\UpdateRequest;
use App\Http\Requests\Admin\UpdateStatusRequest;
use App\Http\Resources\Admin\AdminResource;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Admin::class, 'admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->Data(['admins' => AdminResource::collection(Admin::owner()->get())]);
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
        $admin = new Admin();
        $admin->email = $validated['email'];
        $admin->password = Hash::make($validated['password']);
        $admin->first_name = $validated['first_name'];
        $admin->last_name = $validated['last_name'];
        $admin->user_type = 'admin';
        $admin->phone = $validated['phone'] ?? null;
        $admin->avatar_id = $validated['avatar_id'] ?? null;
        $admin->save();
        $user = User::findOrFail($admin->id);
        $user->syncRoles(1);
        return $this->Success('Admin has been stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Admin $admin
     * @return JsonResponse
     */
    public function show(Admin $admin): JsonResponse
    {
        return $this->Data(['admin' => new AdminResource($admin)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Admin $admin
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Admin $admin): JsonResponse
    {
        $validated = $request->validated();
        $admin->first_name = $validated['first_name'];
        $admin->last_name = $validated['last_name'];
        $admin->email = $validated['email'];
        $admin->phone = $validated['phone'] ?? null;
        $admin->avatar_id = $validated['avatar_id'] ?? null;
        $admin->save();
        return $this->Success('Admin has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Admin $admin
     * @return JsonResponse
     */
    public function destroy(Admin $admin): JsonResponse
    {
        $admin->delete();
        return $this->Success('Admin has been destroyed successfully');
    }

    /**
     * Update password resource in storage.
     *
     * @param ChangePasswordRequest $request
     * @param Admin $admin
     * @return JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function change_password(ChangePasswordRequest $request, Admin $admin): JsonResponse
    {
        $this->authorize('change_password', $admin);
        $validated = $request->validated();
        $admin->password = Hash::make($validated['password']);
        $admin->save();
        return $this->Success('Password has been updated successfully');
    }

    /**
     * Update status resource in storage.
     *
     * @param UpdateStatusRequest $request
     * @param Admin $admin
     * @return JsonResponse
     */
    public function change_status(UpdateStatusRequest $request, Admin $admin): JsonResponse
    {
        $this->authorize('change_status', $admin);
        $validated = $request->validated();
        $admin->status = $validated['status'];
        if ($validated['status'] == 'blocked' && isset($validated['blocked_reason'])) {
            $admin->blocked_reason = $validated['blocked_reason'] ?? null;
        } else {
            $admin->blocked_reason = null;
        }
        $admin->save();
        if ($admin->status === 'blocked') {
            $admin->tokens()->delete();
        }
        return $this->Success("Admin has been $admin->status successfully");
    }

    /**
     * Update role resource in storage.
     *
     * @param ChangeRoleRequest $request
     * @param Admin $admin
     * @return JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function change_role(ChangeRoleRequest $request, Admin $admin): JsonResponse
    {
        $this->authorize('change_role', $admin);
        $validated = $request->validated();
        $user = User::findOrFail($admin->id);
        $user->syncRoles($validated['role_id']);
        return $this->Success("Admin role has been changed successfully");
    }

    public function get_trashed(): JsonResponse
    {
        $this->authorize('get_trashed', Admin::class);
        return $this->Data(['admins' => AdminResource::collection(Admin::onlyTrashed()->get())]);
    }

    /**
     * Update role resource in storage.
     *
     * @param Admin $trashed_user
     * @return JsonResponse
     */
    public function restore(Admin $trashed_admin): JsonResponse
    {
        $this->authorize('restore', $trashed_admin);
        $trashed_admin->restore();
        return $this->Success('Admin has been Restored Successfully');
    }
}
