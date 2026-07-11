<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\FoodItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())
                        ->with(['foodItem.restaurant'])
                        ->get();

        $subtotal    = $cartItems->sum(fn($c) => $c->foodItem->price * $c->quantity);
        $deliveryFee = 150;
        $total       = $subtotal + $deliveryFee;

        return view('cart', compact('cartItems', 'subtotal', 'deliveryFee', 'total'));
    }

    public function store(Request $request)
{
    $foodItemId = $request->input('food_item_id');
    $quantity   = $request->input('quantity', 1);

    if (!$foodItemId) {
        return response()->json(['error' => 'No food item'], 400);
    }

    $existing = Cart::where('user_id', Auth::id())
                    ->where('food_item_id', $foodItemId)
                    ->first();

    if ($existing) {
        $existing->increment('quantity');
    } else {
        Cart::create([
            'user_id'      => Auth::id(),
            'food_item_id' => $foodItemId,
            'quantity'     => $quantity,
        ]);
    }

    return response()->json(['success' => true]);
}

    public function destroy($id)
    {
        Cart::where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        return back()->with('success', 'Item removed!');
    }

    // Call this to clear entire cart
    public static function clearCart()
    {
        Cart::where('user_id', Auth::id())->delete();
    }
}