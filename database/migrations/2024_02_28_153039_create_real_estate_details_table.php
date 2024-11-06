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
        Schema::create('real_estate_details', function (Blueprint $table) {
            $table->id();
            $table->string('garage_spaces');
            $table->boolean('has_a_pool');
            $table->integer('numbers_of_balcony');
            $table->string('year_built');
            $table->string('agreement_type');//sfr,cnd
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realestate_details');
    }
};
