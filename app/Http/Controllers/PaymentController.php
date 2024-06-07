<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function showPayment($id)
    {
        $package=Package::find($id);
        // Set your Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Create a new Checkout Session
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'unit_amount' => $package->price * 100, // Convert to cents
                        'product_data' => [
                            'name' => $package->type . ' - ' . $package->state->name,                        ],
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('payment.success', ['id' => $package->id]), // Point to the success handler
            'cancel_url' => route('home'),
        ]);

        // Retrieve the session ID
        $sessionId = $session->id;

        // Redirect the user to the Checkout page
        return redirect()->away($session->url);
    }
    public function handlePaymentSuccess($id)
    {
        // Retrieve the package using the provided ID
        $package = Package::find($id);

        // Check if the package exists and the user is authenticated
        if ($package && Auth::check()) {
            // Create a new order
            $order = new Order();
            $order->user_id = Auth::id(); // Set the user_id to the authenticated user's ID
            $order->package_id = $package->id; // Set the package_id to the purchased package's ID
            $order->status = 1; // Set the status to 0 (not paid)
            $order->save(); // Save the order to the database

            // Redirect to a page to show a success message or further instructions
            return redirect()->route('profile.show');
        } else {
            // Redirect to a page to show an error message or take other actions
            return redirect()->route('order.error');
        }
    }
}
