<?php

namespace App\Models\Generated;

use App\Models\Generated\Subject;
use App\Models\Generated\Classroom;
use App\Models\Generated\Fee;
use App\Models\Generated\Notification;

use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Upload;
use App\Models\User;

class ClassLevel extends Model
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

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function current_classrooms()
    {
        return $this->hasMany(Classroom::class)->where('year_id', Year::latest('id')->first()->id);
    }

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

    public function fees()
    {
        return $this->hasMany(Fee::class);
    }

    public function notifications()
    {
        return $this->belongsToMany(Notification::class);
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
