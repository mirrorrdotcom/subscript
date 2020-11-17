<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Payments\CardInterface;

class Card extends Model
{
    protected $appends = ['card_number'];

    public function source()
    {
        return $this->morphOne(PaymentSource::class, 'sourceable');
    }

    public function getCardNumberAttribute()
    {
        return 'xxxx-xxxx-xxxx-'.$this->last_four;
    }

    //TODO::Refactor
    public static function addCardFromPaymentResponse(Customer $customer, CardInterface $cardResponse)
    {
        $card = new self();
        $card->customer_id = $customer->id;
        $card->expiry_month = $cardResponse->getExpiryMonth();
        $card->expiry_year = $cardResponse->getExpiryYear();
        //TODO:: fix name to match the card's name
        $card->name = $customer->name;
        $card->scheme = $cardResponse->getScheme();
        $card->last_four = $cardResponse->getLastFour();
        $card->fingerprint = $cardResponse->getFingerPrint();
        $card->bin = $cardResponse->getBIN();
        $card->card_type = $cardResponse->getCardType();
        $card->card_category = $cardResponse->getCardCategory();
        $card->issuer = $cardResponse->getIssuer();
        $card->country = $cardResponse->getIssuerCountry();
        $card->product_id = $cardResponse->getProductId();
        $card->product_type = $cardResponse->getProductType();
        $card->avs_check = $cardResponse->getAVSCheck();
        $card->cvv_check = $cardResponse->getCVVCheck();
        $card->payouts = $cardResponse->getAllowsPayout();
        $card->save();

        return $card;
    }
}
