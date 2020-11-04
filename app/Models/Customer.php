<?php

namespace App\Models;

use App\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model implements Auditable
{
    use SoftDeletes;

    protected $fillable = [
        "name", "description", "is_active", "plan_id", "subscription_date", "email"
    ];

    protected $casts = [
        "is_active" => "boolean"
    ];

    protected $attributes = [
        "is_active" => true
    ];

    public function plan() : BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
}
