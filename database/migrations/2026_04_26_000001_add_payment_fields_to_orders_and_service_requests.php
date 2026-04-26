<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_provider', 30)->nullable()->after('status');
            $table->string('payment_external_id', 80)->nullable()->after('payment_provider');
            $table->string('payment_invoice_id', 80)->nullable()->after('payment_external_id');
            $table->string('payment_status', 20)->nullable()->after('payment_invoice_id');
            $table->string('payment_url', 500)->nullable()->after('payment_status');
            $table->timestamp('paid_at')->nullable()->after('payment_url');
        });

        Schema::table('service_requests', function (Blueprint $table) {
            $table->string('payment_provider', 30)->nullable()->after('status');
            $table->string('payment_external_id', 80)->nullable()->after('payment_provider');
            $table->string('payment_invoice_id', 80)->nullable()->after('payment_external_id');
            $table->string('payment_status', 20)->nullable()->after('payment_invoice_id');
            $table->string('payment_url', 500)->nullable()->after('payment_status');
            $table->timestamp('paid_at')->nullable()->after('payment_url');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_provider', 'payment_external_id', 'payment_invoice_id', 'payment_status', 'payment_url', 'paid_at']);
        });

        Schema::table('service_requests', function (Blueprint $table) {
            $table->dropColumn(['payment_provider', 'payment_external_id', 'payment_invoice_id', 'payment_status', 'payment_url', 'paid_at']);
        });
    }
};
