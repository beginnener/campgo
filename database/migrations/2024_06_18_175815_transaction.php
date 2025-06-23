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
        schema::create('transactions', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->string('alamat_pengiriman');
            $table->decimal('total_transaksi',10,2);
            $table->string('metode_transaksi');
            $table->string('status_transaksi');
            $table->timestamps();

            // foreign key
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }

};
