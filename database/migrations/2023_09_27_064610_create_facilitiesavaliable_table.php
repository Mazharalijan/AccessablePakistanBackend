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
        Schema::create('facilitiesavaliable', function (Blueprint $table) {
            $table->id('facilities_id');
            $table->string('facilities_title');
            $table->enum('status',['Yes','No','NA']);
            $table->integer('fk_disabilitytype_id');
            $table->integer('fk_address_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facilitiesavaliable');
    }
};
