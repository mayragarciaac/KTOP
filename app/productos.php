<?php

namespace App;
Use DB;

use Illuminate\Database\Eloquent\Model;

class productos extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','sku','brand','model','description','stockUnits','category'];

    public static function product_data_extended($IdCaterogy)
    {

        $result = DB::select('  SELECT ap.*, c.name, c.type
                                FROM productos p, productos_additional_properties ap, categories c
                                WHERE ap.idProducto = p.idProducto AND c.id = ap.idPropertie');

        $List_propoerties_products = [];
        for ($i=0; $i < sizeof($result); $i++) { 
           $value = $result[$i];
            $List_propoerties_products[$value->idProducto][] = $value;
        }

        return json_encode($List_propoerties_products);
    }
}
