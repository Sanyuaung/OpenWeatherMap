<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function getWeather(Request $request)
    {
        $apiKey = env('OPENWEATHER_API_KEY');
        $city = $request->input('city');
        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->get("https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}");
            $data = json_decode($response->getBody(), true);

            return view('welcome', [
                'data' => $data,
                'name' => $data['name'],
                'temp' => $data['main']['temp'],
                'weather' => $data['weather'][0]['description'],
                'dateTime' => date('Y-m-d', $data['dt']),
            ]);
        } catch (RequestException $e) {
            $responseBody = $e->getResponse()->getBody()->getContents();
            $responseArray = json_decode($responseBody, true);
            $message = $responseArray['message'] ?? 'An error occurred';
            return redirect()->route('home')->with('error', ucwords($message));
        }
    }
}