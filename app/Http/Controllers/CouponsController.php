<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    
    public function addCoupon(Request $request)
    {
        $discount=0;
        $code='';
        $totalPrice=auth()->user()->price();
        if ($request->coupon) {
            $coupon=Coupon::where('code',$request->coupon)->first();
            if($coupon){
                $code=$coupon->code;
                $discount=$coupon->discount($totalPrice);
                $totalPrice-=$discount;
            }
        }
        return redirect()->back()->with(['discount'=>$discount,'code'=>$code]);
    }

    
    
}
