<?php

namespace App\Payments\Checkout;


class FailedPaymentResponse implements PaymentResponseInterface
{
    public function getApproved()
    {
        return false;
    }
}