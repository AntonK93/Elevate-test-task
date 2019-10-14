<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    protected $fillable = ['Warehouse', 'Name', 'Temperature'];
    public $timestamps = false;

    public function getWarehouse()
    {
      return $this->belongsTo('App\Model\Warehouses', 'Warehouse', 'id')->first();
    }

}
