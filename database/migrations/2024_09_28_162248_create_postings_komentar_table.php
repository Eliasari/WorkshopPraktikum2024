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
        Schema::create('posting_komentar', function (Blueprint $table) {
            $table->increments('komen_id')->primary();
            $table->unsignedInteger('posting_id');
            $table->unsignedInteger('id_user');
            $table->text('komentar_text');
            $table->string('komentar_gambar', 200)->nullable();
            $table->unsignedInteger('create_by');
            $table->timestamp('create_date')->default(now());
            $table->string('delete_mark', 1)->default('0');
            $table->unsignedInteger('update_by')->nullable();
            $table->timestamp('update_date')->nullable();
            $table->timestamps();

            $table->foreign('posting_id')->references('posting_id')->on('postings')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
            $table->foreign('create_by')->references('id_user')->on('user')->onDelete('cascade');
            $table->foreign('update_by')->references('id_user')->on('user')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posting_komentar');
    }
};
