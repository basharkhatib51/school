<?php

namespace App\Models;
use App\Models\Post;
use App\Models\Page;

use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Upload;
use App\Models\User;

class Tag extends Model
{
    use SoftDeletes,ObservantTrait;

    protected $fillable = [
    'name','name_ar','name_tr'
    ];

     public function getIdAttribute($value)
        {
            if (!in_array('name', $this->fillable)){
                $this->attributes['name'] = $this[$this->fillable[0]];
            }
            return $value;
        }


public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
public function pages()
    {
        return $this->belongsToMany(Page::class);
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
