<?php

namespace App\Actions\Plans;

use App\Actions\AbstractUpdateAction;
use App\Contracts\AuditAction;
use App\Models\Plan;
use App\Services\TimeInterval;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UpdateCustomerPlanAction extends AbstractUpdateAction implements AuditAction
{
    private $startDate;
    private $plan;

    protected function update(Model $model, array $data)
    {
        $this->unsubscribeFromExistingPlan($model);

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

        return Carbon::now()->{"add$interval"}($this->plan->recurring_period)->toDateTimeString();
    }

    private function unsubscribeFromExistingPlan($model)
    {
        if (! empty(($model->plan))) {
            DB::table('customer_plan')
                ->where('customer_id', $model->id)
                ->where('plan_id', $model->plan->id)
                ->where('deleted_at', null)
                ->update(array('deleted_at' => DB::raw('NOW()')));
        }
    }
}
