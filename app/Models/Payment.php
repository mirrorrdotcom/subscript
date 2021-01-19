<?php

namespace App\Models;

use App\Payments\Checkout\PaymentResponse;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function source()
    {
        return $this->belongsTo(PaymentSource::class);
    }

    public function payable()
    {
        return $this->morphTo();
    }

    public static function generatePaymentFromPaymentResponse(PaymentResponse $response)
    {
        $payment = new Payment();

        $payment->payment_id = $response->getValue('id');
        $payment->eci = $response->getEci() ?? '';
        $payment->scheme_id = $response->getSchemeId() ?? '';
        $payment->response_code = $response->getResponseCode() ?? '';
        $payment->response_summary = $response->getResponseSummary() ?? '';
        $payment->auth_code = $response->getAuthCode() ?? '';
        $payment->currency = $response->getCurrency() ?? '';
        $payment->amount = $response->getAmount() ?? '';
        $payment->reference = $response->getReference() ?? '';
        $payment->status = $response->getStatus() ?? '';
        $payment->approved = $response->getApproved() ?? '';

        return $payment;
    }

    public function addPlan($planId)
    {
        $this->payable_id = $planId;
        $this->payable_type = Plan::class;
        return $this;
    }

    public function addSource($sourceId)
    {
        $this->source_id = $sourceId;
        return $this;
    }

    public function addCustomer($customerId)
    {
        $this->customer_id = $customerId;
        return $this;
    }
}
