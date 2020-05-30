<?php

namespace App\Models;

use App\Contracts\Auditable;
use App\QueryBuilders\SubscriptionModelQueryBuilder;
use App\Traits\HasRtf;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionModel extends Model implements Auditable
{
    use SoftDeletes, HasRtf;

    protected $fillable = [
        "slug", "name", "description", "is_active"
    ];

    protected $casts = [
        "is_active" => "boolean"
    ];

    protected $attributes = [
        "is_active" => true
    ];

    public function newEloquentBuilder($query)
    {
        return new SubscriptionModelQueryBuilder($query);
    }

    public function getStrippedDescriptionAttribute(): string
    {
        return $this->stripRtfField("description", 20);
    }

    public function plans(): HasMany
    {
        return $this->hasMany(
            Plan::class,
            "subscription_model_id",
            "id"
        );
    }

    public function features(): HasMany
    {
        return $this->hasMany(
            Feature::class,
            "subscription_model_id",
            "id"
        );
    }
}
