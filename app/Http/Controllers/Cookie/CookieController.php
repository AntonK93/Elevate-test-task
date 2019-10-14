<?php

namespace App\Http\Controllers\Cookie;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

class CookieController extends Controller
{

    public function setPosition(Request $request) {
        $response = new Response('Positions');
        $response->withCookie(Cookie::forever('Longtitude', $request->Longtitude));
        $response->withCookie(Cookie::forever('Latitude', $request->Latitude));
        return $response;
     }

     public function getPosition() {
        $request = new Request([
            'Longtitude'   => Cookie::get('Longtitude'),
            'Latitude'  => Cookie::get('Latitude'),
        ]);
        return $request;
     }
}