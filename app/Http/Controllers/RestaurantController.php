<?php
namespace App\Http\Controllers;
use App\Models\Restaurant;
use App\Models\Category;
use App\Models\FoodItem;
use Illuminate\Http\Request;

class RestaurantController extends Controller {

public function show($slug)
{
    // 1. Find the restaurant first
    $restaurant = \App\Models\Restaurant::where('slug', $slug)->firstOrFail();

    // 2. Explicitly get the food items for this restaurant
    $foodItems = \App\Models\FoodItem::where('restaurant_id', $restaurant->id)->get();

    // 3. Pass BOTH variables to the view
    return view('restaurants.show', compact('restaurant', 'foodItems'));
}

    public function index(Request $request) {
 $category = $request->query('category', 'all');
 $search = $request->query('search', '');

 $query = Restaurant::where('is_open', true)->orderBy('rating', 'desc');

 if ($category !== 'all') {
  $restaurantIds = FoodItem::where('mood_tags', 'like', '%'.$category.'%')
   ->pluck('restaurant_id')->unique();
  $query->whereIn('id', $restaurantIds);
 }

 if ($search) {
  $query->where('name', 'like', '%'.$search.'%');
 }

 $restaurants = $query->paginate(12);

 return view('restaurants.index', compact('restaurants', 'category', 'search'));
}
}
