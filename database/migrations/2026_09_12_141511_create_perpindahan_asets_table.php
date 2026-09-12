<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('perpindahan_asets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aset_id')->constrained('asets')->cascadeOnDelete();
            $table->foreignId('ruangan_asal_id')->nullable()->constrained('ruangans')->nullOnDelete();
            $table->foreignId('ruangan_tujuan_id')->nullable()->constrained('ruangans')->nullOnDelete();
            $table->date('tanggal');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('alasan')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('perpindahan_asets'); }
};

