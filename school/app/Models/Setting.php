<?php

namespace App\Models;

use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Upload;

class Setting extends Model
{
    use SoftDeletes,ObservantTrait;

    protected $fillable = [
    'key','value','default','option','type','pack','icon','tab','index',
    ];

     public function getIdAttribute($value)
        {
            if (!in_array('name', $this->fillable)){
                $this->attributes['name'] = $this[$this->fillable[0]];
            }
            return $value;
        }




    public function scopeOwner($query)
   {
       $permission = class_basename($this) . ' List';
       if (Auth::user()->hasPermissionTo($permission))
           return $query;
       else
           return $query->where('created_by', Auth::user()->id);
   }
}
