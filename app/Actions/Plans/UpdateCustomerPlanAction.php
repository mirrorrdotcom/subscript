<?php

namespace App\Actions\Plans;

use App\Actions\AbstractUpdateAction;
use App\Contracts\AuditAction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UpdateCustomerPlanAction extends AbstractUpdateAction implements AuditAction
{
    private $startDate;

    protected function update(Model $model, array $data)
    {
        $this->unsubscribeFromExistingPlan($model);

        $this->startDate = $data['start_date'];

        $model->plans()->attach($data['plan_id'], array(
            'start_date' => $this->startDate,
            'end_date' => $this->calculateEndDate())
        );
    }

    private function calculateEndDate()
    {
        //TODO::calculate end date
        return Carbon::now()->addWeek()->toDateTimeString();
    }

    private function unsubscribeFromExistingPlan($model)
    {
        if (! empty(($model->plan))) {
            DB::table('customer_plan')
                ->where('customer_id', $model->id)
                ->where('plan_id', $model->plan->id)
                ->update(array('deleted_at' => DB::raw('NOW()')));
        }
    }
}
