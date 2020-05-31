<?php

namespace App\Models;

use App\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model implements Auditable
{
    use SoftDeletes;

    protected $fillable = [
        "name", "code", "symbol", "rate", "is_active"
    ];

    protected $casts = [
        "is_active" => "boolean"
    ];

    protected $attributes = [
        "is_active" => true
    ];
}
