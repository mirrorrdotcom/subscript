<?php

namespace App\Models;

use App\Contracts\Auditable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consumer extends Model implements Auditable
{
    use Authenticatable, SoftDeletes;

    public const TOKEN_LENGTH = 60;

    protected $fillable = [
        "name", "description", "is_active",
    ];

    protected $guarded = [
        "api_token",
    ];

    protected $casts = [
        "is_active" => "boolean",
    ];
}
