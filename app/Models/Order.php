<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    protected $fillable = ['user_id','restaurant_id','status','subtotal',
        'delivery_fee','total','total_calories','delivery_address','payment_method'];

    public function user()       { return $this->belongsTo(User::class); }
    public function restaurant() { return $this->belongsTo(Restaurant::class); }
    public function items()      { return $this->hasMany(OrderItem::class); }
}
