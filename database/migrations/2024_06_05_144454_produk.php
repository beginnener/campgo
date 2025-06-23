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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); 
            $table->string('nama_produk');
            $table->integer('harga_produk');
            $table->string('deskripsi_produk');
            $table->string('img_produk');
            $table->integer('stok_produk');
            $table->unsignedBigInteger('id_merk');
            $table->unsignedBigInteger('id_kategori');
            $table->timestamps();
            
            // foreign key
            $table->foreign('id_merk')->references('id')->on('merk')
                  ->onDelete('cascade');
            $table->foreign('id_kategori')->references('id')->on('kategori')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
