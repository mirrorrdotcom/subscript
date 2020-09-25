<?php

namespace App\Actions;

use App\Models\Customer;
use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\Log;

abstract class AbstractTransactionAction
{
    protected $customer;
    protected $amount;
    protected $transaction;

    public function execute(Customer $customer, $amount) : bool
    {
        $this->customer = $customer;
        $this->amount = $amount;

        $this->initiateTransaction();

        try {
            if (! $this->performAction()) {
                $this->updateTransactionStatusIfNull();
                return false;
            }

            $this->updateTransaction(Transaction::SUCCESS, $this->getBalanceAfter());
            return true;
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            $this->updateTransaction(Transaction::ERROR, $this->customer->balance);
            return false;
        }
    }

    private function updateTransactionStatusIfNull()
    {
        if (is_null($this->transaction->status)) {
            $this->updateTransaction(Transaction::FAILED, $this->customer->balance);
        }
    }

    private function initiateTransaction() : void
    {
        $this->transaction = new Transaction(array(
            "customer_id" => $this->customer->id,
            "amount" => $this->amount,
            "balance_before" => $this->customer->balance,
            "action" => $this->getActionName(),
        ));
    }

    protected function updateTransaction($status, $balanceAfter)
    {
        $this->transaction->balance_after = $balanceAfter;
        $this->transaction->status = $status;
        $this->transaction->save();
    }

    protected abstract function performAction() : bool;

    protected abstract function getActionName() : string;

    protected abstract function getBalanceAfter();
}
