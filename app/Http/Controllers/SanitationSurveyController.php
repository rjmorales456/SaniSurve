<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanitationSurvey;

class SanitationSurveyController extends Controller
{
    public function get()
    {
        // Retrieve all sanitation surveys from the database
        $surveys = SanitationSurvey::all();

        // Transform certain fields from JSON to arrays
        $transformedSurveys = $surveys->map(function ($survey) {
            $survey->specified_method_for_excreta_disposal = json_decode($survey->specified_method_for_excreta_disposal);
            $survey->disposal_of_biodegradable = json_decode($survey->disposal_of_biodegradable);
            $survey->disposal_of_non_biodegradable = json_decode($survey->disposal_of_non_biodegradable);
            // You can add more fields here if needed

            return $survey;

        });

        // Return the transformed surveys as a JSON response
        return response()->json($transformedSurveys, 200);
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
            'disposal_of_biodegradable' => 'required|array',
            'disposal_of_non_biodegradable' => 'required|array',
            'recycling_and_reusing' => 'required|string',
            'depth' => 'nullable|string',
            'years_constructed' => 'nullable|string',
            'specified_method_for_excreta_disposal' => 'nullable|array',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'encoder_id' => 'nullable|exists:users,id',

            //'sanitation_survey_image_name' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

        ]);

        // Encode Arrays into Json
        $validatedData['specified_method_for_excreta_disposal'] = json_encode($validatedData['specified_method_for_excreta_disposal']);
        $validatedData['disposal_of_biodegradable'] = json_encode($validatedData['disposal_of_biodegradable']);
        $validatedData['disposal_of_non_biodegradable'] = json_encode($validatedData['disposal_of_non_biodegradable']);


        // Process image upload
        // $imageName = 'sanitation_survey_image_' . time() . '_' . uniqid() . '.' . $request->sanitation_survey_image_name->extension(); // Generate unique filename
        // $request->sanitation_survey_image_name->move(public_path('sanitation_survey_images'), $imageName); // Move uploaded image to storage directory


        // Create a new sanitation survey instance
        $sanitationSurvey = SanitationSurvey::create($validatedData);

        // Redirect or return a response
        return response()->json(['message' => 'Data stored successfully'], 200);
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');

        // Find the sanitation survey by its ID and delete it
        $sanitationSurvey = SanitationSurvey::findOrFail($id);
        $sanitationSurvey->delete();

        // Redirect or return a response
        return response()->json(['message' => 'Data deleted successfully'], 200);
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
            'disposal_of_biodegradable' => 'required|array',
            'disposal_of_non_biodegradable' => 'required|array',
            'recycling_and_reusing' => 'required|string',
            'depth' => 'nullable|string',
            'years_constructed' => 'nullable|string',
            'specified_method_for_excreta_disposal' => 'nullable|array',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            //'sanitation_survey_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate file type and size
        ]);

        // Find the sanitation survey by its ID
        $sanitationSurvey = SanitationSurvey::findOrFail($id);

        // Update the sanitation survey instance
        $sanitationSurvey->update($validatedData);

        // Redirect or return a response
        return response()->json(['message' => 'Data updated successfully'], 200);
    }

    /*
    
    public function destroy($id)
    {
        // Find the sanitation survey by its ID and delete it
        $sanitationSurvey = SanitationSurvey::findOrFail($id);
        $sanitationSurvey->delete();

        // Redirect or return a response
        return response()->json(['message' => 'Data deleted successfully'], 200);
    }
    
   public function index()
    {
        $surveys = SanitationSurvey::all();
        return view('sanitation_surveys.index', compact('surveys'));
    }

    */

}
