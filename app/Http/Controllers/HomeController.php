<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Stripe\Charge;

use Laravel\Cashier\Cashier;

class HomeController extends Controller
{
    public function home()
    {

        $products = Product::latest()->paginate(15);
        return view('welcome', compact('products'));
    }

    public function productDetails($id)
    {
        $user = auth()->user();

        $intent = $user->createSetupIntent();

        $product = Product::find(decrypt($id));
        return view('view', compact('product', 'intent'));
    }

    public function singleCharge(Request $request)
    {
        $amount = $request->amount;
        $amount = $amount * 100;
        $paymentMethod = $request->payment_method;

        $user = auth()->user();
        $user->createOrGetStripeCustomer();

        if ($paymentMethod != null) {
            $paymentMethod = $user->addPaymentMethod($paymentMethod);
        }

        $payment = $user->charge(
            $amount,
            $paymentMethod->id,
            [
                'off_session' => true,
                'return_url' => route('home'),
                'description' => 'Test description', // Replace with the route to your payment completion page
                'currency' => 'usd',
                'shipping' => [
                    'name' => $user->name,
                     'address' => ["line1" => "test address line1","state"=>"Florida","postal_code"=>34787,"country"=>"US",]
                 ]
            ]

        );

        $order = Order::create([
            'user_id' => $user->id,
            'product_id' =>decrypt($request->id),
            'status' => $payment->status,
            'comment' => 'comment',
            'stripe_payment_id' => $payment->id
        ]);

        if($payment->status == "succeeded"){
            return to_route('home')->with("success","Successfully done the purchase");
        }else{
            return to_route('home')->with("error","Error:Please contact administrator");
        }

    }


}
