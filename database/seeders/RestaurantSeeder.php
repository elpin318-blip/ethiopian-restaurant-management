<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Food;
use App\Models\Table;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    public function run()
    {
        // Create Categories
        $categories = [
            ['name' => 'ወጥ (Wot)', 'name_am' => 'ወጥ', 'description' => 'Ethiopian stews', 'is_active' => true],
            ['name' => 'ጥብስ (Tibs)', 'name_am' => 'ጥብስ', 'description' => 'Sautéed meat dishes', 'is_active' => true],
            ['name' => 'ቅላ (Alicha)', 'name_am' => 'ቅላ', 'description' => 'Vegetarian stews', 'is_active' => true],
            ['name' => 'በልጅ (Bayaynetu)', 'name_am' => 'በልጅ', 'description' => 'Combination platters', 'is_active' => true],
            ['name' => 'ጃምቦ (Beverages)', 'name_am' => 'ጃምቦ', 'description' => 'Drinks and beverages', 'is_active' => true],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Create Foods
        $foods = [
            // Wots (Stews)
            ['category_id' => 1, 'name' => 'Doro Wot', 'name_am' => 'ዶሮ ወጥ', 'description' => 'Spicy chicken stew with boiled egg', 'price' => 180, 'is_spicy' => true, 'is_available' => true],
            ['category_id' => 1, 'name' => 'Key Siga Wot', 'name_am' => 'ቀይ ሥጋ ወጥ', 'description' => 'Spicy beef stew', 'price' => 150, 'is_spicy' => true, 'is_available' => true],
            ['category_id' => 1, 'name' => 'Alicha Wot', 'name_am' => 'አሊጫ ወጥ', 'description' => 'Mild beef stew with turmeric', 'price' => 140, 'is_spicy' => false, 'is_available' => true],
            ['category_id' => 1, 'name' => 'Minchet Abish', 'name_am' => 'ምንጨት አብሽ', 'description' => 'Spicy minced beef stew', 'price' => 160, 'is_spicy' => true, 'is_available' => true],
            
            // Tibs
            ['category_id' => 2, 'name' => 'Misto Tibs', 'name_am' => 'ምስጦ ጥብስ', 'description' => 'Mixed meat tibs with onions and peppers', 'price' => 200, 'is_spicy' => true, 'is_available' => true],
            ['category_id' => 2, 'name' => 'Lamb Tibs', 'name_am' => 'በግ ጥብስ', 'description' => 'Sautéed lamb with rosemary', 'price' => 220, 'is_spicy' => true, 'is_available' => true],
            ['category_id' => 2, 'name' => 'Beef Tibs', 'name_am' => 'ከሳት ጥብስ', 'description' => 'Sautéed beef with vegetables', 'price' => 190, 'is_spicy' => false, 'is_available' => true],
            ['category_id' => 2, 'name' => 'Derek Tibs', 'name_am' => 'ደረቅ ጥብስ', 'description' => 'Dry fried meat', 'price' => 210, 'is_spicy' => true, 'is_available' => true],
            
            // Vegetarian
            ['category_id' => 3, 'name' => 'Shiro Wet', 'name_am' => 'ሽሮ ወጥ', 'description' => 'Chickpea flour stew', 'price' => 80, 'is_spicy' => true, 'is_vegetarian' => true, 'is_vegan' => true, 'is_available' => true],
            ['category_id' => 3, 'name' => 'Kik Alicha', 'name_am' => 'ቅላ አሊጫ', 'description' => 'Split peas stew', 'price' => 90, 'is_spicy' => false, 'is_vegetarian' => true, 'is_available' => true],
            ['category_id' => 3, 'name' => 'Misir Wot', 'name_am' => 'ምስር ወጥ', 'description' => 'Red lentil stew', 'price' => 85, 'is_spicy' => true, 'is_vegetarian' => true, 'is_available' => true],
            ['category_id' => 3, 'name' => 'Atkilt Wot', 'name_am' => 'አትክልት ወጥ', 'description' => 'Cabbage, carrot and potato stew', 'price' => 75, 'is_spicy' => false, 'is_vegetarian' => true, 'is_available' => true],
            ['category_id' => 3, 'name' => 'Gomen', 'name_am' => 'ጎመን', 'description' => 'Collard greens', 'price' => 70, 'is_spicy' => false, 'is_vegetarian' => true, 'is_available' => true],
            
            // Combination
            ['category_id' => 4, 'name' => 'Bayaynetu', 'name_am' => 'በልጅ', 'description' => 'Vegetarian combination platter (10 items)', 'price' => 170, 'is_vegetarian' => true, 'is_available' => true],
            ['category_id' => 4, 'name' => 'Special Kitfo', 'name_am' => 'ስፔሻል ክትፎ', 'description' => 'Minced raw beef with spices', 'price' => 250, 'is_spicy' => true, 'is_available' => true],
            ['category_id' => 4, 'name' => 'Gored Gored', 'name_am' => 'ጎረድ ጎረድ', 'description' => 'Cubed raw beef in spicy sauce', 'price' => 240, 'is_spicy' => true, 'is_available' => true],
            
            // Drinks
            ['category_id' => 5, 'name' => 'Tej', 'name_am' => 'ጠጅ', 'description' => 'Ethiopian honey wine', 'price' => 60, 'is_available' => true],
            ['category_id' => 5, 'name' => 'Tella', 'name_am' => 'ጠላ', 'description' => 'Traditional Ethiopian beer', 'price' => 40, 'is_available' => true],
            ['category_id' => 5, 'name' => 'Ethiopian Coffee', 'name_am' => 'ቡና', 'description' => 'Traditional coffee ceremony', 'price' => 50, 'is_available' => true],
            ['category_id' => 5, 'name' => 'Spiced Tea', 'name_am' => 'ሻይ', 'description' => 'Ethiopian spiced tea', 'price' => 25, 'is_available' => true],
        ];

        foreach ($foods as $food) {
            Food::create($food);
        }

        // Create Tables
        for ($i = 1; $i <= 15; $i++) {
            Table::create([
                'table_number' => (string)$i,
                'capacity' => $i <= 8 ? 4 : ($i <= 12 ? 6 : 8),
                'location' => $i <= 5 ? 'Inside - Main Hall' : ($i <= 10 ? 'Inside - VIP' : 'Terrace'),
                'is_available' => true
            ]);
        }
    }
}