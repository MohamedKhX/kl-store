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
    public function up(): void
    {
        Schema::create('product_colors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $table->text('url')->nullable();
            $table->string('name')->nullable();
            $table->string('price');
            $table->string('website_price')->nullable();
            $table->string('old_price')->nullable();
            $table->string('custom_price')->nullable();
            $table->string('color')->nullable();
            $table->string('thumbnail')->nullable(); //TODO delete nullable
            $table->json('images')->nullable();
            $table->json('excludedImages')->nullable(); //ToAdd
            $table->json('sizes')->nullable();
            $table->json('excludedSizes')->nullable(); //ToAdd
            $table->integer('priority')->default(1)->nullable(); //ToAdd
            $table->string('hash')->nullable(); //ToAdd
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
