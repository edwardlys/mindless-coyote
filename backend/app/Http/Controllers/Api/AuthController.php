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
    const RESPONSE_LOGIN_FAILED_NO_MATCH = 'LOGIN_FAILED_NO_MATCH';
    const RESPONSE_LOGIN_FAILED_MALFORMED = 'LOGIN_FAILED_MALFORMED';

    const RESPONSE_LOGOUT_SUCCESS = 'LOGOUT_SUCCESS';

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
        $input = $request->only('email', 'password');

        if (empty($input['email']) || empty($input['password'])) {
            return $this->respondWith([], self::RESPONSE_LOGIN_FAILED_MALFORMED);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            return $this->respondWith([], self::RESPONSE_LOGIN_SUCCESS);
        } else { 
            return $this->respondWith([], self::RESPONSE_LOGIN_FAILED_NO_MATCH);
        } 
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return $this->respondWith([], self::RESPONSE_LOGOUT_SUCCESS);
    }
}