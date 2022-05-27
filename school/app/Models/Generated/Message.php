<?php

namespace App\Models\Generated;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Generated\SubjectRegistration;

use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Upload;
use App\Models\User;

class Message extends Model
{
    use SoftDeletes, ObservantTrait;

    protected $fillable = [
        'content', 'sender_type', 'reciver_type', 'image_id',
    ];

    public function getIdAttribute($value)
    {
        if (!in_array('name', $this->fillable)) {
            $this->attributes['name'] = $this[$this->fillable[0]];
        }
        return $value;
    }

    public function sender(){
        if($this->sender_type==='student')
            return $this->student();
        elseif($this->sender_type==='teacher')
            return $this->teacher();
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function file()
    {
        return $this->belongsTo(Upload::class,'upload_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject_registration()
    {
        return $this->belongsTo(SubjectRegistration::class);
    }

    public function upload_image()
    {
        return $this->belongsTo(Upload::class, 'image', 'id');
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
