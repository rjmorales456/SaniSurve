<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanitaryPermit;

class SanitaryPermitController extends Controller
{
    public function get()
    {
        $permits = SanitaryPermit::all();
        return response()->json($permits, 200);
    }
    
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'date_encoded' => 'required|date',
            'owner_firstname' => 'required|string',
            'owner_surname' => 'required|string',
            'barangay' => 'required|string',
            'sitio' => 'required|string',
            'establishment_name' => 'required|string',
            'personnel_count' => 'required|integer|min:0',
            'sanitary_permit_number' => 'required|string|unique:sanitary_permits',
            'inspected' => 'required|string',
            'recommendation' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            
            //'encoder_id' => 'nullable|exists:users,id',
        ]);

        // Create a new SanitaryPermit instance with the validated data
        $sanitaryPermit = SanitaryPermit::create($validatedData);

        // Optionally, you can return a response indicating success or redirect to a different route
        return response()->json(['message' => 'Data stored successfully'], 200);
    }
    
}
