<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productos_additional_properties extends Model
{
    public $timestamps = false;
    protected $fillable = ['value','idProducto','idPropertie'];
}
