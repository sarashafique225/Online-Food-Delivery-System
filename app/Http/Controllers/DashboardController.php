<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Order;
use Illuminate\Http\Request;
// 1. ADD THESE IMPORTS
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

// 2. ADD "implements HasMiddleware"
class DashboardController extends Controller implements HasMiddleware 
{
    // 3. ADD THIS STATIC FUNCTION
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
        ];
    }

    // 4. DELETE THE OLD __construct() ENTIRELY

    public function index() {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $weekOrders = Order::where('user_id', $user->id)
                            ->where('created_at', '>=', now()->startOfWeek())
                            ->with('items.foodItem', 'restaurant')
                            ->get();

        $allOrders = Order::where('user_id', $user->id)
                          ->with('restaurant')->latest()->take(10)->get();

        $weeklyCalories = $weekOrders->sum('total_calories');
        $healthyCount = 0; $junkCount = 0;

        foreach($weekOrders as $order) {
            foreach($order->items as $item) {
                if($item->foodItem && $item->foodItem->is_healthy) $healthyCount++;
                else $junkCount++;
            }
        }

        $total = $healthyCount + $junkCount;
        $healthRatio = $total > 0 ? ($healthyCount / $total) * 100 : 100;
        $grade = $healthRatio >= 80 ? 'A' : ($healthRatio >= 60 ? 'B' : ($healthRatio >= 40 ? 'C' : 'D'));

        return view('dashboard', compact(
            'user','weekOrders','allOrders','weeklyCalories','healthyCount','junkCount','grade','healthRatio'
        ));
    }
}