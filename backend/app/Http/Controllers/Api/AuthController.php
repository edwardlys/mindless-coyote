<?php
   
namespace App\Http\Controllers\Api;
   
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
   
class AuthController extends Controller
{
    const RESPONSE_REGISTER_VALIDATION_ERR = 'REGISTER_VALIDATION_ERR';
    const RESPONSE_REGISTER_SUCCESS = 'REGISTER_SUCCESS';
    const RESPONSE_LOGIN_SUCCESS = 'LOGIN_SUCCESS';
    const RESPONSE_LOGIN_FAILED = 'LOGIN_FAILED';

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $input = $request->only('name', 'email', 'password', 'confirmPassword');

        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirmPassword' => 'required|same:password',
        ]);
   
        if ($validator->fails()) {
            return $this->respondWith(['errors' => $validator->errors()->toArray()], self::RESPONSE_REGISTER_VALIDATION_ERR);
        }
   
        $newUser = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
        ]);
        
        return $this->respondWith(['details' => $newUser], self::RESPONSE_REGISTER_SUCCESS);
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 

            return $this->respondWith([], self::RESPONSE_LOGIN_SUCCESS);
        } else { 
            return $this->respondWith([], self::RESPONSE_LOGIN_FAILED);
        } 
    }
}