<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_method')->nullable()->after('payment_status');
            $table->decimal('amount_paid', 10, 2)->default(0)->after('payment_method');
            $table->decimal('change_due', 10, 2)->default(0)->after('amount_paid');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'amount_paid', 'change_due']);
        });
    }
};