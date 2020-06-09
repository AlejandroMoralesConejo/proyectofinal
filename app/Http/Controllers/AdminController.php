<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partido;
use App\Pista;

class AdminController extends Controller
{
    /**
     * Return all matches
     */
    public function index()
    {
        $partidos = Partido::orderBy('fecha')->orderBy('hora')->paginate(20);
        $pistas = Pista::all();
        return view('admin', ['partidos' => $partidos, 'pistas' => $pistas]);
    }

    /**
     * Add a match
     */
    public function add(Request $request)
    {
        $partido = new Partido();
        $partido->nombre = $request->nombre;
        $partido->idPista = $request->idPista;
        $partido->fecha = $request->fecha;
        $partido->hora = $request->hora;

        $partido->save();

        return $partido;
    }

    /**
     * Return info from a match we require to update
     */
    public function find(Request $request)
    {
        return Partido::findOrFail($request->idPartido);
    }

    /**
     * Update match
     */
    public function update(Request $request)
    {
        $partido = Partido::findOrFail($request->idPartido);

        $partido->nombre = $request->nombre;
        $partido->idPista = $request->idPista;
        $partido->fecha = $request->fecha;
        $partido->hora = $request->hora;

        $partido->save();

        return $partido;  
    }

    /**
     * Delete a match passing his ID
     */
    public function delete(Request $request)
    {
        return Partido::destroy($request->idPartido);
    }
}
