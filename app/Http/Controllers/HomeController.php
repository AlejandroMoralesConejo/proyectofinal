<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partido;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // This code redirect to login when you enter home url
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $partidos = Partido::orderBy('fecha')->orderBy('hora')->paginate(20);
        return view('home')->with('partidos', $partidos);
    }

    public function perfil()
    {
        // $user = auth()->user();
        return view('profile');
    }

    public function store(Request $request)
    {
        $user = User::find($request->input('idJug'));
        $request->validate([
                'idJug' => 'required',
                'nombreJ' => 'required',
                'email' => 'unique:users,email,'.$user->idJug.',idJug',
                'posicion' => 'required'
            ], [
                'nombreJ.required' => 'Debes introducir un nombre',
                'email.required' => 'El email introducido es incorrecto o está en uso',
                'posicion.required' => 'Debes introducir una posición de juego'
            ]);
   
        $input = $request->all();
        
        $user->nombreJ = $input['nombreJ'];
        $user->email = $input['email'];
        if (isset($input['fec_nacimiento']))
            $user->fec_nacimiento = $input['fec_nacimiento'];
        $user->posicion = $input['posicion'];

        $user->save();
        
        return back()->with('success', 'Usuario actualizado correctamente.');
    }

    public function delete(Request $request)
    {
        User::destroy($request->input('idJugador'));
        return redirect()->route('home');
    }

    public function foto(Request $request)
    {
        $request->validate([
            'foto' => 'image|required|dimensions:min:width:200',
        ]);

        $request->file('foto')->store('public');
        $nombreArchivo = $request->file('foto')->hashName();

        $usuario = User::find($request->input('idJug'));
        $usuario->foto = 'storage/'.$nombreArchivo;
        $usuario->save();

        return back()->with('foto', 'Se ha actualizado la foto de perfil.');
    }

    public function faq()
    {
        return view('faq');
    }
}
