<?php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Seeder;

class ResetTablesSeeder extends Seeder
{
    public function run()
    {
        // Reset all tables to free
        Table::where('is_occupied', true)->update([
            'is_occupied' => false,
            'current_order_id' => null
        ]);
        
        $this->command->info('All tables have been reset to FREE status!');
    }
}