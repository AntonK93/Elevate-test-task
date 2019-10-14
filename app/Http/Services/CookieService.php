<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

class CookieService 
{
    public function getDecryptedPosition() {
        $request = new Request([
            'Longtitude'   => Crypt::decrypt(Cookie::get('Longtitude'), false),
            'Latitude'  => Crypt::decrypt(Cookie::get('Latitude'), false),
        ]);
        return $request;        
     }
}