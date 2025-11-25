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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD:database/migrations/2025_11_25_015104_staff.php

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->string('nama'); 
            $table->string('jabatan');

            
            $table->foreignId('departemen_id')
                ->constrained('departemen')
                ->nullOnDelete();

=======
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('departemen_id')->constrained('departemen')->cascadeOnDelete();
>>>>>>> 8daf5d1092606b914bcb8a8d8c4a8a30752b5e31:database/migrations/2025_11_24_025351_staff.php
            $table->string('no_hp');
            $table->enum('akses', ['read', 'write']);
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
