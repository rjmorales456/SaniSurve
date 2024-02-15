<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('sanitary_permits', function (Blueprint $table) {
            $table->id();
            $table->date('date_encoded');
            $table->string('owner_firstname');
            $table->string('owner_surname');
            $table->string('barangay');
            $table->string('sitio');
            $table->string('establishment_name');
            $table->unsignedInteger('personnel_count');
            $table->string('sanitary_permit_number')->unique();
            $table->string('inspected');
            $table->text('recommendation')->nullable();
            $table->double('latitude', 10, 6)->nullable();
            $table->double('longitude', 10, 6)->nullable();
            $table->unsignedBigInteger('encoder_id')->nullable();
            $table->foreign('encoder_id')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sanitary_permits');
    }
};
