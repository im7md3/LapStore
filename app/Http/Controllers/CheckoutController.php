<?php

namespace App\Http\Controllers;

use App\Mail\OrderEmail;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cartalyst\Stripe\Stripe;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    public function __construct()
    {
    }
    public function index(Request $request)
    {

        $alsoLike = Product::alsoLike();
        $productInCart = [];
        $totalPrice = 0;

        $intent = '';

        if (auth()->user()) {
            if (auth()->user()->cart()->count() > 0) {
                $productInCart = auth()->user()->cart;
                $totalPrice = auth()->user()->price();
            }



            return Inertia::render('Check', compact(['alsoLike', 'productInCart', 'totalPrice', 'intent']));
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /* public function checkout()
    {
        \Stripe\Stripe::setApiKey('sk_test_51Ig42vK2qaZSidyMIXiXoiEhG7p8uvX6u2UrM4t7z0DiyJw5CE8ubhaweszotY1IJpquzLbuKoagKsHZDzP0LaRb00Kvj1d6mC');
		$amount = 100;
		$amount *= 100;
        $amount = (int) $amount;
        
        $payment_intent = \Stripe\PaymentIntent::create([
			'description' => 'Stripe Test Payment',
			'amount' => $amount,
			'currency' => 'INR',
			'description' => 'Payment From Codehunger',
			'payment_method_types' => ['card'],
		]);
		$intent = $payment_intent->client_secret;

		return Inertia::render('Check',compact('intent'));
    } */

    public function afterpayment(Request $request)
    {
        $order = Order::insertGetId([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'billing_email' => $request->email,
            'billing_name' => $request->name,
            'billing_address' => $request->address,
            'billing_city' => $request->city,
            'billing_province' => $request->province,
            'billing_postcode' => $request->postcode,
            'billing_phone' => $request->phone,
            'billing_name_on_card' => $request->name_on_card,
            'billing_discount' => 10,
            'billing_discount_code' => "ABC123",
            'billing_subtotal' => $request->total,
            'billing_tax' => 21,
            'billing_total' => $request->total,
            'error' => null,
        ]);

        foreach (auth()->user()->cart as $item) {
            OrderProduct::create([
                'order_id' => $order,
                'product_id' => $item->id,
                'quantity' => $item->pivot->number,
            ]);
        }
        $stripe = Stripe::make(env('STRIPE_SECRET'));
        $affected = DB::table('cart')->update(array('bought' => 1)); 
        $charge = $stripe->charges()->create([
            'amount' => $request->total,
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'description' => 'Order',
            'receipt_email' => $request->email,
            'metadata' => [
                'quantity' => 50
            ],
        ]);  
        \Mail::to( $request->email)->send(new OrderEmail());
        return redirect()->route('thank');
    }


    
}
