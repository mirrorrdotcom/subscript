<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public function source()
    {
        return $this->morphOne(PaymentSource::class, 'sourceable');
    }
}
