<?php

namespace App\Models;

use App\Actions\Plans\UpdateCustomerPlanAction;
use App\Contracts\Auditable;
use App\Payments\Checkout\Checkout;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function payments() : HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function cards() : HasMany
    {
        return $this->hasMany(Card::class);
    }

    public function sources() : HasMany
    {
        return $this->hasMany(PaymentSource::class);
    }

    public function getPrimarySourceAttribute()
    {
        foreach ($this->sources as $source) {
            if ($source->primary) {
                return $source;
            }
        }

        return null;
    }

    public function getPlanAttribute()
    {
        foreach ($this->plans as $plan) {
            if ($plan->isActive()) {
                return $plan;
            }
        }
        return null;
    }

    public function planExpired($plan)
    {
        return isset($plan->pivot->deleted_at) ||
            (new Carbon($plan->pivot->end_date))->lessThan(Carbon::now()->toDate());
    }

    public function payForPlanAndActivateIt(Plan $plan)
    {
        if (! $this->payForPlan($plan)) {
            return false;
        }

        if (! $this->activatePlan($plan)) {
            return false;
        }

        return true;
    }

    //TODO: refactor the implementation
    public function payForPlan(Plan $plan)
    {
        $checkout = new Checkout();
        if (! empty($this->primarySource)) {
            $checkout->performExistingSourcePayment($this->primarySource->source, $plan->getAmount());

            if ($checkout->paymentApproved()) {
                return true;
            }
        }

        foreach ($this->sources as $source) {
            $checkout->performExistingSourcePayment($source->source, $plan->getAmount());
            if ($checkout->paymentApproved()) {
                return true;
            }
        }

        return false;
    }

    public function activatePlan(Plan $plan)
    {
        $startDate = Carbon::now()->toDateTimeString();

        if (! empty($this->plan)) {
            $startDate = $this->plan->pivot->end_date;
        }

        return (new UpdateCustomerPlanAction())->execute($this,
            ['start_date' => $startDate, 'plan_id' => $plan->id]);
    }

    public function isSubscribedToPlan(Plan $plan)
    {
        return ! empty($this->plan) && $this->plan->id == $plan->id;
    }

    public function hasUpcomingPlan()
    {
        foreach ($this->plans as $plan) {
            if (Carbon::now()->isBefore(Carbon::createFromDate($plan->pivot->start_date))) {
                return true;
            }
        }

        return false;
    }
}
