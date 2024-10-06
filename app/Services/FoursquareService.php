<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FoursquareService extends BaseService
{
    public function __construct($api_key)
    {
        $this->api_key = $api_key;
        $this->base_api_url = 'https://api.foursquare.com/v3/';
    }

    /**
     * 
     * Calls Foursquare's "Place Search" API endpoint from a search term
     * 
     * @params string $search_place_string
     * @return array
     */
    public function searchPlace($search_place_string)
    {
        $response = Http::withHeaders([
            'Authorization' => $this->api_key,
            'Accept' => 'application/json',
        ])->get($this->base_api_url . 'places/search?' . http_build_query([
            'near' => $search_place_string,
            'fields' => 'name,categories,location,rating,price,closed_bucket,photos',
            'limit' => env('FOURSQUARE_PLACE_LIMIT'),
        ]));

        $places_data = $response->json();
        $places_data = $places_data['results'];
        $places = [];
        $closed_bucket = '';

        foreach ($places_data as $place_data) {
            $closed_bucket = $place_data['closed_bucket'];

            if (str_starts_with($closed_bucket, 'VeryLikely')) {
                if (str_contains($closed_bucket, 'Open')) {
                    $closed_bucket = 'Very likely open';
                } elseif (str_contains($closed_bucket, 'Closed')) {
                    $closed_bucket = 'Very likely closed';
                }
            } elseif (str_starts_with($closed_bucket, 'Likely')) {
                if (str_contains($closed_bucket, 'Open')) {
                    $closed_bucket = 'Likely open';
                } elseif (str_contains($closed_bucket, 'Closed')) {
                    $closed_bucket = 'Likely closed';
                }
            }

            $places[] = [
                'name' => $place_data['name'],
                'category' => $place_data['categories'][0]['short_name'],
                'address' => $place_data['location']['formatted_address'],
                'rating' => ($place_data['rating']) ? $place_data['rating'] : 'N/A',
                'is_closed' => $closed_bucket,
                'photo' => $place_data['photos'][0]['prefix'] . '120' . $place_data['photos'][0]['suffix']
            ];

            $closed_bucket = '';
        }

        return $places;
    }
}
