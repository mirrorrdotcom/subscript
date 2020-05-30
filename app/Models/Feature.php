<?php

namespace App\Models;

use App\Contracts\Auditable;
use App\QueryBuilders\FeatureQueryBuilder;
use App\Traits\HasRtf;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends Model implements Auditable
{
    use SoftDeletes, HasRtf;

    protected $fillable = [
        "subscription_model_id", "slug", "name", "description", "is_active",
        "limit"
    ];

    protected $casts = [
        "is_active" => "boolean"
    ];

    protected $attributes = [
        "is_active" => true
    ];

    public function newEloquentBuilder($query)
    {
        return new FeatureQueryBuilder($query);
    }

    public function getStrippedDescriptionAttribute(): string
    {
        return $this->stripRtfField("description", 20);
    }

    public function getIsInfiniteAttribute(): bool
    {
        return $this->limit == null;
    }

    public function subscription_model(): BelongsTo
    {
        return $this->belongsTo(
            SubscriptionModel::class,
            "subscription_model_id",
            "id"
        );
    }

    public function plans(): BelongsToMany
    {
        return $this->belongsToMany(
            Plan::class,
            "feature_plan",
            "feature_id",
            "plan_id"
        );
    }
}
