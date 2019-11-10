<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::where('session_id', session()->getId())->get();
        return view('frontend.product-carts',['carts' => $carts]);
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
        $this->validate($request,[
            'product_id' => 'required',
        ]);
        $product = Product::findOrfail($request->product_id);
        if ($product->quantity > 0){
            if(Cart::where('product_id', $product->id)->exists() && Cart::where('session_id', session()->getId())->exists()){
                $cart = Cart::where('product_id', $product->id);
                if ($request->quantity) {
                   $cart->update([
                        'quantity' => $request->quantity,
                    ]); 
                }
                else{
                    $cart->increment('quantity');  
                }
            }
            else{
                Cart::create([
                    'session_id' => session()->getId(),
                    'product_id'  => $product->id,
                    'quantity' => $request->quantity?$request->quantity:1,
                ]);
            }
            Session::flash('success', 'Product Successfully Added To Cart!');
            if($request->quantity){
                return redirect(route('carts.index'));
            }
            else{
                return back();
            }
            
        }
        else{
            Session::flash('success', 'Product Stock Out! Chose Another Products!');
            return back();
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    
    public function destroy(Cart $cart, $id){
        Cart::findOrfail($id)->delete();
        Session::flash('success','Item Successfully Cleared');
        return back();
    }
}
