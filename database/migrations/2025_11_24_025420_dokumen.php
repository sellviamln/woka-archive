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
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departemen_id')->constrained('departemen')->cascadeOnDelete();
            $table->foreignId('kategori_id')->constrained('kategori')->cascadeOnDelete();
            $table->string('no_dokumen')->nullable();
            $table->string('judul');
            $table->string('tipe_file', 100);
            $table->string('dokumen'); 
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['active', 'archive'])->default('active');
            $table->date('tanggal_upload')->nullable();      // tanggal di-upload
            $table->date('tanggal_kadaluarsa')->nullable();
            $table->foreignId('uploaded_by')->constrained('users')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['departemen_id', 'no_dokumen']);
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen');
    }
};
