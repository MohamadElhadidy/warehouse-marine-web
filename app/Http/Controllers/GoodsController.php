<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\Type;
use App\Models\Client;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

            $goods = Goods::all();
            // foreach ($certificates as $certificate ) {
            //     $sum = DB::table('permit')
            //                          ->where('certificate', '=', $certificate->id)
            //                          ->sum('quantity');
            // }
            return view('goods.report', [
            "goods" => $goods
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            $types = Type::all();
            $clients = Client::all();
            return view('goods.add', [
                "types" => $types,
                "clients" => $clients,
            ]);
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
                    'custom' => 'required',
                    'type' => 'required|exists:types,id',
                    'client' => 'required|exists:clients,id',
                    'balance' => 'required|numeric',
                    'vessel' => 'required',
                    'date' => 'required|date',
            ],
            [
                    'custom.unique' =>'  رقم الإفراج الجمركي   موجود  من قبل',
                    'custom.required' =>  'ادخل  رقم الإفراج الجمركي',

                    'type.exists' =>'  الصنف  غير موجود  ',
                    'type.required' => 'ادخل  الصنف',

                    'client.exists' => ' اسم العميل  غير موجود  ',
                    'client.required' =>  'ادخل  العميل',
                    
                    'date.required' =>  'ادخل  تاريخ بداية التخزين',
                    'date.date' => 'ادخل تاريخ بداية التخزين  بشكل صحيح ',

                    'balance.required' =>  'ادخل رصيد أول ',
                    'balance.numeric' => 'ادخل رصيد أول بشكل صحيح ',

                    'vessel.required' => 'ادخل  اسم الباخرة',

            ]
        )){
                return response($response, 422);
        }
        

        try {
            $goods = Goods::create([
                'custom' =>$request->custom,
                'type' => $request->type,
                'client' => $request->client,
                'balance' => $request->balance,
                'vessel' => $request->vessel,
                'date' => $request->date
            ]);
            
        } catch (QueryException $e) {
            return response($e, 500);
        }

        $response = [
            'message' => 'goods created',
        ];

        return response($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function show(Goods $goods)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function edit(Goods $goods)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goods $goods)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goods  $goods
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goods $goods)
    {
        //
    }
}
