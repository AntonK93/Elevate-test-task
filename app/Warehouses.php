<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouses extends Model
{
    protected $fillable = ['Name', 'Longtitude', 'Latitude','Status','Temperature'];
    public $timestamps = false;

    public function getRooms()
    {
      return $this->hasMany('App\Rooms', 'Warehouse');
    }

    public function getHighestRoomTemperature()
    {
      return $this->getRooms()->orderBy('Temperature','desc')->first()->Temperature;
    }

}
