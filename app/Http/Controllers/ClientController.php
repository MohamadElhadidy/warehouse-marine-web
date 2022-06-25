<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
            return view('client.report', [
            "clients" => $clients
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.add');
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
                    'name' => 'required|unique:clients',
                    'code' => 'required|unique:clients',
                    'email' => 'nullable|email|unique:clients',
                    'tele' => 'nullable|numeric|unique:clients',
            ],
            [
                    'name.unique' => ' اسم العميل موجود من قبل',
                    'name.required' =>  'ادخل اسم العميل',
                    'code.unique' => ' كود العميل موجود من قبل',
                    'code.required' => 'ادخل كود العميل',
                    'email.unique' => '  البريد الإلكتروني  موجود من قبل',
                    'email.email' => 'ادخل البريد الإلكتروني بشكل صحيح ',
                    'tele.unique' => '   رقم التليفون موجود من قبل',
                    'tele.numeric' => 'ادخل رقم التليفون  بشكل صحيح ',
            ]
        )){
                return response($response, 422);
        }
        

        try {
            $warehouse = Client::create([
                'name' =>$request->name,
                'code' => $request->code,
                'address' => $request->address,
                'tele' => $request->tele,
                'email' => $request->email
            ]);
            
        } catch (QueryException $e) {
            return response($e, 500);
        }

        $response = [
            'message' => 'client created',
        ];

        return response($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
