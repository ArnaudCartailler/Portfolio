<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;

use Session;
use Request;
use Response;

class SummonerController extends Controller
{


    // public function index()
    // {

    //     $method = 'GET';
    //     $route  = '/api/summoner';

    //     $option_list = array(
    //         'query' => [],
    //     );

    //     $request = ApiRequestController::CallApiOnce($method, $route, $option_list);

    //     if( !$request )
    //     {
    //         return Response::json([ "info" => "Can't retrieve summoners"], 400);
    //     }

    //     return Response::json(['message'=> 'Success', 'data' => json_decode($request, true)['data']], 200);

    // }


    public function show()
    {

        $summoner_name   = Request::route('summoner_name');
        $method     = 'GET';
        $route      = 'https://euw1.api.riotgames.com/lol/summoner/v4/summoners/by-name/' . $summoner_name ;

        $option_list = array(
            'query' => [],
        );

        $request = ApiRequestController::CallApiOnce($method, $route, $option_list);

        if( !$request )
        {
            return Response::json([ "info" => "Can't retrieve summoner detail"], 400);
        }

        return Response::json(['message'=> 'Success', 'data' => json_decode($request, true)], 200);

    }

}
