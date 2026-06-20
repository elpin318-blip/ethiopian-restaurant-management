<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            if (!Schema::hasColumn('payments', 'reference_number')) {
                $table->string('reference_number')->nullable()->after('payment_method');
            }
            if (!Schema::hasColumn('payments', 'bank_reference')) {
                $table->string('bank_reference')->nullable()->after('reference_number');
            }
            if (!Schema::hasColumn('payments', 'settlement_status')) {
                $table->string('settlement_status')->default('pending')->after('bank_reference');
            }
            if (!Schema::hasColumn('payments', 'settled_at')) {
                $table->timestamp('settled_at')->nullable()->after('settlement_status');
            }
        });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['reference_number', 'bank_reference', 'settlement_status', 'settled_at']);
        });
    }
};