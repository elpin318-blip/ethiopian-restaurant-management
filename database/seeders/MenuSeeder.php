<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Food;
use App\Models\Table;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        // Clear existing data
        Category::truncate();
        Food::truncate();
        Table::truncate();

        // Create Categories
        $categories = [
            ['name' => 'Ethiopian Stews (Wot)', 'is_active' => true],
            ['name' => 'Grilled & Fried (Tibs)', 'is_active' => true],
            ['name' => 'Vegetarian Specials', 'is_active' => true],
            ['name' => 'Combination Platters', 'is_active' => true],
            ['name' => 'Hot Beverages', 'is_active' => true],
            ['name' => 'Cold Drinks', 'is_active' => true],
            ['name' => 'Traditional Drinks', 'is_active' => true],
            ['name' => 'Desserts', 'is_active' => true],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Create Foods & Drinks
        $foods = [
            // Ethiopian Stews (Wot)
            ['category_id' => 1, 'name' => 'Doro Wot', 'description' => 'Spicy chicken stew with boiled egg', 'price' => 180, 'is_spicy' => true, 'is_available' => true],
            ['category_id' => 1, 'name' => 'Key Siga Wot', 'description' => 'Spicy beef stew with berbere sauce', 'price' => 150, 'is_spicy' => true, 'is_available' => true],
            ['category_id' => 1, 'name' => 'Alicha Wot', 'description' => 'Mild beef stew with turmeric', 'price' => 140, 'is_spicy' => false, 'is_available' => true],
            ['category_id' => 1, 'name' => 'Minchet Abish', 'description' => 'Spicy minced beef stew', 'price' => 160, 'is_spicy' => true, 'is_available' => true],
            ['category_id' => 1, 'name' => 'Dulet', 'description' => 'Spicy minced meat with liver and tripe', 'price' => 170, 'is_spicy' => true, 'is_available' => true],
            
            // Grilled & Fried (Tibs)
            ['category_id' => 2, 'name' => 'Special Misto Tibs', 'description' => 'Mixed meat tibs with onions and peppers', 'price' => 220, 'is_spicy' => true, 'is_available' => true],
            ['category_id' => 2, 'name' => 'Lamb Tibs', 'description' => 'Sautéed lamb with rosemary and garlic', 'price' => 240, 'is_spicy' => true, 'is_available' => true],
            ['category_id' => 2, 'name' => 'Beef Tibs', 'description' => 'Sautéed beef with vegetables', 'price' => 190, 'is_spicy' => false, 'is_available' => true],
            ['category_id' => 2, 'name' => 'Derek Tibs', 'description' => 'Dry fried meat crispy style', 'price' => 210, 'is_spicy' => true, 'is_available' => true],
            ['category_id' => 2, 'name' => 'Awaze Tibs', 'description' => 'Tibs served with spicy awaze sauce', 'price' => 200, 'is_spicy' => true, 'is_available' => true],
            ['category_id' => 2, 'name' => 'Zilzil Tibs', 'description' => 'Strip-cut beef marinated in herbs', 'price' => 230, 'is_spicy' => true, 'is_available' => true],
            
            // Vegetarian Specials
            ['category_id' => 3, 'name' => 'Shiro Wet', 'description' => 'Chickpea flour stew with berbere', 'price' => 90, 'is_spicy' => true, 'is_vegetarian' => true, 'is_available' => true],
            ['category_id' => 3, 'name' => 'Kik Alicha', 'description' => 'Split peas stew with turmeric', 'price' => 85, 'is_spicy' => false, 'is_vegetarian' => true, 'is_available' => true],
            ['category_id' => 3, 'name' => 'Misir Wot', 'description' => 'Red lentil stew spicy', 'price' => 95, 'is_spicy' => true, 'is_vegetarian' => true, 'is_available' => true],
            ['category_id' => 3, 'name' => 'Atkilt Wot', 'description' => 'Cabbage, carrot and potato stew', 'price' => 80, 'is_spicy' => false, 'is_vegetarian' => true, 'is_available' => true],
            ['category_id' => 3, 'name' => 'Gomen', 'description' => 'Collard greens with garlic and ginger', 'price' => 75, 'is_spicy' => false, 'is_vegetarian' => true, 'is_available' => true],
            ['category_id' => 3, 'name' => 'Fasolia', 'description' => 'Green beans and carrots stew', 'price' => 80, 'is_spicy' => false, 'is_vegetarian' => true, 'is_available' => true],
            ['category_id' => 3, 'name' => 'Dinich Wot', 'description' => 'Potato stew with mild sauce', 'price' => 85, 'is_spicy' => false, 'is_vegetarian' => true, 'is_available' => true],
            
            // Combination Platters
            ['category_id' => 4, 'name' => 'Vegetarian Combo', 'description' => '8 different vegetarian dishes with injera', 'price' => 180, 'is_vegetarian' => true, 'is_available' => true],
            ['category_id' => 4, 'name' => 'Meat Combo', 'description' => '3 types of meat stews with injera', 'price' => 250, 'is_spicy' => true, 'is_available' => true],
            ['category_id' => 4, 'name' => 'Special Kitfo', 'description' => 'Minced raw beef with mitmita and kay butter', 'price' => 280, 'is_spicy' => true, 'is_available' => true],
            ['category_id' => 4, 'name' => 'Gored Gored', 'description' => 'Cubed raw beef in spicy sauce', 'price' => 260, 'is_spicy' => true, 'is_available' => true],
            ['category_id' => 4, 'name' => 'Family Platter (4 persons)', 'description' => 'Mix of meat and veg dishes for 4', 'price' => 850, 'is_spicy' => true, 'is_available' => true],
            ['category_id' => 4, 'name' => 'Tasting Menu', 'description' => 'Small portions of 10 different dishes', 'price' => 350, 'is_spicy' => true, 'is_available' => true],
            
            // Hot Beverages
            ['category_id' => 5, 'name' => 'Ethiopian Coffee', 'description' => 'Traditional coffee ceremony service', 'price' => 60, 'is_available' => true],
            ['category_id' => 5, 'name' => 'Macchiato', 'description' => 'Italian style macchiato', 'price' => 35, 'is_available' => true],
            ['category_id' => 5, 'name' => 'Cappuccino', 'description' => 'Creamy cappuccino', 'price' => 45, 'is_available' => true],
            ['category_id' => 5, 'name' => 'Espresso', 'description' => 'Strong espresso shot', 'price' => 30, 'is_available' => true],
            ['category_id' => 5, 'name' => 'Latte', 'description' => 'Smooth coffee latte', 'price' => 50, 'is_available' => true],
            ['category_id' => 5, 'name' => 'Americano', 'description' => 'American style coffee', 'price' => 40, 'is_available' => true],
            ['category_id' => 5, 'name' => 'Spiced Tea', 'description' => 'Ethiopian spiced tea with cinnamon', 'price' => 35, 'is_available' => true],
            ['category_id' => 5, 'name' => 'Ginger Tea', 'description' => 'Fresh ginger tea', 'price' => 30, 'is_available' => true],
            ['category_id' => 5, 'name' => 'Hot Chocolate', 'description' => 'Rich hot chocolate', 'price' => 40, 'is_available' => true],
            
            // Cold Drinks
            ['category_id' => 6, 'name' => 'Coca Cola', 'description' => 'Regular coke', 'price' => 25, 'is_available' => true],
            ['category_id' => 6, 'name' => 'Sprite', 'description' => 'Lemon lime soda', 'price' => 25, 'is_available' => true],
            ['category_id' => 6, 'name' => 'Fanta Orange', 'description' => 'Orange soda', 'price' => 25, 'is_available' => true],
            ['category_id' => 6, 'name' => 'Pepsi', 'description' => 'Pepsi cola', 'price' => 25, 'is_available' => true],
            ['category_id' => 6, 'name' => 'Diet Coke', 'description' => 'Low calorie coke', 'price' => 25, 'is_available' => true],
            ['category_id' => 6, 'name' => 'Mirinda', 'description' => 'Fruity soda', 'price' => 25, 'is_available' => true],
            ['category_id' => 6, 'name' => 'Mineral Water', 'description' => '500ml bottled water', 'price' => 15, 'is_available' => true],
            ['category_id' => 6, 'name' => 'Sparkling Water', 'description' => 'Carbonated water', 'price' => 20, 'is_available' => true],
            ['category_id' => 6, 'name' => 'Fresh Orange Juice', 'description' => 'Squeezed orange juice', 'price' => 50, 'is_available' => true],
            ['category_id' => 6, 'name' => 'Fresh Mango Juice', 'description' => 'Fresh mango juice', 'price' => 55, 'is_available' => true],
            ['category_id' => 6, 'name' => 'Fresh Avocado Juice', 'description' => 'Creamy avocado juice', 'price' => 60, 'is_available' => true],
            ['category_id' => 6, 'name' => 'Lemonade', 'description' => 'Fresh lemonade', 'price' => 40, 'is_available' => true],
            ['category_id' => 6, 'name' => 'Ice Tea', 'description' => 'Refreshing iced tea', 'price' => 35, 'is_available' => true],
            
            // Traditional Drinks
            ['category_id' => 7, 'name' => 'Tej (Honey Wine)', 'description' => 'Traditional Ethiopian honey wine', 'price' => 80, 'is_available' => true],
            ['category_id' => 7, 'name' => 'Tella', 'description' => 'Traditional Ethiopian beer', 'price' => 50, 'is_available' => true],
            ['category_id' => 7, 'name' => 'Areki', 'description' => 'Traditional Ethiopian spirit', 'price' => 70, 'is_available' => true],
            ['category_id' => 7, 'name' => 'Borde', 'description' => 'Traditional fermented grain drink', 'price' => 40, 'is_available' => true],
            
            // Desserts
            ['category_id' => 8, 'name' => 'Baklava', 'description' => 'Sweet pastry with honey and nuts', 'price' => 60, 'is_available' => true],
            ['category_id' => 8, 'name' => 'Cheesecake', 'description' => 'New York style cheesecake', 'price' => 80, 'is_available' => true],
            ['category_id' => 8, 'name' => 'Chocolate Cake', 'description' => 'Rich chocolate layer cake', 'price' => 75, 'is_available' => true],
            ['category_id' => 8, 'name' => 'Ice Cream', 'description' => 'Vanilla or chocolate ice cream', 'price' => 45, 'is_available' => true],
            ['category_id' => 8, 'name' => 'Fruit Salad', 'description' => 'Fresh mixed fruits', 'price' => 55, 'is_available' => true],
        ];

        foreach ($foods as $food) {
            Food::create($food);
        }

        // Create Tables (15 tables)
        $tableConfigs = [
            ['table_number' => '1', 'capacity' => 2, 'location' => 'Window', 'is_available' => true],
            ['table_number' => '2', 'capacity' => 2, 'location' => 'Window', 'is_available' => true],
            ['table_number' => '3', 'capacity' => 4, 'location' => 'Main Hall', 'is_available' => true],
            ['table_number' => '4', 'capacity' => 4, 'location' => 'Main Hall', 'is_available' => true],
            ['table_number' => '5', 'capacity' => 4, 'location' => 'Main Hall', 'is_available' => true],
            ['table_number' => '6', 'capacity' => 6, 'location' => 'Main Hall', 'is_available' => true],
            ['table_number' => '7', 'capacity' => 6, 'location' => 'Main Hall', 'is_available' => true],
            ['table_number' => '8', 'capacity' => 8, 'location' => 'VIP Room', 'is_available' => true],
            ['table_number' => '9', 'capacity' => 8, 'location' => 'VIP Room', 'is_available' => true],
            ['table_number' => '10', 'capacity' => 10, 'location' => 'VIP Room', 'is_available' => true],
            ['table_number' => '11', 'capacity' => 4, 'location' => 'Terrace', 'is_available' => true],
            ['table_number' => '12', 'capacity' => 4, 'location' => 'Terrace', 'is_available' => true],
            ['table_number' => '13', 'capacity' => 6, 'location' => 'Terrace', 'is_available' => true],
            ['table_number' => '14', 'capacity' => 6, 'location' => 'Terrace', 'is_available' => true],
            ['table_number' => '15', 'capacity' => 8, 'location' => 'Terrace', 'is_available' => true],
        ];

        foreach ($tableConfigs as $table) {
            Table::create($table);
        }
    }
}