<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partido;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    //     $userRole = User::where('user.id', $user_id)
    // ->leftJoin('role', 'user.role', '=', 'role.role_id')
    // ->select(
    //     'user.id',
    //     'role.role_name'
// )
        $partidos = Partido::all();
        // $partidoC = Partido::find(1);
        return view('home', ['partidos' => $partidos]);
    }
}
