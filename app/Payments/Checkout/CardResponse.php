<?php

namespace App\Payments\Checkout;

use App\Payments\CardInterface;


class CardResponse implements CardInterface
{
    protected $source;

    public function __construct($source)
    {
        $this->source = $source;
    }

    private function getValue($value)
    {
        return isset($this->source[$value]) ? $this->source[$value] : null;
    }

    public function getExpiryMonth()
    {
        return $this->getValue('expiry_month');
    }

    public function getExpiryYear()
    {
        return $this->getValue('expiry_year');
    }

    public function getScheme()
    {
        return $this->getValue('scheme');
    }

    public function getLastFour()
    {
        return $this->getValue('last4');
    }

    public function getFingerPrint()
    {
        return $this->getValue('fingerprint');
    }

    public function getBIN()
    {
        return $this->getValue('bin');
    }

    public function getCardType()
    {
        return $this->getValue('card_type');
    }

    public function getCardCategory()
    {
        return $this->getValue('card_category');
    }

    public function getIssuer()
    {
        return $this->getValue('issuer');
    }

    public function getIssuerCountry()
    {
        return $this->getValue('issuer_country');
    }

    public function getProductId()
    {
        return $this->getValue('product_id');
    }

    public function getProductType()
    {
        return $this->getValue('product_type');
    }

    public function getAVSCheck()
    {
        return $this->getValue('avs_check');
    }

    public function getCVVCheck()
    {
        return $this->getValue('cvv_check');
    }

    public function getAllowsPayout()
    {
        return $this->getValue('payouts');
    }
}