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
        Schema::create('orders', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_produk');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('booking_status')->default('needs_payment');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');

            //foreign key
            $table-> foreign('id_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table-> foreign('id_produk')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('orders');
    }
};
