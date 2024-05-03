<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Cart::instance(Auth::user()->id)->content();

        $total = 0;

        foreach ($cart as $c) {
            $total += $c->qty * $c->price;
        }
        return view('carts.index',compact('cart','total'));
    }

    /**
     * Show the form for creating a new resource.
     */
  /*  public function create()
    {
        //
    } */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Cart::instance(Auth::user()->id)->add([
            'id' => $request->id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'weight' => $request->weight,
        ]);
        return to_route('products.show',$request->get('id'));
    }

    /**
     * Display the specified resource.
     */
  /*  public function show(string $id)
    {
        //
    } */

    /**
     * Show the form for editing the specified resource.
     */
 /*   public function edit(string $id)
    {
        //
    } */

    /**
     * Update the specified resource in storage.
     */
 /*   public function update(Request $request, string $id)
    {
        //
    } */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
