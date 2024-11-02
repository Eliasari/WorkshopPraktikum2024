<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('emiten', function (Blueprint $table) {
            $table->string('stock_code', 4)->primary();
            $table->string('stock_name', 100);
            $table->integer('shared')->nullable();
            $table->string('sektor', 60)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emiten');
    }
};
