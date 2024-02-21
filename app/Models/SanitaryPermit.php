<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanitaryPermit extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_encoded',
        'time_of_inspection',
        'owner_firstname',
        'owner_surname',
        'barangay',
        'sitio',
        'establishment_name',
        'personnel_count',
        'malePersonnel_count',
        'femalePersonnel_count',
        'sanitary_permit_number',
        'permit_type',
        'toilet_provision',
        'solid_waste_management',
        'water_supply',
        'inspected',
        'recommendation',
        'latitude',
        'longitude',
        'encoder_id',
    ];

    /*
    
    public function encoder()
    {
        return $this->belongsTo(User::class, 'encoder_id');
    }
    
    */
}
