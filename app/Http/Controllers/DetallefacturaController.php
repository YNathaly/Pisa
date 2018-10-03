<?php namespace App\Http\Controllers;

use DB;
use App\Quotation;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Facturas\Facturas;
use App\Facturas\Productos;
use App\User;
use Illuminate\Http\Request; 
use Auth;

class DetallefacturaController extends Controller
{
    /**s
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $facturas = Facturas::select('*')->where('id', 1)->get()->toArray();
        $productos = Productos::select('*')->where('id_factura', 1)->get()->toArray();

//var_dump($facturas[0]["id"]);exit();
        return view('factura_info')->with([ 'facturas' => $facturas, 'productos' => $productos  ]);

    }

}