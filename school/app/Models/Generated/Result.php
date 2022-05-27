<?php

namespace App\Models\Generated;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'value', 'student_id','exam_id'
    ];
    use HasFactory;

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function subject()
    {
        return $this->exam->subject_registration->subject();
    }
}
