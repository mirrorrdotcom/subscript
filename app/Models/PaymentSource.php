<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSource extends Model
{
    protected $table = 'sources';

    public function sourceable()
    {
        return $this->morphTo();
    }

    //TODO:: refactor
    public static function addCardSource(Card $card, $source, $customerId)
    {
        $paymentSource = new PaymentSource();
        $paymentSource->customer_id = $customerId;
        $paymentSource->source = $source;
        $paymentSource->sourceable_id = $card->id;
        $paymentSource->sourceable_type = Card::class;
        $paymentSource->save();

        return $paymentSource;
    }
}
