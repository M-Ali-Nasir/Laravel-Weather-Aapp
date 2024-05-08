<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;


class WeatherController extends Controller
{

    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;   
    }

    public function index(Request $request)
{
    try {
        $weatherResponse = [];

        if ($request->isMethod("post")) {
            $cityName = $request->city;

            $apiKey = config('services.openweather.api_key');
            $url = "https://api.openweathermap.org/data/2.5/weather?q={$cityName}&appid=2c0e009d837d96123f3730b0eb7de356";
            $response = $this->client->get($url);

            if ($response->getStatusCode() == 404) {
                throw new \Exception('City not found');
            }

            $weather = json_decode($response->getBody()->getContents());
            $weatherResponse = $weather;
        }
        
        return view("weather", [
            "data" => $weatherResponse,
        ]);
    } catch (\Exception $e) {
        $errorMessage = json_decode($e->getResponse()->getBody())->message ?? 'Unknown error';
    // Store the error message in the session flash data
        return back()->withError($errorMessage);
    }
}
}
