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
            $table->foreignId('id_departement')->constrained('departmen')->onDelete('cascade');
            $table->foreignId('id_kategori')->nullable()->constrained('kategori')->nullOnDelete();
            $table->integer('no_dokumen')->nullable();
            $table->string('judul', 255);
            $table->string('tipe_file', 100)->nullable();
            $table->string('dokumen', 500); // path or url
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['active', 'archive'])->default('active');
            $table->date('tanggal_upload')->nullable();      // tanggal di-upload
            $table->date('tanggal_kadaluarsa')->nullable();
            $table->timestamps();

            $table->index(['id_departement']);
            $table->index(['id_kategori']);
            $table->unique(['id_departement', 'no_dokumen']);
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
