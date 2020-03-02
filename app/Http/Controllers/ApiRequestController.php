<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\EntityBody;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
use Request;
use Session;
use Response;
use Log;
use Arr;

class ApiRequestController extends Controller
{
    /**
     * Get a Guzzle Http Client instance
     * Headers are automatically set from static method getHeaders
     * @param $option_array
     * @return Client
     */
    public static function getClient()
    {
        return new Client([
            "base_uri" => self::getBaseUri(),
            "headers" => self::getHeaders(),
            "timeout"  => 200.0,
        ]);
    }

    /**
     * Get Base URI for API Call
     * @return string API_URL
     */
    public static function getBaseUri(){
        return env( "API_URL" );
    }

    /**
     * Build the header list
     * @return array
     */
    public static function getHeaders(){

        // $api_key = env('RIOT_API_KEY');

        // build header list
        $header_list = [
            'Content-Type' => 'application/json; charset=UTF-8',
            'Accept' => 'application/json; charset=UTF-8',
            'Origin'=> 'https://developer.riotgames.com',
            'X-Riot-Token'=> 'RGAPI-0b855cff-aa28-45f6-a762-825885dee0ae',
            'Accept-Language'=> 'fr,de;q=0.9,fr-FR;q=0.8,en-US;q=0.7,en;q=0.6',
            'User-Agent'=> 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.122 Safari/537.36'
        ];

        return $header_list;
    }

    /**
     * Call the Riot API
     * sends a GuzzleHttp request
     * @param $method
     * @param $route
     * @param $options
     * @return string
     */

    public static function callApiOnce($method, $route, $option_array)
    {
        // retrieve default headers
        $option_array[ "headers" ] = self::getHeaders();

        // instantiate a client
        $client = self::getClient();

        $response = $client->request( $method, $route, [
            "json" => $option_array[ "query" ]
        ] );

        if( 200 !== $response->getStatusCode() ){
            return false;
        }

        // cast response
        $response = ( string ) $response->getBody()->getContents();

        Log::info( $response );

        return $response;
    }

    /**
     * Performs multiple API calls
     * @param $routes
     * @return array
     */
    public static function callApiMany( $routes )
    {
        $response = array();

        // call API for each routes provided
        foreach($routes as $route => $settings)
        {
            // single API Call giving parameters
            $request = self::callApiOnce(
                $settings['method'],
                $settings['route'],
                $settings['options']
            );
            
            $response[ $route ] = json_decode( $request, true )[ "data" ];

        }

        return $response;
    }

}
