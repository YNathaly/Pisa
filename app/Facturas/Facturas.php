<?php
namespace App\facturas;

use Illuminate\Database\Eloquent\Model;

class Facturas extends Model
{
   protected $table = 'facturas';
   protected $fillable = ['id','folio',
                        'subtotal',
                        'total',
                        'descuento',
                        'moneda',
                        'metodo_pago',
                        'lugar_expedicion',
                        'fecha'];

}