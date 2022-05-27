<?php

namespace App\Models;

class Family extends User
{
    protected $table = 'users';
    protected $guard_name = 'api';

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('user_type', 'family');
        });
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }


}
