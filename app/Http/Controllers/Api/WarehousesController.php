<?php

namespace App\Http\Controllers\Api;

use App\Http\Services\OpenMapDistance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Warehouses;

class WarehousesController extends Controller
{
    private $openMap;

    /**
     * Injected dependency of OpenMap
     */
    public function __construct(OpenMapDistance $openMap)
    {
        $this->openMap = $openMap;
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
        $warehouse = Warehouses::findOrFail($id);
        $warehouse->update($request->all());
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
        $warehouse = Warehouses::findOrFail($id);
        $warehouse->delete();
        return '';
    }
}
