<?php

namespace App\Http\Services;

use App\Model\Warehouses;
use App\Model\Statuses;

class WarehouseService 
{
    /**
     * Update status of warehouse
     */
    public function updateTemperatureOfWarehouse(Warehouses $warehouse) 
    {
        $highestWarehouseTemperature = $warehouse->getHighestRoomTemperature();
        $getStatus = Statuses::select('Name','Threshold')->orderBy('Threshold','desc')->where('Threshold', '<', $highestWarehouseTemperature)->first();
        
        $warehouse->update(['Status' => $getStatus->Name, 'Temperature' => $highestWarehouseTemperature]);
    }
}