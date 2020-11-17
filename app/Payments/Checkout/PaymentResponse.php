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

    public function getApproved()
    {
        return $this->getValue('approved');
    }

    public function getValue($value)
    {
        return $this->response->getValue($value);
    }

    public function getCurrency()
    {
        return $this->getValue('currency');
    }

    public function getAmount()
    {
        return $this->getValue('amount');
    }

    public function getReference()
    {
        return $this->getValue('reference');
    }

    public function getAuthCode()
    {
        return $this->getValue('auth_code');
    }

    public function getEci()
    {
        return $this->getValue('eci');
    }

    public function getResponseCode()
    {
        return $this->getValue('response_code');
    }

    public function getResponseSummary()
    {
        return $this->getValue('response_summary');
    }

    public function getSchemeId()
    {
        return $this->getValue('scheme_id');
    }

    public function getStatus()
    {
        return $this->getValue('status');
    }
}