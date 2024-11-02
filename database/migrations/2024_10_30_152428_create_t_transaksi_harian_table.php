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
        Schema::create('t_transaksi_harian', function (Blueprint $table) {
            $table->id('no_records');
            $table->string('stock_code', 4);
            $table->date('date_transaction');
            $table->float('open')->nullable();
            $table->float('high')->nullable();
            $table->float('low')->nullable();
            $table->float('close')->nullable();
            $table->float('change')->nullable();
            $table->bigInteger('volume')->nullable();
            $table->bigInteger('value')->nullable();
            $table->integer('frequency')->nullable();
            $table->timestamps();

            $table->foreign('stock_code')->references('stock_code')->on('emiten')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_transaksi_harian');
    }
};
