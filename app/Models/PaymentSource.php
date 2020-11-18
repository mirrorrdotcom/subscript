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

    public static function addCardSource(Card $card, $source)
    {
        $paymentSource = new PaymentSource();
        $paymentSource->source = $source;
        $paymentSource->sourceable_id = $card->id;
        $paymentSource->sourceable_type = Card::class;
        $paymentSource->save();

        return $paymentSource;
    }
}
