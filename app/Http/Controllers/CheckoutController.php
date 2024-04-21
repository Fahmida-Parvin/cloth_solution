<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class CheckoutController extends Controller
{
    public function stripeCheckout(Request $request)
    {
        $request->validate([
            'payment_method_id' => 'required',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|max:255',
        ]);

        // Set your Stripe API key
        Stripe::setApiKey("sk_test_51OTOzrBDd4sK1N1Zlre6ZRbXYG90eLVnN9DhjuBM5xVeeCetxtVmFavyKjoV5o7pfUsG4oZmKYgHJeqZTTbqoQIX00WZYPzeYL");

        try {
            // Create a payment intent
            $paymentIntent = $this->createPaymentIntent($request->payment_method_id);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Handle API errors
            return response()->json(['error' => $e->getMessage()]);
        }

        // Create an order
        $order = $this->createOrder($request, $paymentIntent);

        // Clear the cart after a successful order
        session()->forget('cart');

        // Redirect to the success page with order information
        return view('pages.orderSuccess', ['order' => $order]);
    }

    protected function createPaymentIntent($paymentMethodId)
    {
        return PaymentIntent::create([
            'payment_method' => $paymentMethodId,
            'amount' => Cart::totalAmount() * 100,
            'currency' => 'usd',
            'confirmation_method' => 'manual',
            'confirm' => true,
            'return_url' => route('success'), // Specify your success route here
        ]);
    }

    protected function createOrder(Request $request, $paymentIntent)
    {
        // Create an order in the database
        $order = Order::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'zip' => $request->zip,
            'stripe_id' => $paymentIntent->id,
            'status' => 'pending',
            'total' => Cart::totalAmount() * 100,
        ]);

        // Iterate through cart items and directly insert into the database
        foreach (session()->get('cart') as $item) {
            $order->items()->create([
                'product_id' => $item['product']['id'],
                'color_id' => $item['color']['id'],
                'quantity' => $item['quantity'],
                // Add other necessary fields
            ]);
        }

        // Return the created order
        return $order;
    }
}
