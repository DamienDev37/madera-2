<?php 

namespace App\Http\Controllers;

use App\Repositories\MaisonRepository;
use App\Repositories\ComposantRepository;
use DB;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class MaisonController extends Controller
{

    protected $maisonRepository;
    protected $composantRepository;

    protected $nbrPerPage = 32;

    public function __construct(MaisonRepository $maisonRepository,ComposantRepository $composantRepository)
    {
        $this->maisonRepository = $maisonRepository;
        $this->composantRepository = $composantRepository;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gammes = DB::table('gammes')->get();
        return view('maison.create', compact('gammes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $maison = $this->maisonRepository->store($request->all());

        return redirect('/maison/'.$maison->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gammes = DB::table('gammes')->get();
        $finitions = DB::table('finitions')->get();
        $couvertures = DB::table('couvertures')->get();
        $isolants = DB::table('isolants')->get();
        $parepluies = DB::table('parepluies')->get();
        $produits = DB::table('produits')->get();
        $maison = $this->maisonRepository->getById($id);
        $gamme = DB::table('gammes')->where('id', '=', $maison->idGamme)->first();
        return view('maison.show',  compact('maison','gammes','finitions','couvertures','isolants','parepluies','gamme','produits'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $maison = $this->maisonRepository->getById($id);
        return view('maison.edit',  compact('maison'));
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
        
        foreach($request['idProduit'] as $k => $v){

            if(!empty($request['idProduit'][$k]) && isset($request['idProduit'][$k]) && intval($request['quantite'][$k])>0){

                $arr = [
                    'idMaison' => $request['idMaison'][$k],
                    'idProduit' => $request['idProduit'][$k],
                    'quantite' => $request['quantite'][$k],
                    'idFamille' => $request['idFamille'][$k],
                ];
                $product = DB::table('composants')
                ->where('idMaison', '=', intval($request['idMaison'][$k]))
                ->where('idProduit', '=', intval($request['idProduit'][$k]))
                ->where('idFamille', '=', intval($request['idFamille'][$k]))
                ->first();
                if(!isset($product)){
                    $this->composantRepository->store($arr);
                }else{
                    $this->composantRepository->destroy($product->id);
                    $this->composantRepository->store($arr);
                }
                
            }
            
        }
        $maison = DB::table('maison')
                ->where('id', '=', $request['idMaison'][0])
                ->first();
        return redirect('/projet/'.$maison->idProjet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->maisonRepository->destroy($id);
        return redirect()->back();
    }

    public function planCoupe(){
        return view('plancoupe');
    }
}
