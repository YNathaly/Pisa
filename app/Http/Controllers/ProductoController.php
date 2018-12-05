<?php namespace App\Http\Controllers;

use DB;
use App\Quotation;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

use App\Facturas\Facturas;
use App\Facturas\Productos;
use App\User;
use Illuminate\Http\Request;
use Auth;

class ProductoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        if(Auth::user()->id == '1'){
        //Se envian todas las facturas que pertenecen a ese cliente.
            $facturas = Facturas::select('*')->get();
            $productos = Productos::select('*')->where('id','=',$request->id)->get();
            $user = User::select('business_name', 'phone', 'address', 'state', 'city', 'colonia', 'postal', 'email', 'rfc')->where('id', Auth::user()->id)->get();

            return view('producto')->with(['facturas' => $facturas, 'productos' => $productos]);
        }
           
    }
}