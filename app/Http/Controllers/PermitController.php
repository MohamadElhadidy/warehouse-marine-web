<?php

namespace App\Http\Controllers;

use App\Models\Permit;
use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\Goods;

class PermitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $permits = Permit::all();
     
            return view('permit.report', [
            "permits" => $permits
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            $warehouses = Warehouse::all();
            $goods = Goods::all();
            return view('permit.add', [
                "warehouses" => $warehouses,
                "goods" => $goods
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
        do {
            $permit_num = random_int(100000, 999999);
        } while (Permit::where("permit_num", "=", $permit_num)->first());

        if(!$request->validate(
            [
                    'warehouse' => 'required|exists:warehouses,id',
                    'custom' => 'required|exists:goods,custom',
                    'contractor' => 'required',
                    'driver' => 'required',
                    'car_no' => 'required',
                    'car_no2' => 'required',
                    'employee' => 'required',
            ],
            [
                    'warehouse.exists' =>'  المخزن  غير موجود  ',
                    'warehouse.required' =>  'ادخل  المخزن',

                    'custom.required' =>  'ادخل  رقم الإفراج الجمركي   ',
                    'custom.numeric' => ' ادخل  رقم الإفراج الجمركي  بشكل صحيح ',
                    'custom.exists' => '   رقم الإفراج الجمركي   غير موجود ',

                    'contractor.required' =>  'ادخل اسم المقاول',
                    'driver.required' => 'ادخل اسم السائق',
                    'car_no.required' => 'ادخل  رقم وش السيارة',
                    'car_no2.required' => 'ادخل  رقم  المقطورة',
                    'employee.required' => 'ادخل   اسم الموظف',

            ]
        )){
                return response($response, 422);
        }
        $goods = Goods::where('custom',$request->custom)->orderby('id','desc')->first();

        try {
            $permit = Permit::create([
                'permit_num' =>$permit_num,
                'employee' =>$request->employee,
                'warehouse' =>$request->warehouse,
                'client' => $goods->client,
                'type' => $goods->type,
                'custom' => $request->custom,
                'contractor' => $request->contractor,
                'driver' => $request->driver,
                'car_no' => $request->car_no,
                'car_no2' => $request->car_no2
            ]);
            
        } catch (QueryException $e) {
            return response($e, 500);
        }

        $response = [
            'message' => 'permit created',
        ];

        return response($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permit  $permit
     * @return \Illuminate\Http\Response
     */
    public function show(Permit $permit)
    {
        //
    }
    public function cost($permit_num)
    {
        $permit = Permit::where([['permit_num',$permit_num],['arrival',1],['is_delete',0]])->first();
        if($permit){
                return view('permit.cost', [    
                "permit" => $permit
            ]);
        }else {
            return redirect('/');
        }
            
    }  

      public function print($permit_num)
    {
        $permit = Permit::where([['permit_num',$permit_num],['is_delete',0]])->first();
        if($permit){
                return view('permit.print', [    
                "permit" => $permit
            ]);
        }else {
            return redirect('/');
        }
            
    }  
    
    public function addCost(Request $request)
    {
        $cost_types =['quantity','moves'];
        if(!$request->validate(
            [
                    'quantity' => 'required',
                    'cost' => 'required',
                    'cost_type' => 'required|in:'.implode(",", $cost_types)
            ],
            [
                    'quantity.required' => 'ادخل  وزن النقلة',
                    'cost.required' => 'ادخل  سعر الطن',
                    'cost_type.required' => 'ادخل   نوع الحساب',
                    'cost_type.in' => 'ادخل   نوع الحساب بشكل صحيح',


            ]
        )){
                return response($response, 422);
        }
    

        try {
                $permit = Permit::where('permit_num',$request->permit_num)->first();
                $permit->quantity =$request->quantity;
                $permit->cost = $request->cost;
                $permit->cost_type = $request->cost_type;

                $permit->save();
            
        } catch (QueryException $e) {
            return response($e, 500);
        }

        $response = [
            'message' => 'cost created',
        ];

        return response($response, 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permit  $permit
     * @return \Illuminate\Http\Response
     */
    public function edit(Permit $permit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permit  $permit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permit $permit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permit  $permit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permit $permit)
    {
        //
    }
}
