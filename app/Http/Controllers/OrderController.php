<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
        ];
    }

    public function store(Request $request)
    {
        $request->validate([
            'restaurant_id'    => 'required|exists:restaurants,id',
            'delivery_address' => 'required|string',
            'cart_data'        => 'required',
        ]);

        $cartItems = json_decode($request->cart_data, true);

        if (empty($cartItems)) {
            return back()->with('error', 'Your cart is empty!');
        }

        $restaurant = Restaurant::findOrFail($request->restaurant_id);

        $order = Order::create([
            'user_id'          => Auth::id(),
            'restaurant_id'    => (int) $request->restaurant_id,
            'status'           => 'pending',
            'subtotal'         => $request->total,
            'delivery_fee'     => $restaurant->delivery_fee,
            'total'            => $request->total + $restaurant->delivery_fee,
            'total_calories'   => $request->total_calories ?? 0,
            'delivery_address' => $request->delivery_address,
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'     => $order->id,
                'food_item_id' => $item['id'],
                'quantity'     => $item['qty'],
                'price'        => $item['price'],
                'calories'     => $item['cal'],
            ]);
        }

        Cart::where('user_id', Auth::id())->delete();

        return redirect('/dashboard')->with('success', '🎉 Order placed successfully!');
    }
}