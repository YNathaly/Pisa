<?php
namespace App\facturas;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
   protected $table = 'producto';
   protected $fillable = ['id',
   						'no_identificacion',
                     'unidad',
                     'clave_unidad',
                     'clave_prod_ser',
                     'descripcion',
                     'cantidad',
                     'descuento',
                     'importe',
                 	   'valor_unitario', 
                     'estatus','created_at','updated_at'];

}

