<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Input; 
use App\Models\ProductTypeModel AS PTM;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $cValidator = [
        'name' => 'required|min:3|max:255',
    ];

    protected $cValidatorMsg = [
        'name.required' => 'กรุณากรอกซื้อสินค้า',
        'name.min' => 'ชื่อสินค้าต้องมี่อย่างน้อย 3 ตัวอักษร',
        'name.max' => 'ชื่อสินค้าต้องไม่เกิน 255 ตัวอักษร',
    ];
    public $limit = 3;
    public function index(Request $request, PTM $ptm)
    {
        //
        $request->limit= !empty($request->limit) ? $request->limit : $this->limit;
        $data = $ptm->lists( $request );
        return view('type')->with( ["data"=>$data,"limit"=>$request->limit]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('form.formType');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),$this->cValidator,$this->cValidatorMsg);
        if($validator->fails() ){
            return back()
            ->withInput()
            ->withErrors( $validator->errors());
        }
        if( $validator ){
            $data = new PTM;
            $data->fill(Input::all());
            // $data->name = $request->name;
            // $data->detail = $request->detail;
            // $data->price = $request->price;
            if($data->save() ){
                if($request->has('image') ){
                    $data->image = $request->file('image')->store('photos','public');
                    $data->update();
                }
            }
            return redirect()->route('type.index')->with('JsAlert','เพิ่มข้อมูลเสร็จสิ้น');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data =  PTM::findOrFail($id);
        if(is_null($data)){
            return back()->wtih('jsAlert','ไม่พบข้อมูลที่ต้องการแก้ไข');
        }
        return view('form.formType')->with('data',$data);
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
        //
        $data =  PTM::findOrFail($id);
        if(is_null($data)){
            return back()->wtih('jsAlert','ไม่พบข้อมูลที่ต้องการแก้ไข');
        }
        // $check = $request->validate([
        //     'name' => 'required|min:3|max:255',
        //     'detail' => 'required|min:10',
        //     'price' => 'required|numeric|digits_between:1,9'
        // ]);
        $validator = Validator::make($request->all(),$this->cValidator,$this->cValidatorMsg);
        if($validator->fails() ){
            return back()
            ->withInput()
            ->withErrors( $validator->errors());
        }
        if( $validator ){
        $data->name = $request->name;
        $data->update();
            }
        return redirect()->route('type.index')->with('JsAlert','แก้ไขข้อมูลเสร็จสิ้น');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
