<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterKey extends Model
{
    protected $fillable = [
        'email',
        'key',
        'ip_address',
        'status',
    ];
    use HasFactory;
}
