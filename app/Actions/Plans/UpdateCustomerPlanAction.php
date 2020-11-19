<?php

namespace App\Actions\Plans;

use App\Actions\AbstractUpdateAction;
use App\Contracts\AuditAction;
use App\Models\Plan;
use App\Services\TimeInterval;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UpdateCustomerPlanAction extends AbstractUpdateAction implements AuditAction
{
    private $startDate;
    private $plan;

    protected function update(Model $model, array $data)
    {
        $this->startDate = $data['start_date'];

        $this->plan = Plan::find($data['plan_id']);

        $model->plans()->attach($this->plan->id, array(
            'start_date' => $this->startDate,
            'end_date' => $this->calculateEndDate())
        );
    }

    private function calculateEndDate()
    {
        $interval = TimeInterval::mappedIntervalsArray()[$this->plan->recurring_interval];

        return Carbon::createFromDate($this->startDate)->{"add$interval"}($this->plan->recurring_period)->toDateTimeString();
    }
}
