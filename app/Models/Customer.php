<?php

namespace App\Models;

use App\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model implements Auditable
{
    use SoftDeletes;

    protected $fillable = [
        "name", "description", "is_active"
    ];

    protected $casts = [
        "is_active" => "boolean"
    ];

    protected $attributes = [
        "is_active" => true
    ];
}
