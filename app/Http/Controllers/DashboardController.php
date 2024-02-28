<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanitationSurvey;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{

    public function get()
    {
        $surveys = SanitationSurvey::all();

        // Return the surveys as a JSON response
        return response()->json($surveys, 200);
    }

    // Filter??
    public function filterDashboard()
    {
        $filter = SanitationSurvey::where('barangay')->get();

        return response()->json($filter, 200);
    }

    // Get Number of answered surveys
    public function answeredSurvey()
    {
        $ans_surveys = SanitationSurvey::count("id");

        return response()->json($ans_surveys, 200);

    }

    public function TotalOccupants()
    {
        $total_occupants = SanitationSurvey::sum("number_of_occupants");

        return response()->json($total_occupants, 200);
    }

    // Get Average Family Members
    public function AvgFamily()
    {
        $avg_family = SanitationSurvey::avg("number_of_families");

        $avg_family = number_format($avg_family, 2);

        return response()->json($avg_family, 200);
    }


    // Shared Household Facility

    public function sharedHousehold()
    {
        $yesCount = SanitationSurvey::where('shared_with_other_household', 'Yes')->count();
        $noCount = SanitationSurvey::where('shared_with_other_household', 'No')->count();

        return response()->json(['yesCount' => $yesCount, 'noCount' => $noCount], 200);
    }

    // Waste Segregation

    public function wasteSegregation()
    {
        $yesCount = SanitationSurvey::where('household_practices_waste_segregation', 'Yes')->count();
        $noCount = SanitationSurvey::where('household_practices_waste_segregation', 'No')->count();

        return response()->json(['yesCount' => $yesCount, 'noCount' => $noCount], 200);
    }

    // Waste Collected
    public function wasteCollected()
    {
        $yesCount = SanitationSurvey::where('collected_by_city_collection_and_disposal_system', 'Yes')->count();
        $noCount = SanitationSurvey::where('collected_by_city_collection_and_disposal_system', 'No')->count();

        return response()->json(['yesCount' => $yesCount, 'noCount' => $noCount], 200);
    }

    // Recycling and Reuse
    public function RecycleandReuse()
    {
        $yesCount = SanitationSurvey::where('recycling_and_reusing', 'Yes')->count();
        $noCount = SanitationSurvey::where('recycling_and_reusing', 'No')->count();

        return response()->json(['yesCount' => $yesCount, 'noCount' => $noCount], 200);
    }

    // Property Ownership


    public function propertyOwnership()
    {



        // $owned = SanitationSurvey::where('ownership','Owned')->count();
        // $informal_settler = SanitationSurvey::where('ownership','Informal Settler')->count();
        // $rent = SanitationSurvey::where('ownership','Rent')->count();
        // $tenant = SanitationSurvey::where('ownership','Tenant')->count();



    }
}
