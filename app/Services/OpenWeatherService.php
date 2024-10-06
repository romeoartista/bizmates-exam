<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenWeatherService extends BaseService
{
    public function __construct($api_key)
    {
        $this->api_key = $api_key;
        $this->base_api_url = 'https://api.openweathermap.org/data/2.5/forecast';
    }

    /**
     * 
     * Calls OpenWeatherMap's API for 5-day forecast of a location
     * 
     * @params string $city
     * @return array
     */
    public function getCurrentWeatherData($city)
    {
        $response = Http::get($this->base_api_url . '?' . http_build_query([
            'q' => rawurlencode($city),
            'units' => 'metric',
            'appid' => $this->api_key,
        ]));

        $weather_forecast_data = $response->json();
        $weather_forecast_data = $weather_forecast_data['list'];
        $weather_forecasts = [];
        $weather_forecast_index = '';
        $weather_forecast_subindex = '';

        foreach ($weather_forecast_data as $weather_forecast_item) {
            $weather_forecast_index = date('M j, Y - D', $weather_forecast_item['dt']);
            $weather_forecast_subindex = date('h A', $weather_forecast_item['dt']);
            $weather_forecasts[$weather_forecast_index][$weather_forecast_subindex] = [
                'weather' => ucwords(strtolower($weather_forecast_item['weather'][0]['description'])),
                'temperature' => $weather_forecast_item['main']['temp'] . '°',
                'precipitation' => isset($weather_forecast_item['rain']) ? $weather_forecast_item['rain']['3h'] . ' mm' : '0 mm',
                'humidity' => $weather_forecast_item['main']['humidity'] . '%',
            ];

            $weather_forecast_index = '';
            $weather_forecast_subindex = '';
        }

        return $weather_forecasts;
    }
}
