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
        Schema::create('invoices', function (Blueprint $table){
        $table->id();
        $table->unsignedBigInteger('id_booking');
        $table->unsignedBigInteger('id_transaction');
        $table->string('status')->default('unpaid');
        $table->timestamp('created_at');

        //foreign key
        $table-> foreign('id_booking')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
        $table-> foreign('id_transaction')->references('id')->on('transactions')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
