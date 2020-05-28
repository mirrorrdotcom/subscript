<?php

namespace App\Models;

use App\QueryBuilders\SubscriptionModelQueryBuilder;
use App\Traits\HasRtf;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionModel extends Model
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
}
