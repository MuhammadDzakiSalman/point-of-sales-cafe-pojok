<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('table_id')->references('id')->on('tables')->onDelete('cascade');
            $table->enum('metode_pembayaran', ['tunai', 'non-tunai']);
            $table->integer('total');

            $table->timestamp('estimasi')->nullable();
            $table->enum('status', ['menunggu', 'diproses', 'selesai', 'konfirmasi'])->default('menunggu');
            $table->timestamp('menunggu')->nullable();
            $table->timestamp('diproses')->nullable();
            $table->timestamp('selesai')->nullable();
            $table->timestamp('konfirmasi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
