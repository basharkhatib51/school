<?php

namespace App\Models\Generated;

use App\Models\Generated\Year;
use App\Models\Student;
use App\Models\Generated\Classroom;
use App\Models\Generated\Payment;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Upload;
use App\Models\User;

class StudentRegistration extends Model
{
    use SoftDeletes, ObservantTrait;

    public function debt()
    {
        return $this->fee() - $this->total_payments();
    }

    public function total_payments()
    {

        return $this->payments->sum('value') ?? 0;
    }

    public function fee()
    {
        return $this->classroom->class_level->fees->where('year_id', Year::latest('id')->first()->id)->first()?->value ?? 0;
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function results()
    {
        return $this->student->results()->whereHas('exam', function ($exam) {
            $exam->whereHas('subject_registration', function ($subject_registration) {
                $subject_registration->whereHas('classroom', function ($classroom) {
                    $classroom->whereHas('student_registrations', function ($student_registrations) {
                        $student_registrations->where('id', $this->id);
                    });
                });
            });
        });
    }

    public function subject_registrations()
    {
        return $this->classroom->subject_registrations();
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }


    public function scopeOwner($query)
    {
        $permission = class_basename($this) . ' List';
        if (Auth::user()->hasPermissionTo($permission))
            return $query;
        else
            return $query->where('created_by', Auth::user()->id);
    }

    public function created_by_user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function update_by_user()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
