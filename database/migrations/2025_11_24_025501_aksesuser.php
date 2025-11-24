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
        Schema::create('aksesuser', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_user')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->enum('role', ['karyawan'])->default('karyawan');

            $table->foreignId('granted_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            $table->unique(['id_user']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akses_users');
    }
};
