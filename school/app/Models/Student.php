<?php

namespace App\Models;

use App\Models\Generated\Classroom;
use App\Models\Generated\Result;
use App\Models\Generated\StudentRegistration;
use App\Models\Generated\Message;
use App\Models\Generated\Year;

class Student extends User
{

    protected $table = 'users';
    protected $guard_name = 'api';

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('user_type', 'student');
        });
    }

    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'student_registrations');
    }

    public function student_registrations()
    {
        return $this->hasMany(StudentRegistration::class);
    }

    public function latest_student_registration()
    {

        return $this->student_registrations()->latest('id')->first();
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
