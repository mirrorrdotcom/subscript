<?php

namespace App\Payments\Checkout;


class PaymentResponse
{
    protected $response;
    protected $source;
    protected $customer;

    public function __construct($response)
    {
        $this->response = $response;
        $this->source = $response->getValue('source');
        $this->customer = $response->getValue('customer');
    }

    public function getCheckoutResponse()
    {
        return $this->response;
    }

    public function getCustomer()
    {
        return $this->customer;
    }

    public function getSource()
    {
        return $this->source;
    }

    public function paymentWasApproved()
    {
        return $this->getValue('approved');
    }

    public function getValue($value)
    {
        return $this->response->getValue($value);
    }
}