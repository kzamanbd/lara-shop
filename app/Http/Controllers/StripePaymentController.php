<?php

namespace App\Http\Controllers;

use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */

    public function stripe()
    {
        return view('frontend.payment');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => 100 * $request->payment,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from zaman.com."
        ]);

        Shipping::where('customer_id', Auth::id())->update([
            'payment_status'  => 1,
            'updated_at'    => now(),
        ]);

        Session::flash('success', 'Payment successful!');
        if (Session::has('sub_total')) {
            Session::forget('sub_total');
        }
        return back();
    }
}
