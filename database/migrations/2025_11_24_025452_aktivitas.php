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
        Schema::create('aktivitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_departemen')->constrained('departmen')->onDelete('cascade');
            $table->enum('aktivitas', ['upload', 'update', 'download', 'preview', 'delete']);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->index(['id_user']);
            $table->index(['id_departemen']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktivitas');
    }
};
