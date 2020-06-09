<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public $successStatus = 200;
    /** 
    * login api 
    * 
    * @return \Illuminate\Http\Response 
    */ 
    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if(Auth::attempt($credenciales))
        { 
            $user = Auth::user(); 
            $success['token'] = $user->createToken('MyApp')->accessToken; 
            return response()->json(['success' => $success], $this->successStatus); 
        } 
        else
        {
            return response()->json(['error'=>'Las credenciales son incorrectas.'], 401); 
        } 
    }

    public function logout(){   
        if (Auth::check()) {
            Auth::user()->token()->revoke();
            return response()->json(['success' =>'Has cerrado sesión correctamente'],200); 
        }else{
            return response()->json(['error' =>'Algo ha ido mal, no has podido cerrar sesión'], 500);
        }
    }

    /** 
    * details api 
    * 
    * @return \Illuminate\Http\Response 
    */ 
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    }
}
