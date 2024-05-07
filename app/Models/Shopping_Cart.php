<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Shopping_Cart extends Model
{
    use HasFactory;

    protected $table = 'shopping_cart';
    
    public static function getCurrentUserOrders($user_id)
{
    $shopping_carts = DB::table('shopping_cart')->where("instance","{$user_id}")->get();

    $oders = [];

    foreach ($shopping_carts as $order) {
        $orders[] = [
            'id' => $order->number,
            'created_at' => $order->updated_at,
            'total' => $order->price_total,
            'user_name' => User::find($order->instance)->name,
            'code' => $order->code
        ];
    }
    return $orders;
} 
}
