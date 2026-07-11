<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\FoodItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AiController extends Controller {

    public function recommend(Request $request) {
        $mood = strtolower($request->input('mood', ''));

        // --- STEP 1: Check user's health history ---
        $healthMessage = null;
        $forceHealthy  = false;
        $user = Auth::guard('sanctum')->user();

        if (!$user) {
            // Try session auth for web users
            $user = auth()->user();
        }

        if ($user) {
            $weekOrders = Order::where('user_id', $user->id)
                ->where('created_at', '>=', now()->startOfWeek())
                ->with('items.foodItem')
                ->get();

            $weeklyCalories = $weekOrders->sum('total_calories');
            $calorieGoal    = ($user->daily_calorie_goal ?? 2000) * 7;
            $healthyCount   = 0;
            $junkCount      = 0;

            foreach ($weekOrders as $order) {
                foreach ($order->items as $item) {
                    if ($item->foodItem) {
                        if ($item->foodItem->is_healthy) $healthyCount++;
                        else $junkCount++;
                    }
                }
            }

            $total      = $healthyCount + $junkCount;
            $junkRatio  = $total > 0 ? ($junkCount / $total) * 100 : 0;
            $calPercent = $calorieGoal > 0 ? ($weeklyCalories / $calorieGoal) * 100 : 0;

            if ($calPercent >= 90 || $junkRatio >= 70) {
                $forceHealthy  = true;
                $healthMessage = "⚠️ Warning: You've consumed " . number_format($weeklyCalories) . " kcal this week (goal: " . number_format($calorieGoal) . " kcal). " .
                    ($junkRatio >= 70 ? round($junkRatio) . "% of your meals were junk food! " : "") .
                    "I'm recommending healthier options to balance your diet.";
            } elseif ($calPercent >= 60 || $junkRatio >= 50) {
                $healthMessage = "📊 This week: " . number_format($weeklyCalories) . " kcal consumed, " .
                    round($junkRatio) . "% junk meals. Consider lighter options!";
            } else {
                $healthMessage = "✅ Your diet this week looks balanced! " . number_format($weeklyCalories) . " kcal consumed.";
            }
        }

        // --- STEP 2: Match mood to tags ---
        $tags = [];
        if (str_contains($mood, 'spicy'))                                    $tags[] = 'spicy';
        if (str_contains($mood, 'light') || str_contains($mood, 'bloated')) $tags[] = 'light';
        if (str_contains($mood, 'comfort') || str_contains($mood, 'sad'))   $tags[] = 'comfort';
        if (str_contains($mood, 'healthy') || str_contains($mood, 'diet') || str_contains($mood, 'fit')) $tags[] = 'healthy';
        if (str_contains($mood, 'sweet') || str_contains($mood, 'dessert')) $tags[] = 'sweet';
        if (str_contains($mood, 'desi') || str_contains($mood, 'biryani'))  $tags[] = 'desi';
        if (str_contains($mood, 'burger') || str_contains($mood, 'fast'))   $tags[] = 'junk';
        if (str_contains($mood, 'chinese') || str_contains($mood, 'noodle')) $tags[] = 'chinese';
        if (str_contains($mood, 'hungry') || str_contains($mood, 'starving')) $tags[] = 'heavy';
        if (str_contains($mood, 'pizza'))                                    $tags[] = 'cheesy';

        // If user is eating too much junk, override and push healthy
        if ($forceHealthy && !in_array('healthy', $tags)) {
            $tags = ['healthy', 'light'];
        }

        // --- STEP 3: Query food items ---
        $query = FoodItem::where('is_available', true)->with('restaurant');

        if ($forceHealthy) {
            $query->where('is_healthy', true);
        } elseif (!empty($tags)) {
            $query->where(function($q) use ($tags) {
                foreach ($tags as $tag)
                    $q->orWhere('mood_tags', 'like', '%' . $tag . '%');
            });
        }

        $results = $query->inRandomOrder()->limit(4)->get();

        // Fallback if nothing found
        if ($results->isEmpty()) {
            $results = FoodItem::with('restaurant')
                ->where('is_available', true)
                ->inRandomOrder()->limit(4)->get();
        }

        return response()->json([
            'data'          => $results,
            'health_message'=> $healthMessage,
            'force_healthy' => $forceHealthy,
        ]);
    }
}