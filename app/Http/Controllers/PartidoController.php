<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partido;

class PartidoController extends Controller
{
    public function __construct()
    {
        // This code redirect to login when you enter home url
        // $this->middleware('auth');
    }

    /**
     * Show a specific match
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showMatch($idPartido)
    {
        $partido = Partido::find($idPartido);
        $jugadores = $partido->users;
        $logueadoPertenece = false;
        foreach ($jugadores as $jugador)
        {
            if ($jugador->idJug == auth()->user()->idJug)
            {
                $logueadoPertenece = true;
            }
        }
        $numJugadores = count($partido->users);
        return view('partido', ['partido' => $partido, 'jugadores' => $jugadores, 'numJugadores' => $numJugadores, 'logueadoPertenece' => $logueadoPertenece]);
    }

    /**
     * Sign in a match
     */

    public function signInMatch(Request $req)
    {
        // Take params from the view (idPartido - idJugador)
        $idPartido = $req->input('idPartido');
        $idJug = $req->input('idJugador');
        
        // Find the current match
        $partido = Partido::find($idPartido);

        //Save a player in a match
        $partido->users()->attach($idJug);

        $partido->limite++;
        $partido->save();
    	
    	// redirect to the match view
    	return redirect()->route('partido.mostrar', ['idPartido' => $idPartido]) ;
    }

    /**
     * Leave a match
     */

    public function leave(Request $request)
    {
        $idPartido = $request->input('idPartido');
        $partido = Partido::find($idPartido);
        $partido->users()->detach($request->input('idJugador'));

        $partido->limite--;
        $partido->save();

        return redirect()->route('partido.mostrar', ['idPartido' => $idPartido]) ;
    }
}
