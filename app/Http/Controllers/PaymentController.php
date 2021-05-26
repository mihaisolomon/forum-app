<?php


namespace App\Http\Controllers;


use Laravel\Cashier\Cashier;
use Laravel\Cashier\Http\Middleware\VerifyRedirectUrl;
use Laravel\Cashier\Payment;
use Stripe\PaymentIntent as StripePaymentIntent;

class PaymentController extends Controller
{
    /**
     * Create a new PaymentController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(VerifyRedirectUrl::class);
    }

    /**
     * Display the form to gather additional payment verification for the given payment.
     *
     * @param  string  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $user = auth()->user();

        $stripeAccount = $this->country->stripeAccount;

        return view('cashier::payment', [
            'stripeKey' => $stripeAccount->key,
            'payment' => new Payment(
                StripePaymentIntent::retrieve($id, $user->stripeOptions())
            ),
            'redirect' => url(request('redirect', '/')),
        ]);
    }
}
