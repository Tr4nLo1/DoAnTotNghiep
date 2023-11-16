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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_voucher');
            $table->integer('total');
            $table->integer('total_sale');
            $table->string('status',length:50);
            $table->string('name',length:150);
            $table->string('address',length:50);
            $table->integer('phone');
            $table->string('email',length:150);
            $table->longText('note');
            $table->string('time',length:50);
            $table->integer('id_payment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
