<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;

class PdfController extends Controller
{
    public function create($id){
        $maison = DB::table('maison')->where('id', '=', $id)->first(); 

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
            ->join('commerciaux', 'projets.idCommercial', '=', 'commerciaux.id')
            ->where('maison.id','=',$id)
            ->select('maison.*', 'clients.nom as nomClient', 'clients.prenom as prenomClient','commerciaux.nom as nomCommercial', 'commerciaux.prenom as prenomCommercial')
            ->first();

        $composants = DB::table('composants')
            ->join('maison', 'maison.id', '=', 'composants.idMaison')
            ->join('produits', 'produits.id', '=', 'composants.idProduit')
            ->join('familles', 'familles.id', '=', 'composants.idFamille')
            ->where('composants.idMaison','=',$id)
            ->select('composants.quantite as quantite', 'familles.*', 'produits.typeProduit as typeProduit','produits.prix as prix')
            ->get();


        $pdf = PDF::loadView('pdf.pdf', compact('maison','projet','composants','gamme'))->save( 'storage/pdf/'. );
        
        $pdf->setPaper('A4', 'portrait');
        $filename=time().'-maison-'.$maison->id;
        Storage::disk('public')->putFileAs($filename, $pdf->output());
        return $pdf->stream();
    }

	public function show($id)
    {
    	$maison = DB::table('maison')->where('id', '=', $id)->first(); 

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
            ->join('commerciaux', 'projets.idCommercial', '=', 'commerciaux.id')
            ->where('maison.id','=',$id)
            ->select('maison.*', 'clients.nom as nomClient', 'clients.prenom as prenomClient','commerciaux.nom as nomCommercial', 'commerciaux.prenom as prenomCommercial')
            ->first();

        $composants = DB::table('composants')
            ->join('maison', 'maison.id', '=', 'composants.idMaison')
            ->join('produits', 'produits.id', '=', 'composants.idProduit')
            ->join('familles', 'familles.id', '=', 'composants.idFamille')
            ->where('composants.idMaison','=',$id)
            ->select('composants.quantite as quantite', 'familles.*', 'produits.typeProduit as typeProduit','produits.prix as prix')
            ->get();


    	$pdf = PDF::loadView('pdf.pdf', compact('maison','projet','composants','gamme'));

		// (Optional) Setup the paper size and orientation
		$pdf->setPaper('A4', 'portrait');
    	
    	return $pdf->stream();
    }
	
}
