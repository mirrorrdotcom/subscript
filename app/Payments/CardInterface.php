<?php

namespace App\Payments;

interface CardInterface
{
    public function getExpiryMonth();

    public function getExpiryYear();

    public function getScheme();

    public function getLastFour();

    public function getFingerPrint();

    public function getBIN();

    public function getCardType();

    public function getCardCategory();

    public function getIssuer();

    public function getIssuerCountry();

    public function getProductId();

    public function getProductType();

    public function getAVSCheck();

    public function getCVVCheck();

    public function getAllowsPayout();
}