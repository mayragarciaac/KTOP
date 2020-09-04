<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App;
use Illuminate\Http\Request;
use App\productos;
use App\category_list;
use App\reservas;
use App\categories;
use Illuminate\Support\Str;
use App\productos_additional_properties;

use App\Mail\MailtrapExample;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $data = array(
            'name'          => $request->input('Nombre'),
            'sku'           => rand(1111111,9999999),
            'brand'         => bin2hex(random_bytes(20)),
            'model'         => $request->input('model'),
            'description'   => $request->input('Description'),
            'stockUnits'    => intval($request->input('stockUnits')),
            'category'      => intval($request->input('categoriaId')) 
        );
        $result = productos::create($data);
        if(!empty($result) && ctype_digit("".$result['id'])){

            $categories = categories::where('father',$request['categoriaId'] )->get();
            if(sizeof($categories)>0){
                foreach ($categories as $key => $value) {
                    if(isset($request['additional_info_'.$value['id']])){
                        $value_Info = $request['additional_info_'.$value['id']];
                        if($value['type'] == 2)
                            $value_Info = 1;
                        productos_additional_properties::create(array(
                            'value'         => $value_Info,
                            'idPropertie'   => $value['id'],
                            'idProducto'    => $result['id']
                        ));
                    }
                }
            }


            return redirect('show_product/'.$result['id']);
        }
            
        
        return redirect('category_list');
        
    }

    public function store_api(Request $request)
    {
        
        $request =  json_decode($request->getContent(), true);
        $request = $request['producto'];
        $request =  json_decode($request, true);
        //return $request;
        $data = array(
            'name'          => $request['name'],
            'sku'           => rand(1111111,9999999),
            'brand'         => bin2hex(random_bytes(20)),
            'model'         => $request['model'],
            'description'   => $request['description'],
            'stockUnits'    => $request['stockUnits'],
            'category'      => $request['categoriaId'] 
        );
        $result = productos::create($data);
        if(!empty($result) && ctype_digit("".$result['id'])){

            $categories = categories::where('father',$request['categoriaId'] )->get();
            if(sizeof($categories)>0){
                foreach ($categories as $key => $value) {
                    if(isset($request['additional_info_'.$value['id']])){
                        $value_Info = $request['additional_info_'.$value['id']];
                        if($value['type'] == 2)
                            $value_Info = 1;
                        productos_additional_properties::create(array(
                            'value'         => $value_Info,
                            'idPropertie'   => $value['id'],
                            'idProducto'    => $result['id']
                        ));
                    }
                }
            }


            return $result['id'];
        }
            
        
        return false;
        
    }

    public function randomId(){

        $id = Str::random(10);
   
        $validator = \Validator::make(['id'=>$id],['id'=>'unique:reservas,idReserva']);
   
        if($validator->fails()){
             return $this->randomId();
        }
   
        return $id;
   }
   

    public function store_reserva(Request $request)
    {
        $data = array(
            'idProducto'    => $request->input('IdProducto'),
            'idReserva'     => $this->randomId(),
            'name'          => $request->input('Nombre'),
            'lastname'      => $request->input('Apellido'),
            'email'         => $request->input('Email')
        );
        $result = reservas::create($data);
        if(!empty($result) && !empty($result['idReserva']))
                return redirect('/resultado_reserva/'.$result['idReserva']);
        
        return redirect('/products/'.$request->input('IdProducto'));
        
    }
    public function show_reserva($id)
    {
        $result = reservas::where('idReserva', $id)->first();
        if(!empty($result) && !empty($result['idReserva'])){
            Mail::to($result['email'])->send(new MailtrapExample()); 
            Mail::to("admind@ktop.com")->send(new MailtrapExample()); 
            return view('resultado_reserva')->with('reserva',json_encode($result));
        }
            

        return redirect('/');
    }

    public function form_data($category)
    {
        $info = category_list::where('id', $category)->first();
        
        if(!empty($info)){
            $Properties = categories::where('father', $category)->get();
            $data = ['category'=>$info,'Properties'=>$Properties];
            return view('createProducts')->with('data',json_encode($data));
        }

        return redirect('category_list');
    }

    public function form_info($category)
    {
        $info = category_list::where('id', $category)->first();
        if(!empty($info)){
            $Properties = categories::where('father', $category)->get();
            $data = ['category'=>$info,'Properties'=>$Properties];
            return $data;
        }
    }

    public function form_data_view($category)
    {
        return view('createProducts2');
    }
    public function product_view($category)
    {
        return view('productoDetails2');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Producto = productos::where('idProducto', $id)->first();

        if(!empty($Producto)){
            $category = category_list::where('id', $Producto['category'])->first();
            $product_data_extended = productos::product_data_extended($id);
            if(!empty($product_data_extended))
                $Producto['product_data_extended'] = $product_data_extended;
            if(!empty($category))
                $Producto['categoryname'] = $category['name'];

            return view('productoDetails')->with('Producto',$Producto);
        }
            

        return redirect('category_list');
    }

    public function show_api($id)
    {
        $Producto = productos::where('idProducto', $id)->first();

        if(!empty($Producto)){
            $category = category_list::where('id', $Producto['category'])->first();
            $product_data_extended = productos::product_data_extended($Producto['category'],$id);
            if(!empty($product_data_extended))
                $Producto['product_data_extended'] = $product_data_extended;
            if(!empty($category))
                $Producto['categoryname'] = $category['name'];

            return $Producto;
        }
    }


    public function front_products($id)
    {
        $Producto = productos::where('idProducto', $id)->first();

        if(!empty($Producto)){
            $category = category_list::where('id', $Producto['category'])->first();
            $product_data_extended = productos::product_data_extended($id);
            
            if(!empty($product_data_extended))
                $Producto['product_data_extended'] = $product_data_extended;
            if(!empty($category))
                $Producto['categoryname'] = $category['name'];

            return view('front_products')->with('Producto',$Producto);
        }
            

        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function booking($id)
    {
        $Producto = productos::where('idProducto', $id)->first();
        return view('front_products_reservar')->with('Producto',$Producto);
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
