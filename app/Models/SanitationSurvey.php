<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanitationSurvey extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_encoded',
        'surname',
        'first_name',
        'middle_name',
        'sitio',
        'barangay',
        'ownership',
        'number_of_occupants',
        'number_of_families',
        'type_of_water_source',
        'accessibility_to_water_source',
        'kind_of_water_source',
        'excreta_disposal',
        'shared_with_other_household',
        'household_practices_waste_segregation',
        'collected_by_city_collection_and_disposal_system',
        'disposal_of_biodegradable',
        'disposal_of_non_biodegradable',
        'recycling_and_reusing',
        'depth',
        'years_constructed',
        'specified_method_for_excreta_disposal',
        'latitude',
        'longitude',
        'encoder_id'
    ];
}
