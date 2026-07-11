<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model {
    protected $fillable = ['name','slug','description','address','city',
        'phone','image','rating','is_open','eco_friendly',
        'opening_time','closing_time','delivery_time','delivery_fee'];

    public function foodItems() {
        return $this->hasMany(FoodItem::class);
    }
    public function orders() {
        return $this->hasMany(Order::class);
    }
}
