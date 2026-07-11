<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class FoodItem extends Model {
    protected $fillable = ['restaurant_id','category_id','name','description',
        'price','image','calories','protein','carbs','fats','ingredients',
        'is_healthy','is_available','meal_time','mood_tags','prep_time'];

    public function restaurant() { return $this->belongsTo(Restaurant::class); }
    public function category()   { return $this->belongsTo(Category::class); }
}
