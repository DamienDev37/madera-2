<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;

class PdfController extends Controller
{
    public function create($id){
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
        return PDF::loadView('pdf.pdf', compact('maison','projet','composants','gamme'))->stream();
    }

    public function show($id)
    {
        $devis = DB::table('devis')
        ->where('devis.id', '=', $id)
        ->first();
        
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
                $pdf = PDF::loadView('pdf.pdf', compact('devis','maison','projet','composants','gamme','remise'));
            }else{
                $pdf = PDF::loadView('pdf.pdf', compact('devis','maison','projet','composants','gamme'));
            }
        
        

        // (Optional) Setup the paper size and orientation
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->stream();
    }
    public function edit($id)
    {
        $devis = DB::table('devis')
        ->where('devis.id', '=', $id)
        ->first();
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
        $pdf = PDF::loadView('pdf.view', compact('devis','maison','projet','composants','gamme'));

        // (Optional) Setup the paper size and orientation
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->stream();
    }
    
}
