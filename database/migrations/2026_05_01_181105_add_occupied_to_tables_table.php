<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tables', function (Blueprint $table) {
            $table->boolean('is_occupied')->default(false)->after('is_available');
            $table->foreignId('current_order_id')->nullable()->after('is_occupied');
        });
    }

    public function down()
    {
        Schema::table('tables', function (Blueprint $table) {
            $table->dropColumn(['is_occupied', 'current_order_id']);
        });
    }
};