<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Repositories\ClientRepository;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $clientRepository;

    protected $nbrPerPage = 32;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->middleware('auth');
        $this->clientRepository = $clientRepository;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->isAdmin==1){
            $clients = DB::table('clients')->get();
        }else{
            $clients = DB::table('clients')->where('idCommercial', '=', Auth::user()->id)->get();
        }
        return view('client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = $this->clientRepository->store($request->all());

        return redirect('/client')->withOk("L'utilisateur " . $client->nom . ' ' .$client->prenom. " a été créé.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = $this->clientRepository->getById($id);
        return view('client.show',  compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = $this->clientRepository->getById($id);
        return view('client.edit',  compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->clientRepository->update($id, $request->all());
        
        return redirect('client');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->clientRepository->destroy($id);

        return redirect()->back();
    }
}
