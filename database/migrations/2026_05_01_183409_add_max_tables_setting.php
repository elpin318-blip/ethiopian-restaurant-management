<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('restaurant_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('value');
            $table->timestamps();
        });
        
        // Insert default settings
        DB::table('restaurant_settings')->insert([
            ['key' => 'max_tables', 'value' => '10'],
            ['key' => 'max_capacity', 'value' => '8'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('restaurant_settings');
    }
};