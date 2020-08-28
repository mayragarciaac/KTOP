<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reservas extends Model
{
    public $timestamps = false;
    protected $fillable = ['idReserva','idProducto','name','email','lastname'];
}
