<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\Card\CreateCardRequest;
use App\Models\Card;
use App\Models\Customer;
use App\Models\PaymentSource;
use App\Payments\Checkout\CardResponse;
use App\Payments\Checkout\Checkout;

class CardsController extends Controller
{
    public function get(Customer $customer)
    {
        $cards = Card::select(['id', 'scheme', 'last_four', 'card_type', 'issuer'])
            ->where('customer_id', $customer->id)
            ->get();

        return $cards->makeHidden('last_four');
    }

    public function store(Customer $customer, CreateCardRequest $request)
    {
        $checkout = new Checkout();

        if (! $checkout->verifyCard($request->validated())) {
            return response()->json([
                'message' => 'Failed to verify the card'
            ]);
        }

        $fingerPrint = (new CardResponse($checkout->getSource()))->getFingerPrint();

        $existingCard = Card::getCardIfFingerPrintExistsForCustomer($customer, $fingerPrint);

        if (! empty($existingCard)) {
            return response()->json([
                'card' => $existingCard,
                'message' => 'Card already exists'
            ]);
        }

        $card = Card::createCardFromPaymentResponse($customer, new CardResponse($checkout->getSource()));
        $paymentSource = PaymentSource::addCardSource($card, $checkout->getSourceId(), $customer->id);
        $card = $card->updatePaymentSource($paymentSource);

        return response()->json($card->only('id', 'scheme', 'card_type', 'issuer'), 201);
    }
}
