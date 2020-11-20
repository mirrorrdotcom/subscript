<?php

namespace App\Payments\Checkout;

use Checkout\CheckoutApi;
use Checkout\Models\Payments\IdSource;
use Checkout\Models\Payments\Payment;
use Checkout\Models\Payments\Source;
use Checkout\Models\Payments\TokenSource;
use Checkout\Models\Tokens\Card;
use Exception;

class Checkout
{
    protected $checkoutApi;
    protected $paymentResponse;

    public function __construct()
    {
        $this->checkoutApi = new CheckoutApi(env('CHECKOUT_SECRET'), env('CHECKOUT_SANDBOX_ENV'), env('CHECKOUT_PUBLIC'));
    }

    public function performPayment(Source $source, $amount = 0, $currency = 'USD') : PaymentResponseInterface
    {
        try {
            $payment = new Payment($source, $currency);
            $payment->amount = $amount;

            return $this->paymentResponse = new PaymentResponse($this->checkoutApi->payments()->request($payment));
        } catch (Exception $exception) {
            return $this->paymentResponse = new FailedPaymentResponse();
        }
    }

    public function verifyCard($cardDetails)
    {
        try {
            $token = $this->requestToken($cardDetails);
            $this->performTokenPayment($token);
            return $this->paymentResponse->getApproved();
        } catch (Exception $exception) {
            //TODO:: Add logs
            return false;
        }
    }

    public function performTokenPayment($token, $amount = 0, $currency = 'USD')
    {
        return $this->performPayment(new TokenSource($token), $amount, $currency);
    }

    public function performExistingSourcePayment($source, $amount = 0, $currency = 'USD')
    {
        return $this->performPayment(new IdSource($source), $amount, $currency);
    }

    public function requestToken($cardDetails)
    {
        $card = new Card($cardDetails['card_number'], $cardDetails['expiry_month'], $cardDetails['expiry_year']);
        $response = $this->checkoutApi->tokens()->request($card);

        return $response->getValue('token');
    }

    public function getValue($value)
    {
        return isset($this->paymentResponse) ? $this->paymentResponse->getValue($value) : null;
    }

    public function getPaymentResponse()
    {
        return $this->paymentResponse;
    }

    public function getSource()
    {
        return $this->paymentResponse->getSource();
    }

    public function getSourceId()
    {
        return $this->getSource()['id'];
    }

    public function paymentApproved()
    {
        return $this->paymentResponse->getApproved();
    }
}