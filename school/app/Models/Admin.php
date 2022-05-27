<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

/**
 * @method static owner()
 */
class Admin extends User
{
    protected $table = 'users';
    protected $guard_name = 'api';

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('user_type', 'admin');
        });
    }
    public function getPermissionsAttribute()
    {
        return $this->role?->getAllPermissions()??[];
    }
    public function getRoleAttribute()
    {
        return $this->get_all_roles->first();
    }


    public function get_all_roles()
    {
        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id')->where('model_type', 'App\Models\User');
    }

    public function scopeOwner($query)
    {
        $permission = class_basename($this) . ' List';
        if (Auth::user()->hasPermissionTo($permission))
            return $query;
        else
            return $query->where('created_by', Auth::user()->id);
    }

}
