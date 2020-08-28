<?php
use Illuminate\Database\Seeder;
use App\category_list;
use App\categories;
use App\productos;
use App\productos_additional_properties;

class productosTableSeeder extends Seeder
{

    public function run()
    {
        $category_list = category_list::all();
        if (count($category_list) > 0){
            $Example = array('1'=> "texto", 2=> true);

            DB::table('productos')->delete();
            foreach($category_list as $category){
                $Producto = productos::create(array(
                    'name'     => "Producto ".rand(1,100),
                    'sku'     => rand(1111111,9999999),
                    'brand'     => bin2hex(random_bytes(20)),
                    'model'     => "Model",
                    'description'     => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                    'stockUnits'     => rand(50,100),
                    'category' => $category['id'] 
                ));
                if(!empty($Producto)){
                    $categories = categories::where('father',$category['id'] )->get();
                    if(sizeof($categories)>0){
                        foreach ($categories as $key => $value) {
                            productos_additional_properties::create(array(
                                'value'     => $Example[$value['type']],
                                'idPropertie'     => $value['id'],
                                'idProducto'     => $Producto['id']
                            ));
                        }
                    }
                }
            }
        }
        

    }

}

