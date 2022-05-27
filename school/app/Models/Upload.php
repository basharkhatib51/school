<?php

namespace App\Models;

use App\Traits\ObservantTrait;
use Illuminate\Database\Eloquent\Model;
/**
 * @method static create(array $validated)
 */
class Upload extends Model
{
    use ObservantTrait;
}
