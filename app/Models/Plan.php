<?php

namespace App\Models;

use App\Contracts\Auditable;
use App\Traits\HasRtf;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model implements Auditable
{
    use SoftDeletes, HasRtf;

    protected $fillable = [
        "subscription_model_id", "slug", "name", "description", "is_active",
        "trial_period", "trial_interval", "recurring_period",
        "recurring_interval", "grace_period", "grace_interval", "sort_order"
    ];

    protected $casts = [
        "is_active" => "boolean"
    ];

    protected $attributes = [
        "is_active" => true,
        "sort_order" => 0
    ];

    public function getStrippedDescriptionAttribute(): string
    {
        return $this->stripRtfField("description", 20);
    }

    public function subscription_model(): BelongsTo
    {
        return $this->belongsTo(
            SubscriptionModel::class,
            "subscription_model_id",
            "id"
        );
    }
}
