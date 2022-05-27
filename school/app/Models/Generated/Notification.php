<?php

namespace App\Models\Generated;

use App\Models\Generated\ClassLevel;
use App\Models\Generated\Classroom;

use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Upload;
use App\Models\User;

class Notification extends Model
{
    use SoftDeletes, ObservantTrait;

    protected $fillable = [
        'title', 'content', 'classroom_id'
    ];

//    public function getIdAttribute($value)
//    {
//        if (!in_array('name', $this->fillable)) {
//            $this->attributes['name'] = $this[$this->fillable[0]];
//        }
//        return $value;
//    }

    public function class_levels()
    {
        return $this->belongsToMany(ClassLevel::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
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