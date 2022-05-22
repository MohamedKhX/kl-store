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
            $table->foreignId('category_id')->nullable();
            $table->foreignId('collection_id')->nullable();
            $table->foreignId('user_id');
            $table->string('website')->nullable();
            $table->string('url')->nullable();
            $table->string('name');
            $table->text('thumbnail')->nullable();
            $table->integer('views')->default(0);
            $table->integer('unique_views')->default(0);
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
