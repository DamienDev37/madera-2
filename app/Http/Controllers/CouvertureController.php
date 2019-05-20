<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Repositories\CouvertureRepository;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class couvertureController extends Controller
{
    protected $couvertureRepository;

    protected $nbrPerPage = 32;

    public function __construct(CouvertureRepository $couvertureRepository)
    {
        $this->middleware('auth');
        $this->CouvertureRepository = $couvertureRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $couvertures = DB::table('couvertures')->get();
        return view('couverture.index', compact('couvertures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fournisseurs = DB::table('fournisseurs')->get();
        return view('couverture.create', compact('fournisseurs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $couverture = $this->CouvertureRepository->store($request->all());

        return redirect('/couverture')->withOk("La couverture a été créer");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $couverture = $this->CouvertureRepository->getById($id);
        return view('couverture.show',  compact('couverture'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $couverture = $this->CouvertureRepository->getById($id);
        $fournisseurs = DB::table('fournisseurs')->get();
        return view('couverture.edit',  compact('couverture','fournisseurs'));
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
        $this->CouvertureRepository->update($id, $request->all());
        
        return redirect('couverture');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->CouvertureRepository->destroy($id);

        return redirect()->back();
    }
}
