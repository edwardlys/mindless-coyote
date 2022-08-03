<?php
   
namespace App\Http\Controllers\Api;
   
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
   
class UserController extends Controller
{
    const RESPONSE_FETCH_USER_SUCCESS = 'FETCH_USER_SUCCESS';

    /**
     * Fetches the user information.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetch(Request $request)
    {
        $user = User::find(Auth::user()->id);
        
        return $this->respondWith(['user' => $user], self::RESPONSE_FETCH_USER_SUCCESS);
    }
}