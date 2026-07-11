<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    public function run() {
    $restaurants = [
        ['name'=>'Desi Dhaba','slug'=>'desi-dhaba','address'=>'Anarkali, Lahore',
         'rating'=>4.9,'eco_friendly'=>false,'delivery_fee'=>20,'delivery_time'=>40,
         'image'=>'restaurants/Desi_Dhaba.png'],

        ['name'=>'Biryani House','slug'=>'biryani-house','address'=>'Gulberg III, Lahore',
         'rating'=>4.8,'eco_friendly'=>false,'delivery_fee'=>30,'delivery_time'=>35,
         'image'=>'restaurants/Biryani_House.png'],

        ['name'=>'FitMeal Kitchen','slug'=>'fitmeal-kitchen','address'=>'DHA Phase 1, Lahore',
         'rating'=>4.8,'eco_friendly'=>true,'delivery_fee'=>70,'delivery_time'=>25,
         'image'=>'restaurants/FitMeal_Kitchen.png'],

        ['name'=>'Green Bowl','slug'=>'green-bowl','address'=>'Johar Town, Lahore',
         'rating'=>4.7,'eco_friendly'=>true,'delivery_fee'=>60,'delivery_time'=>30,
         'image'=>'restaurants/Green_Bowl.png'],

        ['name'=>'The Sweet Spot','slug'=>'sweet-spot','address'=>'Liberty Market, Lahore',
         'rating'=>4.6,'eco_friendly'=>true,'delivery_fee'=>35,'delivery_time'=>20,
         'image'=>'restaurants/The_Sweet_Spot.png'],

        ['name'=>'Tandoori Nights','slug'=>'tandoori-nights','address'=>'Cavalry Ground, Lahore',
         'rating'=>4.6,'eco_friendly'=>false,'delivery_fee'=>35,'delivery_time'=>35,
         'image'=>'restaurants/Tandoori_Nights.png'],

        ['name'=>'Pizza Palace','slug'=>'pizza-palace','address'=>'DHA Phase 5, Lahore',
         'rating'=>4.5,'eco_friendly'=>true,'delivery_fee'=>50,'delivery_time'=>25,
         'image'=>'restaurants/Pizza_Palace.png'],

        ['name'=>'Sushi Sakura','slug'=>'sushi-sakura','address'=>'Packages Mall, Lahore',
         'rating'=>4.4,'eco_friendly'=>true,'delivery_fee'=>80,'delivery_time'=>45,
         'image'=>'restaurants/Sushi_Sakura.png'],

        ['name'=>'Dragon Wok','slug'=>'dragon-wok','address'=>'MM Alam Road, Lahore',
         'rating'=>4.3,'eco_friendly'=>false,'delivery_fee'=>45,'delivery_time'=>30,
         'image'=>'restaurants/Dragon_Wok.png'],

        ['name'=>'Burger Barn','slug'=>'burger-barn','address'=>'Model Town, Lahore',
         'rating'=>4.2,'eco_friendly'=>true,'delivery_fee'=>40,'delivery_time'=>20,
         'image'=>'restaurants/Burger_Barn.png'],
    ];

    foreach($restaurants as $r) {
        \App\Models\Restaurant::create(array_merge($r, [
            'city'         => 'Lahore',
            'phone'        => '0300-1234567',
            'is_open'      => true,
            'opening_time' => '09:00',
            'closing_time' => '23:00',
            'description'  => 'One of the best restaurants in Lahore.',
        ]));
    }
    }
}