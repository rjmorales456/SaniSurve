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
        Schema::create('sanitation_surveys', function (Blueprint $table) {
            $table->id();
            $table->date('date_encoded');
            $table->string('surname');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('sitio');
            $table->string('barangay');
            $table->string('ownership');
            $table->unsignedInteger('number_of_occupants');
            $table->unsignedInteger('number_of_families');
            $table->string('type_of_water_source');
            $table->string('accessibility_to_water_source');
            $table->string('kind_of_water_source');
            $table->string('excreta_disposal');
            $table->string('shared_with_other_household');
            $table->string('household_practices_waste_segregation');
            $table->string('collected_by_city_collection_and_disposal_system');
            $table->json('disposal_of_biodegradable')->nullable();
            $table->json('disposal_of_non_biodegradable')->nullable();
            $table->string('recycling_and_reusing');
            $table->string('depth')->nullable();
            $table->string('years_constructed')->nullable();
            $table->json('specified_method_for_excreta_disposal')->nullable();
            $table->double('latitude', 10, 6)->nullable();
            $table->double('longitude', 10, 6)->nullable();
            $table->string('sanitation_survey_image_name')->nullable();
            //Encoder ID ---
            $table->unsignedBigInteger('encoder_id')->nullable(); // Column to store the ID of the user who encoded the survey
            $table->foreign('encoder_id')->references('id')->on('users')->onDelete('set null'); // Foreign key constraint to link 'encoder_id' to 'id' in 'users', setting it to null if user is deleted
            // ---
            
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sanitation_surveys');
    }
};
