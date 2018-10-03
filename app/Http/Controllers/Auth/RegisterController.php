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
use Auth;

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
        $rules = [
                'name' => 'required|string|max:255',
                'business_name' => 'required|string|max:255',
                'password' => 'required|string|min:6|confirmed',
                'gender' => 'required|string|max:255',
                'phone' => 'required|string|max:255',
                'burn_date' => 'required|string|max:255',
                'address' => 'required|string|max:255',   
                'state' => 'required|string|max:255',   
                'city' => 'required|string|max:255',   
                'colonia' => 'required|string|max:255',   
                'postal_code' => 'required|string|max:255',            
                'email' => 'required|string|email|max:255|unique:users',
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
            'state.required' => 'El campo estado es obligatorio',  
            'city.required' => 'El campo ciudad es obligatorio',  
            'colonia.required' => 'El campo colonia es obligatorio',  
            'postal_code.required' => 'El campo código postal es obligatorio',  
            'email.required' => 'El campo email es obligatorio',
            'email.unique' => 'Este e-mail ya ha sido registrado',
            'business_type.required' => 'El campo tipo de negocio es obligatorio',  
            'rfc.required' => 'El campo RFC es obligatorio'
        );

        $validator = Validator::make($request->all(),$rules,$messages);

        if ($validator->fails())
        {
            return redirect('/register')->withErrors($validator)
                        ->withInput();
        }else{

            $user_id = DB::table('users')->insertGetId([
                        'name' => $request['name'],
                        'role_id' => 2,
                        'business_name' => $request['business_name'], 
                        'password' => bcrypt($request['password']),
                        'gender' => $request['gender'],
                        'phone' => $request['phone'],
                        'burn_date' =>  $request['burn_date'],
                        'address' =>  $request['address'],            
                        'state' =>  $request['state'],
                        'city' =>  $request['city'],
                        'colonia' =>  $request['colonia'],
                        'postal' =>  $request['postal_code'],
                        'email' =>  $request['email'],
                        'business_type' => $request['business_type'],  
                        'rfc' =>  $request['rfc'],
                ]); 

              $insert = DB::table('rfc_user')->insertGetId([
                  'user_id' => $user_id,
                  'rfc' => $request['rfc']
                ]);


            //return view('/home')->with('message','Ha sido registrado correctamente');
            return view('Auth/login')->with('message','Ha sido registrado correctamente');


        }
}



}
