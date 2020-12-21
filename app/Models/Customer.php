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

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public function plans() : BelongsToMany
    {
        return $this->belongsToMany(Plan::class)
            ->whereNull('customer_plan.deleted_at')
            ->withPivot(['renew', 'start_date', 'end_date', 'deleted_at']);
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
            $response = $checkout->performExistingSourcePayment($this->primarySource->source, $plan->getAmount());
            if ($response->getApproved()) {
                $payment = Payment::generatePaymentFromPaymentResponse($checkout->getPaymentResponse());
                $payment->addPlan($plan->id)
                    ->addCustomer($this->id)
                    ->addSource($this->primarySource->id)->save();
                if ($checkout->paymentApproved()) {
                    return true;
                }
            }
        }

        foreach ($this->sources as $source) {
            $response = $checkout->performExistingSourcePayment($source->source, $plan->getAmount());

            if (! $response->getApproved()) {
                continue;
            }
            $payment = Payment::generatePaymentFromPaymentResponse($checkout->getPaymentResponse());
            $payment->addPlan($plan->id)->addCustomer($this->id)->addSource($source->id)->save();
            if ($checkout->paymentApproved()) {
                return true;
            }
        }

        return false;
    }

    public function activatePlan(Plan $plan)
    {
        $activePlan = $this->plan;

        $subscribed = $this->updateCustomerPlan($plan);

        if (! empty($activePlan)) {
            $this->plans()->updateExistingPivot($this->plan, ['renew' => 0]);
        }

        return $subscribed;
    }

    private function updateCustomerPlan(Plan $plan)
    {
        $startDate = Carbon::now()->toDateTimeString();

        if ($this->newPlanIsADowngrade($plan)) {
            $startDate = $this->plan->pivot->end_date;
        }

        return (new UpdateCustomerPlanAction())->execute($this,
            ['start_date' => $startDate, 'plan_id' => $plan->id]);
    }

    private function newPlanIsADowngrade($plan)
    {
        return ! empty($this->plan) && $this->plan->sort_order > $plan->sort_order;
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
