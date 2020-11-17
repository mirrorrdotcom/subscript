<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Card;
use App\Models\Customer;
use Illuminate\Http\Request;

class CardsController extends Controller
{
    public function get(Customer $customer)
    {
        $cards = Card::select(['id', 'scheme', 'last_four', 'card_type', 'issuer'])
            ->where('customer_id', $customer->id)
            ->get();

        return $cards->makeHidden('last_four');
    }
}
