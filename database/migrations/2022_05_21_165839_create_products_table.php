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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('websiteScraper')->nullable();
            $table->string('url')->nullable();
            $table->json('urls')->nullable();
            $table->string('name');
            $table->text('thumbnail')->nullable();
            $table->integer('views')->default(0);
            $table->text('description')->nullable();
            $table->text('outer_description')->nullable(); //ToAdd
            $table->integer('unique_views')->default(0);
            $table->boolean('status')->default(true);
            $table->string('price')->nullable();
            $table->string('old_price')->nullable();
            $table->integer('earnings')->default(60);
            $table->integer('priority')->default(1)->nullable();
            $table->boolean('fetchable')->default(false);
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
        Schema::dropIfExists('whole_products');
    }
};
