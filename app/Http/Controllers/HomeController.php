<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mesa;
use App\Entradas;
use Carbon\Carbon;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $mesa=Mesa::join('users','mesa.idusuario','users.id')->select('users.name as username','mesa.name','mesa.description','mesa.status','mesa.updated_at','mesa.created_at','mesa.id')->get();
        $produtos=Entradas::join('produtos','produtos_entradas.produto_id','produtos.id')
                            ->select('produtos_entradas.*','produtos.name')
                            ->where('produtos_entradas.status','!=','0')
                            ->get();

        return view('home',compact('mesa','produtos'));
    }
}
