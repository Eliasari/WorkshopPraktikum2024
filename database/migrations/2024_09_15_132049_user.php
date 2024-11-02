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
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id_user'); // integer auto increment
            $table->string('nama_user', 60);
            $table->string('username', 60);
            $table->string('password', 60);
            $table->string('email', 200);
            $table->string('no_hp', 30);
            $table->string('wa', 30)->nullable();
            $table->string('pin', 30)->nullable();
            $table->unsignedInteger('id_jenis_user');
            $table->boolean('status_user')->default(1);
            $table->boolean('delete_mark')->default(0);
            $table->string('create_by', 30);
            $table->timestamp('created_at')->nullable();
            $table->string('update_by', 30)->nullable();
            $table->timestamp('updated_at')->nullable();

            // Foreign Key
            $table->foreign('id_jenis_user')->references('id_jenis_user')->on('jenis_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
