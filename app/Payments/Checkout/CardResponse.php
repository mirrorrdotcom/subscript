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

    public function getExpiryMonth()
    {
        return $this->source['expiry_month'];
    }

    public function getExpiryYear()
    {
        return $this->source['expiry_year'];
    }

    public function getScheme()
    {
        return $this->source['scheme'];
    }

    public function getLastFour()
    {
        return $this->source['last4'];
    }

    public function getFingerPrint()
    {
        return $this->source['fingerprint'];
    }

    public function getBIN()
    {
        return $this->source['bin'];
    }

    public function getCardType()
    {
        return $this->source['card_type'];
    }

    public function getCardCategory()
    {
        return $this->source['card_category'];
    }

    public function getIssuer()
    {
        return $this->source['issuer'];
    }

    public function getIssuerCountry()
    {
        return $this->source['issuer_country'];
    }

    public function getProductId()
    {
        return $this->source['product_id'];
    }

    public function getProductType()
    {
        return $this->source['product_type'];
    }

    public function getAVSCheck()
    {
        return $this->source['avs_check'];
    }

    public function getCVVCheck()
    {
        return $this->source['cvv_check'];
    }

    public function getAllowsPayout()
    {
        return $this->source['payouts'];
    }
}