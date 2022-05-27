<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Http\Resources\Permission\PermissionResource;
use App\Http\Resources\Role\RoleResource;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Role::class, 'role');
    }

    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->Data(['roles' => RoleResource::collection(Role::whereNotIn('name', ['SuperAdmin', 'Teacher', 'Student', 'Family'])->get())]);
    }


    public function store(StoreRoleRequest $request)
    {
        $validated = $request->validated();
        $role = new Role();
        $role->name = $validated['name'];
        $role->guard_name = 'api';
        $role->save();
        $role->syncPermissions($validated['permissions']);
        return $this->Success('Role Has been stored successfully');
    }


    public function show(Role $role): \Illuminate\Http\JsonResponse
    {
        $role=Role::whereNotIn('name', ['SuperAdmin', 'Teacher', 'Student', 'Family'])->findOrFail($role->id);
        return $this->Data(['role' => new RoleResource($role)]);
    }


    public function update(UpdateRoleRequest $request, Role $role): \Illuminate\Http\JsonResponse
    {
        $role=Role::whereNotIn('name', ['SuperAdmin', 'Teacher', 'Student', 'Family'])->findOrFail($role->id);
        $validated = $request->validated();
        $role->name = $validated['name'];
        $role->save();
        $role->syncPermissions($validated['permissions']);
        return $this->Success('Role Has been updated successfully');

    }


    public function destroy(Role $role): \Illuminate\Http\JsonResponse
    {
        $role=Role::whereNotIn('name', ['SuperAdmin', 'Teacher', 'Student', 'Family'])->findOrFail($role->id);
        $role->delete();
        return $this->Success('Role has been destroyed successfully');
    }

    /**
     * Update status resource in storage.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function permissions(): \Illuminate\Http\JsonResponse
    {
        $this->authorize('permissions', Role::Class);
        return $this->Data(['permissions' => PermissionResource::collection(Permission::all())]);
    }
}
