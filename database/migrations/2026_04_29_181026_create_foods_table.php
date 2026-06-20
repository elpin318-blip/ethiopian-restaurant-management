<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('name_am')->nullable();
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->string('image')->nullable();
            $table->boolean('is_available')->default(true);
            $table->boolean('is_spicy')->default(false);
            $table->boolean('is_vegetarian')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('foods');
    }
};