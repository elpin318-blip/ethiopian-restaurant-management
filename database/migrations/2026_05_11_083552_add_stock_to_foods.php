<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('foods', function (Blueprint $table) {
            $table->integer('stock')->default(50)->after('price');
            $table->integer('low_stock_threshold')->default(10)->after('stock');
        });
    }

    public function down()
    {
        Schema::table('foods', function (Blueprint $table) {
            $table->dropColumn(['stock', 'low_stock_threshold']);
        });
    }
};