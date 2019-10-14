<?php

namespace App\Http\Services;

use App\Http\Services\CookieService;

class OpenMapDistance 
{
    private $apiUrl = 'https://routing.openstreetmap.de/routed-car/route/v1/driving/';

    private $cookies;

    /**
     * Injected dependency of CookieService
     */
    public function __construct(CookieService $cookies)
    {
        $this->cookies = $cookies;
    }

    /**
     * Calculating distance from destination request and handled position
     */
    public function calculateDistance($destinationRequest)
    {
        $position = $this->cookies->getDecryptedPosition()->Longtitude.",".$this->cookies->getDecryptedPosition()->Latitude;
        $destination = $destinationRequest->Longtitude.",".$destinationRequest->Latitude;
        $callUrl = $this->apiUrl.$position.";".$destination;
        $json = @file_get_contents($callUrl, true);
        if ($json !== false) {
            $response = json_decode($json);
            $distance = $response->routes[0]->legs[0]->distance;
            return round($distance / 100);
        }

        return 0;
    }
}