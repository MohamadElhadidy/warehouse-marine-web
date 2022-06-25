<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouses = Warehouse::all();
            return view('warehouse.report', [
            "warehouses" => $warehouses
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('warehouse.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        if(!$request->validate(
            [
                    'name' => 'required|unique:warehouses',
                    'code' => 'required|unique:warehouses',
                    'capacity' => 'required',
                    'size' => 'required',
                    'loacation' => 'required',
            ],
            [
                    'name.unique' => ' اسم المخزن موجود من قبل',
                    'name.required' =>  'ادخل اسم المخزن',
                    'code.unique' => ' كود المخزن موجود من قبل',
                    'code.required' => 'ادخل كود المخزن',
            ]
        )){
                return response($response, 422);
        }
        

        try {
            $warehouse = Warehouse::create([
                'name' =>$request->name,
                'code' => $request->code,
                'capacity' => $request->capacity,
                'size' => $request->size,
                'loacation' => $request->loacation
            ]);
            
        } catch (QueryException $e) {
            return response($e, 500);
        }

        $response = [
            'message' => 'warehouse created',
        ];

        return response($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse $warehouse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouse)
    {
        //
    }
}
