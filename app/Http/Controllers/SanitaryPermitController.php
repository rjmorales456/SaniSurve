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
            'time_of_inspection' => 'required|date_format:H:i',
            'owner_firstname' => 'required|string',
            'owner_surname' => 'required|string',
            'barangay' => 'required|string',
            'sitio' => 'required|string',
            'establishment_name' => 'required|string',
            'personnel_count' => 'required|integer|min:0',
            'malePersonnel_count' => 'required|integer|min:0',
            'femalePersonnel_count' => 'required|integer|min:0',
            'sanitary_permit_number' => 'required|string|unique:sanitary_permits',
            'permit_type' => 'required|string',
            'toilet_provision' => 'required|string',
            'solid_waste_management' => 'required|string',
            'water_supply' => 'required|string',
            'inspected' => 'required|string',
            'recommendation' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'encoder_id' => 'nullable|exists:users,id',
        ]);

        // Create a new SanitaryPermit instance with the validated data
        $sanitaryPermit = SanitaryPermit::create($validatedData);

        // Optionally, you can return a response indicating success or redirect to a different route
        return response()->json(['message' => 'Data stored successfully'], 200);
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $validatedData = $request->validate([
            'date_encoded' => 'required|date',
            'time_of_inspection' => 'required|date_format:H:i',
            'owner_firstname' => 'required|string',
            'owner_surname' => 'required|string',
            'barangay' => 'required|string',
            'sitio' => 'required|string',
            'establishment_name' => 'required|string',
            'personnel_count' => 'required|integer|min:0',
            'malePersonnel_count' => 'required|integer|min:0',
            'femalePersonnel_count' => 'required|integer|min:0',
            'sanitary_permit_number' => 'required|string|unique:sanitary_permits',
            'permit_type' => 'required|string',
            'toilet_provision' => 'required|string',
            'solid_waste_management' => 'required|string',
            'water_supply' => 'required|string',
            'inspected' => 'required|string',
            'recommendation' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        try {
            // Find the Sanitary Permit by its ID
            $sanitaryPermit = SanitaryPermit::findOrFail($id);

            // Update the Sanitary Permit instance
            $sanitaryPermit->update($validatedData);

            // Return a success response
            return response()->json(['message' => 'Data updated successfully'], 200);
        } catch (\Exception $e) {
            // Handle any exceptions, such as the Sanitary Permit not found
            return response()->json(['error' => 'Failed to update data: ' . $e->getMessage()], 500);
        }
    }     
}
