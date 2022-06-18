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
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone_number');
            $table->string('address');
            $table->json('city');
            $table->text('notes')->nullable();
            $table->text('admin_notes')->nullable();
            $table->json('products');
            $table->json('options')->nullable();

            // Requested [Refused, Accepted] [InComing, InLibya] [Arrived, No_Response, Not_Accepted]
            $table->string('status')->default('Requested');
            $table->boolean('user_deletes_it')->default(false);
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
