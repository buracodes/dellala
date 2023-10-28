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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('address');
            $table->decimal('regular_price', 8, 2);
            $table->decimal('discount_price', 8, 2);
            $table->integer('bathrooms');
            $table->integer('bedrooms');
            $table->boolean('furnished');
            $table->boolean('parking');
            $table->string('type');
            $table->boolean('offer');
            $table->json('image_urls');
            $table->string('user_ref');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
