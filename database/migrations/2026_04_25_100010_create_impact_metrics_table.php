<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('impact_metrics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('value');
            $table->string('unit')->nullable();
            $table->string('category')->nullable();
            $table->string('icon')->nullable();
            $table->text('description')->nullable();
            $table->integer('order_index')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('impact_metrics');
    }
};
