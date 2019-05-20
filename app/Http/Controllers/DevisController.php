<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use PDF;
use App\Devis;
use App\Repositories\MaisonRepository;
use App\Repositories\DevisRepository;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Http\Request;

class DevisController extends Controller
{
    protected $devisRepository;
    protected $maisonRepository;

    protected $nbrPerPage = 32;

    public function __construct(DevisRepository $devisRepository,MaisonRepository $maisonRepository)
    {
        $this->devisRepository = $devisRepository;
        $this->maisonRepository = $maisonRepository;
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
            $devis = DB::table('devis')->get();
        }else{
            $devis = DB::table('devis')->where('idCommercial', '=', Auth::user()->id)->get();
        }
        
        return view('devis.index', compact('devis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $commerciaux = DB::table('commerciaux')->get();
        $clients = DB::table('clients')->get();
        return view('projet.create', compact('commerciaux', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $maison = DB::table('maison')->where('id', '=', $request->request->get('idMaison'))->first(); 

        $gamme = DB::table('gammes')
            ->join('isolants', 'isolants.id', '=', 'gammes.idIsolant')
            ->join('finitions', 'finitions.id', '=', 'gammes.idFinition')
            ->join('parepluies', 'parepluies.id', '=', 'gammes.idParepluie')
            ->join('couvertures', 'couvertures.id', '=', 'gammes.idCouverture')
            ->where('gammes.id','=',$maison->idGamme)
            ->select('gammes.nom as nomGamme', 
                'isolants.nom as nomIsolant','isolants.prix as prixIsolant', 
                'finitions.nom as nomFinition','finitions.prix as prixFinition',
                'parepluies.nom as nomParepluie','parepluies.prix as prixParepluie',
                'couvertures.nom as nomCouverture','couvertures.prix as prixCouverture')
            ->first();
        $projet = DB::table('projets')
            ->join('maison', 'maison.idProjet', '=', 'projets.id')
            ->join('clients', 'clients.id', '=', 'projets.idClient')
            ->join('users', 'projets.idCommercial', '=', 'users.id')
            ->where('maison.id','=',$maison->id)
            ->select('maison.*', 'clients.nom as nomClient', 'clients.prenom as prenomClient','users.lastname as nomCommercial', 'users.name as prenomCommercial')
            ->first();
        $composants = DB::table('composants')
            ->join('maison', 'maison.id', '=', 'composants.idMaison')
            ->join('produits', 'produits.id', '=', 'composants.idProduit')
            ->join('familles', 'familles.id', '=', 'composants.idFamille')
            ->where('composants.idMaison','=',$maison->id)
            ->select('composants.quantite as quantite', 'familles.*', 'produits.typeProduit as typeProduit','produits.prix as prix')
            ->get();
        $devis = DB::table('devis')
            ->where('devis.idCommercial','=',$request->request->get('idCommercial'))
            ->get();
        $htprice=0;
            
        $perimetre = ($maison->longueur + $maison->largeur) * 2;
        $aire = $maison->longueur * $maison->largeur;
        $surfaceMur = $perimetre * $maison->hauteur;
        $prixTotalIsolant = $gamme->prixIsolant * $surfaceMur;
        $prixTotalFinition = $gamme->prixFinition * $surfaceMur;
        $prixTotalParepluie = $gamme->prixParepluie * $surfaceMur;
        
        $prixTotalCouverture = $gamme->prixCouverture * $surfaceMur;
        
        $htprice+=$prixTotalIsolant+$prixTotalFinition+$prixTotalParepluie;
        foreach ($composants as $k => $v) {
            $htprice+=($v->prix * $v->quantite);
        }

        $numDevis=count($devis)+1;
        $data = new Devis;
        $data->idClient = $request->request->get('idClient');
        $data->idCommercial = $request->request->get('idCommercial');
        $data->idMaison = $request->request->get('idMaison');
        
        $data->total = $htprice;
        $data->numeroDevis = $numDevis;

        $data->idRemise = 0;
        $data->isValidated = 0;
        $data->isOut = 0;
        $data->pdfurl = '';
        if(!$devis = DB::table('devis')
            ->where('devis.idMaison','=',$request->request->get('idMaison'))
            ->first()){
            $data->idEtat = $request->request->get('idEtat');
            $data->save();
        }else{
            $devis = DB::table('devis')
            ->where('devis.idMaison','=',$request->request->get('idMaison'))
            ->first();
            $data->id=$devis->id;
            $data->idEtat = $devis->idEtat;
            $data->update();
        }
        $devis = DB::table('devis')->where('idCommercial', '=', Auth::id())->first(); 
        return view('devis.edit',compact('devis','maison','projet','composants','gamme'));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id=$id;
        $maisons = DB::table('maison')->where('idProjet', '=', $id)->get();
        return view('projet.show',compact('maisons','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $devis = DB::table('devis')->where('id', '=', $id)->first(); 
        $maison = DB::table('maison')->where('id', '=', $devis->idMaison)->first(); 

        $gamme = DB::table('gammes')
            ->join('isolants', 'isolants.id', '=', 'gammes.idIsolant')
            ->join('finitions', 'finitions.id', '=', 'gammes.idFinition')
            ->join('parepluies', 'parepluies.id', '=', 'gammes.idParepluie')
            ->join('couvertures', 'couvertures.id', '=', 'gammes.idCouverture')
            ->where('gammes.id','=',$maison->idGamme)
            ->select('gammes.nom as nomGamme', 
                'isolants.nom as nomIsolant','isolants.prix as prixIsolant', 
                'finitions.nom as nomFinition','finitions.prix as prixFinition',
                'parepluies.nom as nomParepluie','parepluies.prix as prixParepluie',
                'couvertures.nom as nomCouverture','couvertures.prix as prixCouverture')
            ->first();

        $projet = DB::table('projets')
            ->join('maison', 'maison.idProjet', '=', 'projets.id')
            ->join('clients', 'clients.id', '=', 'projets.idClient')
            ->join('users', 'projets.idCommercial', '=', 'users.id')
            ->where('maison.id','=',$maison->id)
            ->select('maison.*', 'clients.nom as nomClient', 'clients.prenom as prenomClient','users.lastname as nomCommercial', 'users.name as prenomCommercial')
            ->first();

        $composants = DB::table('composants')
            ->join('maison', 'maison.id', '=', 'composants.idMaison')
            ->join('produits', 'produits.id', '=', 'composants.idProduit')
            ->join('familles', 'familles.id', '=', 'composants.idFamille')
            ->where('composants.idMaison','=',$maison->id)
            ->select('composants.quantite as quantite', 'familles.*', 'produits.typeProduit as typeProduit','produits.prix as prix')
            ->get();
        if($devis->idRemise!=0){
                $remise = DB::table('remises')
                ->where('remises.id', '=', $devis->idRemise)
                ->first();
                return view('devis.edit', compact('devis','maison','projet','composants','gamme','remise'));
            }else{
                return view('devis.edit', compact('devis','maison','projet','composants','gamme'));
            }
        
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
        $this->devisRepository->update($id, $request->all());
        
        return redirect('devis');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->devisRepository->destroy($id);

        return redirect()->back();
    }
}
