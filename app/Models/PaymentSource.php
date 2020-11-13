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
}
