<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consumer extends Model
{
    use Authenticatable, SoftDeletes;

    protected $casts = [
        "is_active" => "boolean",
    ];
}
