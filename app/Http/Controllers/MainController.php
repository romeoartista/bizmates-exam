<?php

namespace App\Http\Controllers;

use App\Services\TouristGuideService;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class MainController extends Controller
{
    public function index()
    {
        $cities = config('constants.cities');
        $tourist_guide_service = new TouristGuideService();
        $tourist_guide_data = $tourist_guide_service->getTouristGuideData($cities, env('FOURSQUARE_API_KEY'), env('OPENWEATHER_API_KEY'));

        return Inertia::render('Index', [
            'tourist_guide_data' => $tourist_guide_data,
        ]);
    }
}
