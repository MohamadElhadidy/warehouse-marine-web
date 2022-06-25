<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
            return view('type.report', [
            "types" => $types
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('type.add');
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
                    'name' => 'required|unique:types',
                    'code' => 'required|unique:types',
            ],
            [
                    'name.unique' => ' اسم الصنف موجود من قبل',
                    'name.required' =>  'ادخل اسم الصنف',
                    'code.unique' => ' كود الصنف موجود من قبل',
                    'code.required' => 'ادخل كود الصنف',
            ]
        )){
                return response($response, 422);
        }
        

        try {
            $warehouse = Type::create([
                'name' =>$request->name,
                'code' => $request->code,
            ]);
            
        } catch (QueryException $e) {
            return response($e, 500);
        }

        $response = [
            'message' => 'Type created',
        ];

        return response($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        //
    }
}
