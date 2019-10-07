<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Services\OpenMapDistance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Warehouses;

class WarehousesController extends Controller
{
    private $openMap;
    private $statuses;

    /**
     * Injected dependency of OpenMap,StatusesController
     */
    public function __construct(OpenMapDistance $openMap, StatusesController $statusesController)
    {
        $this->openMap = $openMap;
        $this->statuses = $statusesController;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Warehouses::all();
    }

    /**
     * Update status of warehouse
     */
    public function updateTemperatureOfWarehouse($id) 
    {
        $warehouse = Warehouses::findOrFail($id);

        $highetWarehouseTemperature = $warehouse->getHighestRoomTemperature();

        $getStatus = $this->statuses->getStatusOfDegree($highetWarehouseTemperature);
        
        $warehouse->update(['Status' => $getStatus->Name, 'Temperature' => $highetWarehouseTemperature]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $warehouse = Warehouses::create($request->all());
        return $warehouse;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $warehouse = Warehouses::findOrFail($id);
        $warehouse['distance'] = $this->openMap->calculateDistance($warehouse);
        return $warehouse;
    }

    /**
     * Display related rooms
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getRooms($id)
    {
        $warehouse = Warehouses::findOrFail($id);
        return $warehouse->getRooms()->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $warehouses = Warehouses::findOrFail($id);
        $warehouses->update($request->all());
 
        return $warehouses;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $warehouses = Warehouses::findOrFail($id);
        $warehouses->delete();
        return '';
    }
}
