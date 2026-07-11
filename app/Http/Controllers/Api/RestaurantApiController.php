<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;

class RestaurantApiController extends Controller {
    public function index() {
        return response()->json(['success'=>true, 'data'=>Restaurant::where('is_open',true)->get()]);
    }
    public function show(int $id) {
        return response()->json(['success'=>true, 'data'=>Restaurant::with('foodItems')->findOrFail($id)]);
    }
}
