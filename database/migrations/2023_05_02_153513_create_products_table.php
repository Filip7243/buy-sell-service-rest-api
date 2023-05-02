<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('image')->nullable();
            $table->unsignedDecimal('price', 10);
            $table->integer('quantity');
            $table->string('product_condition')->default('FOR_SALE');
            $table->string('type')->default('NEW');

            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')->onDelete('cascade');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
