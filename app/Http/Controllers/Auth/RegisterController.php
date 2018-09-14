<?php 

namespace App\Http\Controllers\Auth;

use DB;
use App\Quotation;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    use RegistersUsers;
    protected $redirectTo = '/home';
    public function __construct()
    {
        $this->middleware('guest');
    }

    /*public function index()
    {
        return view('/register');//->with([ 'facturas' => $facturas ]);
    }*/

    public function register(Request $request)
    {
        //echo '<pre>'; var_dump( $request->all() );exit(); echo '</pre>';
        $rules = [
                'name' => 'required|string|max:255',
                'business_name' => 'required|string|max:255',
                'password' => 'required|string|min:6|confirmed',
                'gender' => 'required|string|max:255',
                'phone' => 'required|string|max:255',
                'burn_date' => 'required|string|max:255',
                'address' => 'required|string|max:255',            
                'email' => 'required|string|email|max:255',
                'business_type' => 'required|string|max:255',  
                'rfc' => 'required|string|max:255|unique:users'
                //'email' => 'required|string|email|max:255|unique:users',
        ];

        $messages = array (
            'name.required' => 'El campo descripcion es obligatorio',
            'business_name.required' => 'El campo descripcion es obligatorio',
            'password.required' => 'El campo descripcion es obligatorio',
            'gender.required' => 'El campo descripcion es obligatorio',
            'phone.required' => 'El campo descripcion es obligatorio',
            'burn_date.required' => 'El campo fecha de nacimiento es obligatorio',
            'address.required' => 'El campo dirección es obligatorio',            
            'email.required' => 'El campo email es obligatorio',
            'business_type.required' => 'El campo tipo de negocio es obligatorio',  
            'rfc.required' => 'El campo RFC es obligatorio'
        );

        $validator = Validator::make($request->all(),$rules,$messages);

        if ($validator->fails())
        {
            return redirect('/register')->withErrors($validator)
                        ->withInput();
        }else{
            $count_rfc = User::select('id','rfc')->where('email', $request['email'])->get()->toArray();
            $count = count($count_rfc);
          // echo '<pre>'; var_dump($count_rfc);exit(); echo '</pre>';
            if($count < 3){

             User::create([
                        'name' => $request['name'],
                        'role_id' => 2,
                        'business_name' => $request['business_name'], 
                        'password' => bcrypt($request['password']),
                        'gender' => $request['gender'],
                        'phone' => $request['phone'],
                        'burn_date' =>  $request['burn_date'],
                        'address' =>  $request['address'],            
                        'email' =>  $request['email'],
                        'business_type' => $request['business_type'],  
                        'rfc' =>  $request['rfc'],
                ]); 
            //return view('/home');
            return view('Auth/login')->with('message','Ha sido registrado correctamente');

            }else{
                //var_dump($request['email'] .' ya ha sido registrado 3 veces');exit();
                return view('Auth/register')->with('message', $request['email'] .' ya ha sido registrado 3 veces');
            }

            return redirect('/home');

        }
}



/* 
if($count < 3){
    return Validator::make($data, $rules);
}else{
// echo '<pre>'; //var_dump( $count );exit(); 
    /*var_dump( response()->json(array(
        'success'=>false,
        'errors'=>'limite de RFC registrados'
    ))  );

     return redirect('/register')->with('message', 'limite de RFC registrados');

  //  echo '</pre>';
    //return response()->json([ 'rfc' => 'limite de RFC registrados' ]);
}
}
// echo '<pre>'; var_dump( $count );exit(); echo '</pre>';

}*/

}