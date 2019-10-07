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
      $highestTemp = $this->getRooms()->orderBy('Temperature','desc')->first();
      if (!$highestTemp)
          return 0;

      return $highestTemp->Temperature;
    }

}
