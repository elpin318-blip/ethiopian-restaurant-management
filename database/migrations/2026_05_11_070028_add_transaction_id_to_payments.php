<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('payments', 'transaction_id')) {
            Schema::table('payments', function (Blueprint $table) {
                $table->string('transaction_id')->nullable()->after('payment_method');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('payments', 'transaction_id')) {
            Schema::table('payments', function (Blueprint $table) {
                $table->dropColumn('transaction_id');
            });
        }
    }
};