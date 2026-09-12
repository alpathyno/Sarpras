<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('laporan_kerusakans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('aset_id')->constrained('asets')->cascadeOnDelete();
            $table->text('deskripsi');
            $table->string('foto')->nullable();
            $table->date('tanggal_laporan');
            $table->string('status')->default('Dilaporkan');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('laporan_kerusakans'); }
};

