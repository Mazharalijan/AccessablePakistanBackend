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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id('address_id');
            $table->string('address_name');
            $table->text('address');
            $table->text('remarks');
            $table->double('lat', 10,8)->nullable();
            $table->double('lng', 10,8)->nullable();
            $table->integer('fk_disabilitytype_id');
            $table->integer('fk_district_id');
            $table->enum('status',['Active','In-Active'])->default('In-Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
