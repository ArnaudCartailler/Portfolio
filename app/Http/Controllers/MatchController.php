<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;

use Session;
use Request;
use Response;

class MatchController extends Controller
{

    public function index()
    {

        $account_id   = Request::route('account_id');
        $method     = 'GET';
        $route      = 'https://euw1.api.riotgames.com/lol/match/v4/matchlists/by-account/' . $account_id ;

        $option_list = array(
            'query' => [],
        );

        $request = ApiRequestController::CallApiOnce($method, $route, $option_list);

        if( !$request )
        {
            return Response::json([ "info" => "Can't retrieve matchs"], 400);
        }

        return Response::json(['message'=> 'Success', 'data' => json_decode($request, true)], 200);

    }

}
