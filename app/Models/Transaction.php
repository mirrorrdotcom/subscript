<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    public const ERROR = -3;
    public const NOT_ENOUGH_BALANCE = -2;
    public const FAILED = -1;
    public const INITIATED = 0;
    public const SUCCESS = 1;

    protected $fillable = [
        "customer_id", "action", "description", "status", "balance_before", "balance_after", "amount"
    ];

    public function customer() : BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
