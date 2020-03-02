<?php

namespace App\Http\Middleware;

use Response;
use Closure;
use Request;

class CheckSummonerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $summoner_name = Request::route('summoner_name', null);

        if(!$summoner_name)
        {
            return Response::json(['info' => 'summoner_name not found'], 404);
        }

        return $next($request);
    }
}
