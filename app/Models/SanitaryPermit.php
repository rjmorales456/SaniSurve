<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanitaryPermit extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_encoded',
        'owner_firstname',
        'owner_surname',
        'owner_middlename',
        'barangay',
        'sitio',
        'establishment_name',
        'personnel_count',
        'sanitary_permit_number',
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
