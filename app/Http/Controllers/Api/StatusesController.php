<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Statuses;

class StatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStatusOfDegree($degree)
    {
        return Statuses::select('Name','Threshold')->orderBy('Threshold','desc')->where('Threshold', '<', $degree)->first();
    }
}
