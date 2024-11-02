<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transaksi_harians', function (Blueprint $table) {
            $table->id('no_records');
            $table->string('stock_code', 4);
            $table->date('date_transaction');
            $table->integer('open');
            $table->integer('high');
            $table->integer('low');
            $table->integer('close');
            $table->integer('change');
            $table->bigInteger('volume');
            $table->bigInteger('value');
            $table->integer('frequency');

            $table->foreign('stock_code')->references('stock_code')->on('emitens')->onDelete('cascade');

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_harians');
    }
};
