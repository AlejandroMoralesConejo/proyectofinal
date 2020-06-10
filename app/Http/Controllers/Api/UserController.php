<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Pista;
use App\Partido;

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

    /** 
    * logout api 
    * 
    * @return \Illuminate\Http\Response 
    */ 
    public function logout(Request $request){   
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
    public function userDetails() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    }

    /** 
    * find a court api 
    * 
    * @return \Illuminate\Http\Response 
    */ 
    public function findPista(Request $request)
    {
        // $idPista = $request->input('idPista');
        // $pista2 = Pista::find(3);
        $idPista = $request->validate([
            'idPista' => 'required|integer'
            ]);
        if (Pista::find($idPista))
        {
            return response()->json(['success' => Pista::find($idPista)],200);
        }
        else
        {
            return response()->json(['error' =>'No se ha encontrado la pista'], 404);
        }
        
    }

    /** 
    * all courts
    * 
    * @return \Illuminate\Http\Response 
    */ 
    public function pistas()
    {
        $pistas = Pista::all();
        return response()->json(['success' => $pistas], $this-> successStatus); 
    }

    /** 
    * find a match 
    * 
    * @return \Illuminate\Http\Response 
    */ 
    public function findPartido(Request $request)
    {
        $idPartido = $request->validate([
            'idPartido' => 'required',
        ]);
        $partido = Partido::find($idPartido);
        if ($partido)
            return response()->json(['success' => $partido],200);

        return response()->json(['error' =>'No se ha encontrado el partido'], 404);
    }

    /** 
    * all matches
    * 
    * @return \Illuminate\Http\Response 
    */ 
    public function partidos()
    {
        $partidos = Partido::all();
        return response()->json(['success' => $partidos],200);
    }
}
