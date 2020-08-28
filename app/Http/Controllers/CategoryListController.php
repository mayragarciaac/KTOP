<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category_list;
use App\categories;
use App\productos;

class CategoryListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = category_list::all();
        return view('admin_index')->with('category_list',$category);
    }
    public function front_users()
    {
        $category = category_list::all();
        return view('front_users')->with('category_list',$category);
    }

    public function front_users_category_products($IdCategoria)
    {
        $products = productos::where('category', $IdCategoria)->get();
        return view('front_users_category_products')->with('products',$products);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $category = category_list::where('id', $id)->first();
        
        if(!empty($category)){
            $Properties = categories::where('father', $id)->get();
            $products = productos::where('category', $id)->get();

            $data = [
                'category_list' => $category,
                'properties' => $Properties,
                'products' => $products
            ];
            return view('category_info')->with($data);
        }
            
        
        return redirect('category_list');
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

    public function show_simple($id)
    {
        $category = category_list::where('id', $id)->first();
        if(!empty($category))
            return $category;
        return false;
    }
}
