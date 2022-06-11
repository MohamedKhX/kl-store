<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string( 'name');
            $table->string( 'email');
            $table->string( 'phone_number');
            $table->string( 'address');
            $table->string( 'city');
            $table->boolean('status')->default(false);
            $table->boolean('approved')->default(false);
            $table->boolean('arrived')->default(false);
            $table->boolean('user_delete_it')->default(false);
            $table->text(   'notes')->nullable();
            $table->json(   'products')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
