<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Cart::instance(Auth::user()->id)->content();

        $total = 0;
        $has_carriage_cost = false;
        $carriage_cost = 0;

        foreach ($cart as $c) {
            $total += $c->qty * $c->price;
            if ($c->options->carriage) {
                $has_carriage_cost = true;
            }
        }
        if ($has_carriage_cost) {
            $total += env('CARRIAGE');
            $carriage_cost = env('CARRIAGE');
        }
        return view('carts.index',compact('cart','total','carriage_cost'));
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
            'options' => [
                'image' => $request->image,
                'carriage' => $request->carriage,
            ]
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
    public function destroy(Request $request)
    {
    /*    $user_shopping_carts = DB::table('shopping_cart')->where('instance',Auth::user()->id)->get();
        $count = $user_shopping_carts->count();
        
        $count += 1;
        Cart::instance(Auth::user()->id)->store($count);

        DB::table('shopping_cart')->where('instance',Auth::user()->id)->where('number',null)->update(['number' => $count, 'buy_flag' => true]);*/
        
        $user_shopping_carts = DB::table('shopping_cart')->get();
        $number = DB::table('shopping_cart')->where('instance',Auth::user()->id)->count();

        $count = $user_shopping_carts->count();

        $count += 1;
        $number +=1;
        $cart = Cart::instance(Auth::user()->id)->content();

        $price_total = 0;
        $qty_total = 0;
        $has_carriage_cost = false;

        foreach ($cart as $c) {
            $price_total +=$c->qty * $c->price;
            $qty_total += $c->qty;
            if ($c->options->carriage) {
                $has_carriage_cost = true;
            }
        
        }    
    
    if ($has_carriage_cost) {
        $price_total += env('CARRIAGE');
    }
    Cart::instance(Auth::user()->id)->store($count);

    DB::table('shopping_cart')->where('instance',Auth::user()->id)
    ->where('number',null)
    ->update([
        'code' => substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'),0,10),
        'number' => $number,
        'price_total' => $price_total,
        'qty' => $qty_total,
        'buy_flag' => true,
        'updated_at' => date("Y/m/d H:i:s")
    ]);
    Cart::instance(Auth::user()->id)->destroy();

        return to_route('carts.index');

            
    }
}
