<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alsoLike=Product::alsoLike();
        $productInCart=[];
        $totalPrice=0;
        if(auth()->user()){
        $productInCart=auth()->user()->cart;
        foreach($productInCart as $index=>$product){
            $totalPrice+=$product->price * $product->pivot->number;
        }
        
    }
        return Inertia::render('Cart',compact(['alsoLike','productInCart','totalPrice']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $product=Product::find($request->product_id);
        if(auth()->user()){
            if(auth()->user()->cart->contains($request->product_id)){
                $number=auth()->user()->cart()->where('product_id',$product->id)->first()->pivot->number;
                auth()->user()->cart()->updateExistingPivot($request->product_id,['number'=>$number+1]);
            }else{
                $request->user()->cart()->attach($request->product_id);
            }
        }else{
            return redirect()->back()->with(['status'=>'false','msg'=>'You must have an account']);
        }
            
        return redirect()->back()->with(['status'=>'true','msg'=>'The product has been added to the cart']);
        
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
    public function destroy($product_id)
    {
        auth()->user()->cart()->detach($product_id);
        return redirect()->back()->with(['msg'=>'The product has been removed from the cart']);
    }
    public function deleteOne($product_id)
    {

        $oldQuantity=auth()->user()->cart()->where('product_id',$product_id)->first()->pivot->number;
        if($oldQuantity > 1){
            auth()->user()->cart()->where('product_id',$product_id)->updateExistingPivot($product_id,['number'=>--$oldQuantity]);
            return redirect()->back()->with(['msg'=>'One piece removed from the product']);
        }else{
            auth()->user()->cart()->detach($product_id);

            return redirect()->back()->with(['msg'=>'The product has been removed from the cart']);
        }
    }
}
