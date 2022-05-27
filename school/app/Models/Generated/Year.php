<?php

namespace App\Models\Generated;

use App\Models\Generated\SubjectRegistration;
use App\Models\Generated\StudentRegistration;
use App\Models\Generated\Fee;

use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Upload;
use App\Models\User;

class Year extends Model
{
    use SoftDeletes, ObservantTrait;

    protected $fillable = [
        'name',
    ];

    public function getIdAttribute($value)
    {
        if (!in_array('name', $this->fillable)) {
            $this->attributes['name'] = $this[$this->fillable[0]];
        }
        return $value;
    }

    public function subject_registrations()
    {
        return $this->hasManyThrough(SubjectRegistration::class,Classroom::class);
    }
    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

    public function student_registrations()
    {
        return $this->hasManyThrough(StudentRegistration::class,Classroom::class);
    }

    public function fees()
    {
        return $this->hasMany(Fee::class);
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
