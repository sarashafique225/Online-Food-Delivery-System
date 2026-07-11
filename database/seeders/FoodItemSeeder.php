<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\FoodItem;

class FoodItemSeeder extends Seeder
{
    public function run(): void
    {
        // Get restaurant IDs by slug so they always match correctly
        $pizzaPalace    = Restaurant::where('slug', 'pizza-palace')->first()->id;
        $biryaniHouse   = Restaurant::where('slug', 'biryani-house')->first()->id;
        $burgerBarn     = Restaurant::where('slug', 'burger-barn')->first()->id;
        $greenBowl      = Restaurant::where('slug', 'green-bowl')->first()->id;
        $desiDhaba      = Restaurant::where('slug', 'desi-dhaba')->first()->id;
        $dragonWok      = Restaurant::where('slug', 'dragon-wok')->first()->id;
        $sweetSpot      = Restaurant::where('slug', 'sweet-spot')->first()->id;
        $sushiSakura    = Restaurant::where('slug', 'sushi-sakura')->first()->id;
        $tandooriNights = Restaurant::where('slug', 'tandoori-nights')->first()->id;
        $fitMeal        = Restaurant::where('slug', 'fitmeal-kitchen')->first()->id;

        $items = [
            // Pizza Palace
            ['restaurant_id'=>$pizzaPalace,'name'=>'Margherita Pizza','price'=>650,'calories'=>820,
             'image'=>'Foods/Margherita_Pizza.jpg','protein'=>28,'carbs'=>90,'fats'=>22,'is_healthy'=>false,
             'mood_tags'=>'comfort,cheesy','ingredients'=>'Dough, Tomato sauce, Mozzarella, Basil'],
            ['restaurant_id'=>$pizzaPalace,'name'=>'BBQ Chicken Pizza','price'=>850,'calories'=>950,
             'image'=>'Foods/BBQ_Chicken_Pizza.jpg','protein'=>42,'carbs'=>88,'fats'=>30,'is_healthy'=>false,
             'mood_tags'=>'comfort,cheesy,junk','ingredients'=>'Dough, BBQ sauce, Chicken, Peppers, Mozzarella'],
            ['restaurant_id'=>$pizzaPalace,'name'=>'Veggie Supreme Pizza','price'=>700,'calories'=>650,
             'image'=>'Foods/Veggie_Supreme_Pizza.jpeg','protein'=>22,'carbs'=>80,'fats'=>16,'is_healthy'=>true,
             'mood_tags'=>'light,healthy,vegetarian','ingredients'=>'Dough, Tomato sauce, Bell peppers, Olives, Mushrooms, Cheese'],
            ['restaurant_id'=>$pizzaPalace,'name'=>'Garlic Bread','price'=>220,'calories'=>310,
             'image'=>'Foods/Garlic_Bread.jpg','protein'=>8,'carbs'=>42,'fats'=>10,'is_healthy'=>false,
             'mood_tags'=>'comfort,snack','ingredients'=>'Bread, Garlic butter, Herbs'],
            ['restaurant_id'=>$pizzaPalace,'name'=>'Pasta Arrabiata','price'=>480,'calories'=>580,
             'image'=>'Foods/Pasta_Arrabiata.png','protein'=>18,'carbs'=>85,'fats'=>12,'is_healthy'=>false,
             'mood_tags'=>'spicy,comfort,italian','ingredients'=>'Pasta, Tomatoes, Red chilli, Garlic, Olive oil'],

            // Biryani House
            ['restaurant_id'=>$biryaniHouse,'name'=>'Chicken Biryani','price'=>400,'calories'=>920,
             'image'=>'Foods/Chicken_Biryani.jpg','protein'=>38,'carbs'=>110,'fats'=>28,'is_healthy'=>false,
             'mood_tags'=>'desi,spicy,comfort,heavy','ingredients'=>'Basmati rice, Chicken, Fried onions, Yoghurt, Spices'],
            ['restaurant_id'=>$biryaniHouse,'name'=>'Beef Biryani','price'=>480,'calories'=>980,
             'image'=>'Foods/Beef_Biryani.jpg','protein'=>42,'carbs'=>108,'fats'=>34,'is_healthy'=>false,
             'mood_tags'=>'desi,spicy,heavy,comfort','ingredients'=>'Basmati rice, Beef, Fried onions, Whole spices'],
            ['restaurant_id'=>$biryaniHouse,'name'=>'Vegetable Biryani','price'=>280,'calories'=>620,
             'image'=>'Foods/Vegetable_Biryani.png','protein'=>15,'carbs'=>100,'fats'=>14,'is_healthy'=>true,
             'mood_tags'=>'desi,light,vegetarian','ingredients'=>'Basmati rice, Mixed vegetables, Mint, Spices'],
            ['restaurant_id'=>$biryaniHouse,'name'=>'Raita','price'=>80,'calories'=>120,
             'image'=>'Foods/Raita.png','protein'=>5,'carbs'=>10,'fats'=>4,'is_healthy'=>true,
             'mood_tags'=>'light,desi,healthy','ingredients'=>'Yoghurt, Cucumber, Mint, Salt'],
            ['restaurant_id'=>$biryaniHouse,'name'=>'Shami Kebab (4pcs)','price'=>220,'calories'=>480,
             'image'=>'Foods/Shami_Kebab.jpg','protein'=>30,'carbs'=>28,'fats'=>22,'is_healthy'=>false,
             'mood_tags'=>'desi,spicy,comfort','ingredients'=>'Beef mince, Lentils, Egg, Spices'],

            // Burger Barn
            ['restaurant_id'=>$burgerBarn,'name'=>'Classic Beef Burger','price'=>350,'calories'=>760,
             'image'=>'Foods/Classic_Beef_Burger.jpg','protein'=>34,'carbs'=>58,'fats'=>32,'is_healthy'=>false,
             'mood_tags'=>'junk,comfort,heavy','ingredients'=>'Bun, Beef patty, Lettuce, Tomato, Cheese, Mayo'],
            ['restaurant_id'=>$burgerBarn,'name'=>'Crispy Chicken Burger','price'=>420,'calories'=>820,
             'image'=>'Foods/Crispy_Chicken_Burger.jpg','protein'=>36,'carbs'=>62,'fats'=>30,'is_healthy'=>false,
             'mood_tags'=>'junk,crispy,spicy,comfort','ingredients'=>'Bun, Crispy chicken, Coleslaw, Hot sauce'],
            ['restaurant_id'=>$burgerBarn,'name'=>'Double Smash Burger','price'=>550,'calories'=>1050,
             'image'=>'Foods/Double_Smash_Burger.webp','protein'=>52,'carbs'=>65,'fats'=>48,'is_healthy'=>false,
             'mood_tags'=>'junk,heavy,comfort','ingredients'=>'Brioche bun, Double beef smash patty, American cheese, Pickles, Sauce'],
            ['restaurant_id'=>$burgerBarn,'name'=>'Loaded Fries','price'=>280,'calories'=>620,
             'image'=>'Foods/Loaded_Fries.jpg','protein'=>12,'carbs'=>75,'fats'=>28,'is_healthy'=>false,
             'mood_tags'=>'junk,snack,comfort','ingredients'=>'Fries, Cheddar sauce, Jalapenos, Sour cream'],
            ['restaurant_id'=>$burgerBarn,'name'=>'Chicken Wrap','price'=>320,'calories'=>540,
             'image'=>'Foods/Chicken_Wrap.webp','protein'=>30,'carbs'=>52,'fats'=>18,'is_healthy'=>false,
             'mood_tags'=>'comfort,spicy','ingredients'=>'Tortilla, Grilled chicken, Lettuce, Garlic sauce'],

            // Green Bowl
            ['restaurant_id'=>$greenBowl,'name'=>'Caesar Salad','price'=>380,'calories'=>310,
             'image'=>'Foods/Caesar_Salad.png','protein'=>18,'carbs'=>20,'fats'=>14,'is_healthy'=>true,
             'mood_tags'=>'light,healthy,diet','ingredients'=>'Romaine lettuce, Caesar dressing, Croutons, Parmesan'],
            ['restaurant_id'=>$greenBowl,'name'=>'Grilled Chicken Bowl','price'=>520,'calories'=>460,
             'image'=>'Foods/Grilled_Chicken_Bowl.png','protein'=>42,'carbs'=>38,'fats'=>12,'is_healthy'=>true,
             'mood_tags'=>'healthy,light,diet,high-protein','ingredients'=>'Grilled chicken breast, Brown rice, Steamed broccoli, Lemon dressing'],
            ['restaurant_id'=>$greenBowl,'name'=>'Quinoa Power Bowl','price'=>580,'calories'=>420,
             'image'=>'Foods/Quinoa_Power_Bowl.webp','protein'=>22,'carbs'=>55,'fats'=>14,'is_healthy'=>true,
             'mood_tags'=>'healthy,diet,vegetarian,light','ingredients'=>'Quinoa, Chickpeas, Avocado, Cherry tomatoes, Tahini'],
            ['restaurant_id'=>$greenBowl,'name'=>'Detox Green Smoothie','price'=>220,'calories'=>180,
             'image'=>'Foods/Detox_Green_Smoothie.jpg','protein'=>6,'carbs'=>32,'fats'=>2,'is_healthy'=>true,
             'mood_tags'=>'healthy,light,diet,sweet','ingredients'=>'Spinach, Banana, Apple, Ginger, Water'],
            ['restaurant_id'=>$greenBowl,'name'=>'Avocado Toast','price'=>340,'calories'=>380,
             'image'=>'Foods/Avocado_Toast.png','protein'=>12,'carbs'=>35,'fats'=>20,'is_healthy'=>true,
             'mood_tags'=>'healthy,light,diet','ingredients'=>'Sourdough bread, Avocado, Poached egg, Chilli flakes'],

            // Desi Dhaba
            ['restaurant_id'=>$desiDhaba,'name'=>'Dal Makhani','price'=>200,'calories'=>520,
             'image'=>'Foods/Dal_Makhani.jpg','protein'=>22,'carbs'=>58,'fats'=>18,'is_healthy'=>true,
             'mood_tags'=>'desi,comfort,vegetarian','ingredients'=>'Black lentils, Butter, Cream, Tomato, Spices'],
            ['restaurant_id'=>$desiDhaba,'name'=>'Karahi Chicken','price'=>650,'calories'=>980,
             'image'=>'Foods/Karahi_Chicken.jpg','protein'=>48,'carbs'=>22,'fats'=>52,'is_healthy'=>false,
             'mood_tags'=>'desi,spicy,heavy,comfort','ingredients'=>'Chicken, Tomatoes, Green chillies, Oil, Spices'],
            ['restaurant_id'=>$desiDhaba,'name'=>'Butter Naan (2pcs)','price'=>80,'calories'=>320,
             'image'=>'Foods/Butter_Naan.webp','protein'=>8,'carbs'=>55,'fats'=>8,'is_healthy'=>false,
             'mood_tags'=>'desi,comfort','ingredients'=>'Flour, Butter, Yeast, Salt'],
            ['restaurant_id'=>$desiDhaba,'name'=>'Seekh Kebab (4pcs)','price'=>280,'calories'=>520,
             'image'=>'Foods/Seekh_Kabab.jpeg','protein'=>38,'carbs'=>12,'fats'=>28,'is_healthy'=>false,
             'mood_tags'=>'desi,spicy,comfort,heavy','ingredients'=>'Beef mince, Onion, Coriander, Spices'],
            ['restaurant_id'=>$desiDhaba,'name'=>'Lassi (Sweet)','price'=>120,'calories'=>240,
             'image'=>'Foods/Sweet_Lassi.jpg','protein'=>8,'carbs'=>35,'fats'=>7,'is_healthy'=>true,
             'mood_tags'=>'desi,sweet,light','ingredients'=>'Yoghurt, Sugar, Rose water, Ice'],

            // Dragon Wok
            ['restaurant_id'=>$dragonWok,'name'=>'Hot & Sour Soup','price'=>220,'calories'=>180,
             'image'=>'Foods/Hot_&_Sour_Soup.jpg','protein'=>10,'carbs'=>22,'fats'=>4,'is_healthy'=>true,
             'mood_tags'=>'spicy,light,bloated,chinese','ingredients'=>'Chicken stock, Tofu, Mushrooms, Vinegar, Egg'],
            ['restaurant_id'=>$dragonWok,'name'=>'Chicken Chow Mein','price'=>380,'calories'=>680,
             'image'=>'Foods/Chicken_Chow_Mein.jpeg','protein'=>28,'carbs'=>82,'fats'=>18,'is_healthy'=>false,
             'mood_tags'=>'comfort,chinese,spicy','ingredients'=>'Noodles, Chicken, Soy sauce, Vegetables, Sesame oil'],
            ['restaurant_id'=>$dragonWok,'name'=>'Kung Pao Chicken','price'=>420,'calories'=>620,
             'image'=>'Foods/Kung_Pao_Chicken.jpg','protein'=>35,'carbs'=>38,'fats'=>28,'is_healthy'=>false,
             'mood_tags'=>'spicy,chinese,comfort','ingredients'=>'Chicken, Peanuts, Dried chillies, Soy sauce, Ginger'],
            ['restaurant_id'=>$dragonWok,'name'=>'Spring Rolls (4pcs)','price'=>180,'calories'=>360,
             'image'=>'Foods/Spring_Rolls.jpeg','protein'=>12,'carbs'=>42,'fats'=>16,'is_healthy'=>false,
             'mood_tags'=>'snack,chinese,light','ingredients'=>'Pastry, Cabbage, Carrot, Chicken, Soy sauce'],
            ['restaurant_id'=>$dragonWok,'name'=>'Steamed Dumplings (6pcs)','price'=>320,'calories'=>420,
             'image'=>'Foods/Steamed_Dumplings.jpg','protein'=>22,'carbs'=>48,'fats'=>12,'is_healthy'=>true,
             'mood_tags'=>'light,healthy,chinese','ingredients'=>'Dumpling wrapper, Chicken, Ginger, Garlic, Soy sauce'],

            // Sweet Spot
            ['restaurant_id'=>$sweetSpot,'name'=>'Chocolate Lava Cake','price'=>280,'calories'=>520,
             'image'=>'Foods/Chocolate_Lava_Cake.webp','protein'=>8,'carbs'=>62,'fats'=>24,'is_healthy'=>false,
             'mood_tags'=>'sweet,dessert,comfort','ingredients'=>'Dark chocolate, Butter, Egg, Flour, Sugar'],
            ['restaurant_id'=>$sweetSpot,'name'=>'Mango Cheesecake','price'=>320,'calories'=>480,
             'image'=>'Foods/Mango_Cheesecake.jpeg','protein'=>10,'carbs'=>58,'fats'=>22,'is_healthy'=>false,
             'mood_tags'=>'sweet,dessert','ingredients'=>'Cream cheese, Mango puree, Digestive biscuits, Butter, Sugar'],
            ['restaurant_id'=>$sweetSpot,'name'=>'Gulab Jamun (4pcs)','price'=>160,'calories'=>380,
             'image'=>'Foods/Gulab_Jamun.jpg','protein'=>6,'carbs'=>65,'fats'=>10,'is_healthy'=>false,
             'mood_tags'=>'sweet,desi,dessert,comfort','ingredients'=>'Milk solids, Flour, Sugar syrup, Cardamom'],
            ['restaurant_id'=>$sweetSpot,'name'=>'Fruit Trifle','price'=>240,'calories'=>320,
             'image'=>'Foods/Fruit_Trifle.jpg','protein'=>6,'carbs'=>55,'fats'=>10,'is_healthy'=>false,
             'mood_tags'=>'sweet,dessert,light','ingredients'=>'Custard, Jelly, Sponge cake, Mixed fruits, Cream'],
            ['restaurant_id'=>$sweetSpot,'name'=>'Belgian Waffles','price'=>350,'calories'=>580,
             'image'=>'Foods/Belgian_Waffles.jpg','protein'=>12,'carbs'=>72,'fats'=>22,'is_healthy'=>false,
             'mood_tags'=>'sweet,dessert,comfort','ingredients'=>'Waffle batter, Maple syrup, Whipped cream, Strawberries'],

            // Sushi Sakura
            ['restaurant_id'=>$sushiSakura,'name'=>'Chicken Teriyaki Roll (8pcs)','price'=>680,'calories'=>480,
             'image'=>'Foods/Chicken_Teriyaki_Roll.jpg','protein'=>28,'carbs'=>58,'fats'=>10,'is_healthy'=>true,
             'mood_tags'=>'light,healthy,japanese','ingredients'=>'Sushi rice, Chicken teriyaki, Nori, Avocado, Cucumber'],
            ['restaurant_id'=>$sushiSakura,'name'=>'California Roll (8pcs)','price'=>620,'calories'=>420,
             'image'=>'Foods/California_Roll.png','protein'=>18,'carbs'=>55,'fats'=>12,'is_healthy'=>true,
             'mood_tags'=>'light,healthy,diet','ingredients'=>'Sushi rice, Crab stick, Avocado, Cucumber, Sesame seeds'],
            ['restaurant_id'=>$sushiSakura,'name'=>'Miso Soup','price'=>180,'calories'=>90,
             'image'=>'Foods/Miso_Soup.jpg','protein'=>6,'carbs'=>10,'fats'=>2,'is_healthy'=>true,
             'mood_tags'=>'light,healthy,bloated','ingredients'=>'Miso paste, Tofu, Seaweed, Spring onions, Dashi'],
            ['restaurant_id'=>$sushiSakura,'name'=>'Edamame','price'=>220,'calories'=>180,
             'image'=>'/Foods/Edamame.jpg','protein'=>16,'carbs'=>14,'fats'=>7,'is_healthy'=>true,
             'mood_tags'=>'healthy,light,snack,diet','ingredients'=>'Steamed edamame beans, Sea salt'],

            // Tandoori Nights
            ['restaurant_id'=>$tandooriNights,'name'=>'Tandoori Chicken Half','price'=>480,'calories'=>680,
             'image'=>'Foods/Tandoori_Chicken_Half.jpg','protein'=>52,'carbs'=>8,'fats'=>28,'is_healthy'=>false,
             'mood_tags'=>'desi,spicy,heavy','ingredients'=>'Chicken, Yoghurt marinade, Tandoori spices, Lemon'],
            ['restaurant_id'=>$tandooriNights,'name'=>'Chicken Tikka Masala','price'=>520,'calories'=>780,
             'image'=>'Foods/Chicken_Tikka_Masala.jpg','protein'=>44,'carbs'=>28,'fats'=>42,'is_healthy'=>false,
             'mood_tags'=>'desi,spicy,comfort,heavy','ingredients'=>'Chicken tikka, Tomato masala, Cream, Spices'],
            ['restaurant_id'=>$tandooriNights,'name'=>'Mixed Grill Platter','price'=>850,'calories'=>1100,
             'image'=>'Foods/Mixed_Grill_Platter.jpeg','protein'=>72,'carbs'=>18,'fats'=>55,'is_healthy'=>false,
             'mood_tags'=>'desi,heavy,spicy','ingredients'=>'Seekh kebab, Chicken tikka, Boti, Naan, Raita'],
            ['restaurant_id'=>$tandooriNights,'name'=>'Chapli Kebab (2pcs)','price'=>240,'calories'=>540,
             'image'=>'Foods/Chapli_Kebab.jpg','protein'=>36,'carbs'=>20,'fats'=>28,'is_healthy'=>false,
             'mood_tags'=>'desi,spicy,comfort','ingredients'=>'Beef mince, Onion, Tomato, Green chilli, Spices'],

            // FitMeal Kitchen
            ['restaurant_id'=>$fitMeal,'name'=>'High Protein Chicken Bowl','price'=>580,'calories'=>440,
             'image'=>'Foods/High_Protein_Chicken_Bowl.jpeg','protein'=>52,'carbs'=>30,'fats'=>12,'is_healthy'=>true,
             'mood_tags'=>'healthy,diet,high-protein,light','ingredients'=>'Grilled chicken, Brown rice, Steamed greens, Lemon herb dressing'],
            ['restaurant_id'=>$fitMeal,'name'=>'Egg White Omelette','price'=>280,'calories'=>220,
             'image'=>'Foods/Egg_White_Omelette.jpg','protein'=>28,'carbs'=>8,'fats'=>6,'is_healthy'=>true,
             'mood_tags'=>'healthy,light,diet,high-protein','ingredients'=>'Egg whites, Spinach, Mushrooms, Bell pepper, Low-fat cheese'],
            ['restaurant_id'=>$fitMeal,'name'=>'Oatmeal with Fruits','price'=>220,'calories'=>310,
             'image'=>'Foods/Oatmeal_with_Fruits.webp','protein'=>10,'carbs'=>55,'fats'=>5,'is_healthy'=>true,
             'mood_tags'=>'healthy,light,diet,sweet','ingredients'=>'Rolled oats, Almond milk, Banana, Berries, Honey'],
            ['restaurant_id'=>$fitMeal,'name'=>'Grilled Salmon Bowl','price'=>750,'calories'=>520,
             'image'=>'Foods/Grilled_Salmon_Bowl.jpeg','protein'=>46,'carbs'=>35,'fats'=>18,'is_healthy'=>true,
             'mood_tags'=>'healthy,diet,light,high-protein','ingredients'=>'Salmon fillet, Quinoa, Asparagus, Lemon butter'],
            ['restaurant_id'=>$fitMeal,'name'=>'Protein Shake','price'=>250,'calories'=>280,
             'image'=>'Foods/Protein_Shake.png','protein'=>35,'carbs'=>22,'fats'=>4,'is_healthy'=>true,
             'mood_tags'=>'healthy,diet,high-protein,light','ingredients'=>'Whey protein, Almond milk, Banana, Ice'],
        ];

        foreach ($items as $item) {
            FoodItem::create(array_merge($item, [
                'description'  => 'Freshly prepared with quality ingredients.',
                'is_available' => true,
                'meal_time'    => 'all',
                'prep_time'    => rand(15, 40),
            ]));
        }
    }
}