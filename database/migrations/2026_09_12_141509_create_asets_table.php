<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('asets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori_asets')->cascadeOnDelete();
            $table->foreignId('ruangan_id')->nullable()->constrained('ruangans')->nullOnDelete();
            $table->string('kode_aset')->unique();
            $table->string('nama_aset');
            $table->enum('tipe_aset', ['individual', 'jumlah'])->default('individual');
            $table->integer('jumlah')->default(1);
            $table->string('kondisi')->default('Baik');
            $table->boolean('dapat_dipinjam')->default(true);
            $table->string('status')->default('Tersedia');
            $table->string('foto')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('asets'); }
};

