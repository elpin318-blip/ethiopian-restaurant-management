<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tax_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('percentage', 5, 2);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });
        
        // Insert default tax setting
        DB::table('tax_settings')->insert([
            'name' => 'VAT',
            'percentage' => 5,
            'is_active' => true,
            'is_default' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('tax_settings');
    }
};