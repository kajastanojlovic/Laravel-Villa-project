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
        Schema::create('real_estate', function (Blueprint $table) {
            $table->id();
            //$table->string('name'); ime je adresa grad i drzava?
            $table->integer('total_space');
            $table->integer('number_of_bedrooms');
            $table->integer('number_of_bathrooms');
            $table->integer('number_of_floors');
            $table->foreignId('type_id')->constrained('real_estate_types');
            $table->foreignId('status_id')->default(1)->constrained('status');
            $table->foreignId('details_id')->constrained('real_estate_details');
            $table->foreignId('city_id')->constrained('cities');
            $table->string('image');
            $table->decimal('price', 10 , 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('real_estate');
    }
};
