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
        Schema::create('postings', function (Blueprint $table) {
            $table->increments('posting_id')->primary();
            $table->unsignedInteger('sender'); // Menggunakan unsigned integer sesuai dengan id_user
            $table->text('message_text');
            $table->string('message_gambar', 200)->nullable();
            $table->unsignedInteger('create_by'); // Menggunakan unsigned integer sesuai dengan id_user
            $table->timestamp('create_date')->default(now()); // Menggunakan timestamp saat create
            $table->string('delete_mark', 1)->default('0'); // Soft delete indicator
            $table->unsignedInteger('update_by')->nullable(); // Nullable, update terakhir oleh siapa
            $table->timestamp('update_date')->nullable(); // Waktu update terakhir
            $table->timestamps();

            // Menambahkan foreign key constraints setelah kolom dibuat
            $table->foreign('sender')->references('id_user')->on('user')->onDelete('cascade');
            $table->foreign('create_by')->references('id_user')->on('user')->onDelete('cascade');
            $table->foreign('update_by')->references('id_user')->on('user')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postings');
    }
};
