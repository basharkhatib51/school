<?php

namespace App\Models\Generated;

use App\Models\Teacher;

use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SubjectRegistration extends Model
{
    use SoftDeletes, ObservantTrait;

    protected $fillable = [
        'chat_status',
    ];

    public function getIdAttribute($value)
    {
        if (!in_array('name', $this->fillable)) {
            $this->attributes['name'] = $this[$this->fillable[0]];
        }
        return $value;
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function year()
    {
        return $this->belongsTo(Year::class);
    }
    public function subject_registration_exams()
    {
        $id = $this->id;
        return $this->classroom->student_registrations()->with('student', function ($query) use ($id) {
            $query->with('results', function ($results_query) use ($id) {
                $results_query->with('exam', function ($exam_query) use ($id) {
                    $exam_query->where('subject_registration_id', $id);
                });
            });
        });
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function programs()
    {
        return $this->hasMany(Program::class);
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
