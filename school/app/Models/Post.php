<?php

namespace App\Models;
use App\Models\Tag;

use App\Models\Menu;
use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use SoftDeletes,ObservantTrait;

    protected $fillable = [
    'title','image','background','content','excerpt'
    ];

     public function getIdAttribute($value)
        {
            if (!in_array('name', $this->fillable)){
                $this->attributes['name'] = $this[$this->fillable[0]];
            }
            return $value;
        }

   public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function upload_image()
    {
        return $this->belongsTo(Upload::class, 'image', 'id');
    }
 public function upload_background()
    {
        return $this->belongsTo(Upload::class, 'background', 'id');
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
