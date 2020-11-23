<?php

namespace App\Console\Commands;

use App\Actions\Subscriptions\RenewCustomerSubscriptionAction;
use App\Models\CustomerPlan;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RenewSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscript:renew';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to renew the subscriptions for the customers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $customerPlansExpiring = $this->getPlansToBeRenewed();

        foreach ($customerPlansExpiring as $customerPlan) {
            (new RenewCustomerSubscriptionAction())->execute($customerPlan->customer, $customerPlan->plan);
        }
    }

    private function getPlansToBeRenewed()
    {
        return CustomerPlan::with(['plan', 'customer'])
            ->where('renew', 1)
            ->whereDate('end_date', Carbon::now()->toDateString())
            ->whereNull('deleted_at')
            ->get();
    }
}
