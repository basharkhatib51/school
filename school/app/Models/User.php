<?php

namespace App\Models;

use App\Http\Resources\Admin\AdminResource;
use App\Http\Resources\Family\FamilyResource;
use App\Http\Resources\Student\StudentResource;
use App\Http\Resources\Teacher\TeacherResource;
use App\Traits\ObservantTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @method static create(array $validated)
 * @method static where(string $string, mixed $user_name)
 * @method static findOrFail($family_id)
 * @property mixed created_by
 * @property mixed id
 * @property mixed|string password
 * @property mixed first_name
 * @property mixed user_type
 * @property mixed last_name
 * @property mixed email
 * @property mixed avatar_id
 * @property mixed phone
 */
class User extends Authenticatable
{
    use  Notifiable, HasApiTokens, HasRoles, SoftDeletes, ObservantTrait;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'phone', 'language',];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function created_by_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updated_by_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deleted_by_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function uploaded_avatar(): BelongsTo
    {
        return $this->belongsTo(Upload::class, 'avatar_id', 'id');
    }

    public function getNameAttribute(): string
    {
        return "$this->first_name $this->last_name";
    }

    public function sub_model()
    {
        if ($this->user_type == 'admin')
            $model = Admin::findOrFail($this->id);
        elseif ($this->user_type == 'teacher')
            $model = Teacher::findOrFail($this->id);
        elseif ($this->user_type == 'student')
            $model = Student::findOrFail($this->id);
        elseif ($this->user_type == 'family')
            $model = Family::findOrFail($this->id);
        return $model;
    }

    public function sub_model_resources(): AdminResource|StudentResource|FamilyResource|TeacherResource|null
    {
        $model_resources = null;
        if ($this->user_type == 'admin')
            $model_resources = new AdminResource($this->sub_model());
        elseif ($this->user_type == 'teacher')
            $model_resources = new TeacherResource($this->sub_model());
        elseif ($this->user_type == 'student')
            $model_resources = new StudentResource($this->sub_model());
        elseif ($this->user_type == 'family')
            $model_resources = new FamilyResource($this->sub_model());
        return $model_resources;
    }

    public function scopeOwner($query)
    {
        $permission = class_basename($this) . ' List';
        if (Auth::user()->hasPermissionTo($permission))
            return $query;
        else
            return $query->where('created_by', Auth::user()->id);
    }

    public function social_accounts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SocialAccount::class);
    }
}
