<?php

namespace App\Models;

use App\Contracts\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model implements Auditable
{
    use SoftDeletes;

    protected $fillable = [
        "name", "description", "is_active", "email"
    ];

    protected $casts = [
        "is_active" => "boolean"
    ];

    protected $attributes = [
        "is_active" => true
    ];

    protected $appends = [
        'plan'
    ];

    public function plans() : BelongsToMany
    {
        return $this->belongsToMany(Plan::class)->withPivot(['start_date', 'end_date', 'deleted_at']);
    }

    public function getPlanAttribute()
    {
        foreach ($this->plans as $plan) {
            if (! $this->planExpired($plan)) {
                return $plan;
            }
        }
    }

    public function planExpired($plan)
    {
        return isset($plan->pivot->deleted_at) ||
            (new Carbon($plan->pivot->end_date))->lessThan(Carbon::now()->toDate());
    }
}
