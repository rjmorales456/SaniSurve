<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanitationSurvey;

class SanitationSurveyController extends Controller
{
    public function create()
    {
        return view('sanitation_surveys.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'date_encoded' => 'required|date',
            'surname' => 'required|string',
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'sitio' => 'required|string',
            'barangay' => 'required|string',
            'ownership' => 'required|string',
            'number_of_occupants' => 'required|integer|min:1|max:100',
            'number_of_families' => 'required|integer|min:1|max:50',
            'type_of_water_source' => 'required|string',
            'accessibility_to_water_source' => 'required|string',
            'kind_of_water_source' => 'required|string',
            'excreta_disposal' => 'required|string',
            'shared_with_other_household' => 'required|string',
            'household_practices_waste_segregation' => 'required|string',
            'collected_by_city_collection_and_disposal_system' => 'required|string',
            'disposal_of_biodegradable' => 'nullable|array', 
            'disposal_of_non_biodegradable' => 'nullable|array',
            'recycling_and_reusing' => 'required|string',
            'depth' => 'nullable|string',
            'years_constructed' => 'nullable|string',
            'specified_method_for_excreta_disposal' => 'nullable|array',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            
            //'sanitation_survey_image_name' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

            //'encoder_id' => 'nullable|exists:users,id', // Ensure encoder_id exists in the users table
        
        ]);

        // Process image upload
        // $imageName = 'sanitation_survey_image_' . time() . '_' . uniqid() . '.' . $request->sanitation_survey_image_name->extension(); // Generate unique filename
        // $request->sanitation_survey_image_name->move(public_path('sanitation_survey_images'), $imageName); // Move uploaded image to storage directory

        // Check if the 'disposal_of_biodegradable' field exists
        if (isset($validatedData['disposal_of_biodegradable'])) {
            // Convert the array to a string before inserting into the database
            $validatedData['disposal_of_biodegradable'] = json_encode($validatedData['disposal_of_biodegradable']);
        } else {
            // If the field is not present or empty, set it to null
            $validatedData['disposal_of_biodegradable'] = null;
        }

        // Check if the 'disposal_of_non_biodegradable' field exists
        if (isset($validatedData['disposal_of_non_biodegradable'])) {
            // Convert the array to a string before inserting into the database
            $validatedData['disposal_of_non_biodegradable'] = json_encode($validatedData['disposal_of_non_biodegradable']);
        } else {
            // If the field is not present or empty, set it to null
            $validatedData['disposal_of_non_biodegradable'] = null;
        }
        
        // Check if the specified_method_for_excreta_disposal field is present and not empty
        if (isset($validatedData['specified_method_for_excreta_disposal'])) {
            // Convert the array to a string before inserting into the database
            $validatedData['specified_method_for_excreta_disposal'] = json_encode($validatedData['specified_method_for_excreta_disposal']);
        } else {
            // If the field is not present or empty, set it to null
            $validatedData['specified_method_for_excreta_disposal'] = null;
        } 

        // Create a new sanitation survey instance
        $sanitationSurvey = SanitationSurvey::create($validatedData);

        // Redirect or return a response
        return response()->json(['message' => 'Data stored successfully'], 200);
    }

    public function edit($id)
    {
        $sanitationSurvey = SanitationSurvey::findOrFail($id);

        return view('sanitation_surveys.edit', compact('sanitationSurvey'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $validatedData = $request->validate([
            'date_encoded' => 'required|date',
            'surname' => 'required|string',
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'sitio' => 'required|string',
            'barangay' => 'required|string',
            'ownership' => 'required|string',
            'number_of_occupants' => 'required|integer|min:1|max:100',
            'number_of_families' => 'required|integer|min:1|max:50',
            'type_of_water_source' => 'required|string',
            'accessibility_to_water_source' => 'required|string',
            'kind_of_water_source' => 'required|string',
            'excreta_disposal' => 'required|string',
            'shared_with_other_household' => 'required|string',
            'household_practices_waste_segregation' => 'required|string',
            'collected_by_city_collection_and_disposal_system' => 'required|string',
            'disposal_of_biodegradable' => 'nullable|array', 
            'disposal_of_non_biodegradable' => 'nullable|array',
            'recycling_and_reusing' => 'required|string',
            'depth' => 'nullable|string',
            'years_constructed' => 'nullable|string',
            'specified_method_for_excreta_disposal' => 'nullable|array',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'sanitation_survey_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate file type and size
        ]);

        // Find the sanitation survey by its ID
        $sanitationSurvey = SanitationSurvey::findOrFail($id);

        // Update the sanitation survey instance
        $sanitationSurvey->update($validatedData);

        // Redirect or return a response
        return response()->json(['message' => 'Data updated successfully'], 200);
    }

    public function destroy($id)
    {
        // Find the sanitation survey by its ID and delete it
        $sanitationSurvey = SanitationSurvey::findOrFail($id);
        $sanitationSurvey->delete();

        // Redirect or return a response
        return response()->json(['message' => 'Data deleted successfully'], 200);
    }

/*    public function index()
    {
        $surveys = SanitationSurvey::all();
        return view('sanitation_surveys.index', compact('surveys'));
    }
*/
    
}
