<?php

namespace App\Models;

use App\Http\Resources\Generated\SubjectRegistrationResource;
use App\Models\Generated\Classroom;
use App\Models\Generated\Program;
use App\Models\Generated\SubjectRegistration;
use App\Models\Generated\Message;
use App\Models\Generated\Year;

class Teacher extends User
{

    protected $table = 'users';
    protected $guard_name = 'api';

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(function ($query) {
            $query->where('user_type', 'teacher');
        });
    }

    public function subject_registrations()
    {
        return $this->hasMany(SubjectRegistration::class);
    }

    public function current_subject_registrations()
    {
        return $this->subject_registrations()->whereHas('classroom', function ($query) {
            $query->where('year_id', Year::latest('id')->first()->id);
        });
    }

    public function current_programs()
    {
        return $this->programs()->whereHas('subject_registration', function ($subject_registration) {
            $subject_registration->whereHas('classroom', function ($classroom) {
                $classroom->where('year_id', Year::latest('id')->first()->id);
            });
        });
    }


    public function programs()
    {
        return $this->hasManyThrough(Program::class, SubjectRegistration::class)->whereHas('subject_registration', function ($query) {
            $query->whereHas('classroom', function ($classroom_query) {
                $classroom_query->where('year_id', Year::latest('id')->first()->id);
            });
        });
    }


    public function messages()
    {
        return $this->hasMany(Message::class);
    }

}
