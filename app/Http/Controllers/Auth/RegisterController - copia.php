<?php namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Response;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

   /*public function register(Request $request) {


        $count_rfc = User::select('id','rfc')->where('email', $request['email'])->get()->toArray();
        $count = count($count_rfc);

// echo '<pre>'; var_dump($request->all());exit();echo '</pre>';


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

if($count < 3){
            return Validator::make($request, $rules);
}else{
        return redirect('/register')->with(['message' => 'limite de RFC registrados']);

}
    }*/


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
     protected function validator(array $data)
    {

        $count_rfc = User::select('id','rfc')->where('email', $data['email'])->get()->toArray();
        $count = count($count_rfc);

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

            if($count < 3){
                return Validator::make($data, $rules);
            }else{
            // echo '<pre>'; //var_dump( $count );exit(); 
                /*var_dump( response()->json(array(
                    'success'=>false,
                    'errors'=>'limite de RFC registrados'
                ))  );*/

                 return redirect('/register')->with('message', 'limite de RFC registrados');
 return view('register')->with(['rfc' => 'limite de RFC registrados']);


              //  echo '</pre>';
                //return response()->json([ 'rfc' => 'limite de RFC registrados' ]);
            }
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {   
           return User::create([
                    'name' => $data['name'],
                    'role_id' => 2,
                    'business_name' => $data['business_name'], 
                    'password' => bcrypt($data['password']),
                    'gender' => $data['gender'],
                    'phone' => $data['phone'],
                    'burn_date' =>  $data['burn_date'],
                    'address' =>  $data['address'],            
                    'email' =>  $data['email'],
                    'business_type' => $data['business_type'],  
                    'rfc' =>  $data['rfc'],
            ]); 
        // echo '<pre>'; var_dump( $count );exit(); echo '</pre>';
      
    }

}
