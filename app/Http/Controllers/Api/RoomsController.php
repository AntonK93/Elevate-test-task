<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rooms;

class RoomsController extends Controller
{
    private $warehouses;

    /**
     * Injected dependency of WarehousesController
     */
    public function __construct(WarehousesController $warehousesController)
    {
        $this->warehouses = $warehousesController;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Rooms::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $room = Rooms::create($request->all());
        $this->warehouses->updateTemperatureOfWarehouse($room->getWarehouse()->id);
        return $room;
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Rooms::findOrFail($id);
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
        $room = Rooms::findOrFail($id);
        $room->update($request->all());
        $this->warehouses->updateTemperatureOfWarehouse($room->getWarehouse()->id);
        return $room;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = Rooms::findOrFail($id);
        $room->delete();
        $this->warehouses->updateTemperatureOfWarehouse($room->getWarehouse()->id);
        return '';
    }
}
