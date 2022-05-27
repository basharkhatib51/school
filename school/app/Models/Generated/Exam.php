<?php

namespace App\Models\Generated;

use App\Models\Student;
use App\Models\Generated\SubjectRegistration;

use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Upload;
use App\Models\User;

class Exam extends Model
{
    use SoftDeletes, ObservantTrait;

    protected $fillable = [
        'type', 'percentage', 'date'
    ];

    public function getIdAttribute($value)
    {
        if (!in_array('name', $this->fillable)) {
            $this->attributes['name'] = $this[$this->fillable[0]];
        }
        return $value;
    }

    public function classroom()
    {
        return $this->subject_registration->classroom();
    }

    public function subject_registration()
    {
        return $this->belongsTo(SubjectRegistration::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function students()
    {
        return $this->classroom->students();
    }

    public function students_result()
    {
        return $this->students()->with('results', function ($query) {
            $query->where('exam_id', $this->id);
        });
    }

    public function student_result($student_id)
    {
        return $this->results()->where('student_id', $student_id);
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
