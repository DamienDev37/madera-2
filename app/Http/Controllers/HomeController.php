<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Http\Request;

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
    public function index(){
        if(Auth::user()->isAdmin==1){
            $devis = DB::table('devis')->get();
            $users = DB::table('users')->get();
            $clients = DB::table('clients')->get();
            $projets = DB::table('projets')->get();
            return view('home', compact('devis', 'users','projets','clients'));
        }else{
            $devis = DB::table('devis')->where('idCommercial', '=', Auth::user()->id)->get();
            $clients = DB::table('clients')->where('idCommercial', '=', Auth::user()->id)->get();
            $projets = DB::table('projets')->where('idCommercial', '=', Auth::user()->id)->get();
            return view('home', compact('devis','projets','clients'));
        }
        
    }
}
