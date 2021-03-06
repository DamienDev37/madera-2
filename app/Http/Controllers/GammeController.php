<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Repositories\GammeRepository;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class GammeController extends Controller
{
    protected $gammeRepository;

    protected $nbrPerPage = 32;

    public function __construct(GammeRepository $gammeRepository)
    {
        $this->middleware('auth');
        $this->gammeRepository = $gammeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gammes = $this->gammeRepository->getPaginate($this->nbrPerPage);
        return view('gamme.index', compact('gammes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fournisseurs = DB::table('fournisseurs')->get();
        return view('gamme.create', compact('fournisseurs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gamme = $this->gammeRepository->store($request->all());

        return redirect('/gamme')->withOk("La gamme a été créer");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gamme = $this->gammeRepository->getById($id);
        return view('gamme.show',  compact('gamme'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gamme = $this->gammeRepository->getById($id);
        $fournisseurs = DB::table('fournisseurs')->get();
        return view('gamme.edit',  compact('gamme','fournisseurs'));
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
        $this->gammeRepository->update($id, $request->all());
        
        return redirect('gamme');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->gammeRepository->destroy($id);

        return redirect()->back();
    }
}
