<?php

namespace App\Services;

class TouristGuideService
{
    public function __construct()
    {

    }

    /**
     * Gets data from Foursquare and OpenWeatherMap's API
     * 
     * @params string $cities
     * @params string $foursquare_api_key
     * @params string $openweather_api_key
     * @return array
     */
    public function getTouristGuideData($cities, $foursquare_api_key, $openweather_api_key)
    {
        $foursquare_service = new FoursquareService($foursquare_api_key);
        $openweather_service = new OpenWeatherService($openweather_api_key);
        $foursquare_data = [];
        $openweather_data = [];
        $display_data = [];

        foreach ($cities as $key => $value) {
            $foursquare_data = $foursquare_service->searchPlace($value['search_string']);
            $openweather_data = $openweather_service->getCurrentWeatherData($key);

            $display_data[$key] = [
                'city_name' => $value['display_name'],
                'forecasts' => $openweather_data,
                'places' => $foursquare_data,
            ];

            $foursquare_data = [];
            $openweather_data = [];
        }

        return $display_data;
    }
}
