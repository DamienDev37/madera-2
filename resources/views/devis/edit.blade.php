@extends('layout')

@section('title')
    Produit
@endsection

@section('content')
<div class="col-md-12">
    <table class="table" style="width:100%;">
            <tr>
                <td style="vertical-align: top;">
                    <img src="<?=url('img/logo.png');?>" style="width:120pt; max-width:300px;">
                </td>
            </tr>
            <tr>
                <td style="text-align: right;" align="right">
                    Créé le : <?=date('d M Y',$maison->timestamp);?><br/>
                </td>
            </tr>
            <tr>
                <td style="text-align: right;" align="right">
                    Client : <?=$projet->nomClient.' '.$projet->prenomClient;?><br/>
                </td>
            </tr>
            <tr>
                <td style="text-align: right;" align="right">
                    Commercial : <?=$projet->nomCommercial.' '.$projet->prenomCommercial;?>
                </td>
            </tr>
        </table>
        <?php 
            $htprice=0;
            
            $perimetre = ($maison->longueur + $maison->largeur) * 2;
            $aire = $maison->longueur * $maison->largeur;
            $surfaceMur = $perimetre * $maison->hauteur;
            $prixTotalIsolant = $gamme->prixIsolant * $surfaceMur;
            $prixTotalFinition = $gamme->prixFinition * $surfaceMur;
            $prixTotalParepluie = $gamme->prixParepluie * $surfaceMur;
            
            $prixTotalCouverture = $gamme->prixCouverture * $surfaceMur;
            
            $htprice+=$prixTotalIsolant+$prixTotalFinition+$prixTotalParepluie;
            ?>
        <h3>La maison</h3>
        <table class="table" style="border: 1px solid grey;width: 100%;margin: 0 auto 20pt auto;">
            <tr style="border-bottom: 1px solid grey;background: #e2e2e2;">
                <th style="text-align: center;">Nombre d'étage</th>
                <th style="text-align: center;">Longueur</th>
                <th style="text-align: center;">Largeur</th>
                <th style="text-align: center;">Hauteur</th>
                <th style="text-align: center;">Hauteur du toit</th>
            </tr>
            <tr>
                <td style="text-align: center;"><?=$maison->nbetages;?></td>
                <td style="text-align: center;"><?=$maison->longueur;?> m</td>
                <td style="text-align: center;"><?=$maison->largeur;?> m</td>
                <td style="text-align: center;"><?=$maison->hauteur;?> m</td>
                <td style="text-align: center;"><?=$maison->hauteurToit;?> m</td>
            </tr>
        </table>
        <h3>Composition murs extérieurs</h3>
        <h4>Nom de la gamme : <?=$gamme->nomGamme;?></h4>
        <table class="table" style="border: 1px solid grey;width: 100%;margin: 0 auto 20pt auto;">
            <tr style="border-bottom: 1px solid grey;background: #e2e2e2;">
                <th>Type</th>
                <th>Libellé</th>
                <th style="text-align: center;">P.U.</th>
                <th style="text-align: center;">Montant</th>
            </tr>
            <tr>
                <td>Isolant</td>
                <td><?=$gamme->nomIsolant;?></td>
                <td style="text-align: center;"><?=$gamme->prixIsolant;?> €</td>
                <td style="text-align: center;"><?=$prixTotalIsolant;?> €</td>
            </tr>
            <tr>
                <td>Finition</td>
                <td><?=$gamme->nomFinition;?></td>
                <td style="text-align: center;"><?=$gamme->prixFinition;?> €</td>
                <td style="text-align: center;"><?=$prixTotalFinition;?> €</td>
            </tr>
            <tr>
                <td>Parepluie</td>
                <td><?=$gamme->nomParepluie;?></td>
                <td style="text-align: center;"><?=$gamme->prixParepluie;?> €</td>
                <td style="text-align: center;"><?=$prixTotalParepluie;?> €</td>
            </tr>
        </table>
        <h3>Les composants</h3>
        <table class="table"  style="border: 1px solid grey;width: 100%;">
            <tr style="border-bottom: 1px solid grey;background: #e2e2e2;">
                <th>Libellé</th>
                <th style="text-align: center;">Quantité</th>
                <th style="text-align: center;">Unité</th>
                <th style="text-align: center;">P.U.</th>
            </tr>
            <?php  
                foreach ($composants as $k => $v) {
                  $htprice+=($v->prix * $v->quantite);
                  ?>
            <tr>
                <td><?=$v->typeProduit;?></td>
                <td style="text-align: center;"><?=$v->quantite;?></td>
                <td style="text-align: center;"><?=$v->unite;?></td>
                <td style="text-align: center;"><?=$v->prix;?></td>
            </tr>
            <?php } ?>
        </table>
        <table class="table" align="right">
            <tr>
                <td style="font-size: 16px;font-weight: bold;">Montant total</td>
            </tr>
            <tr >
                <td>
                    Prix HT
                </td>
                <td><?=$htprice;?></td>
            </tr>
            <tr>
                <td>
                    Prix TTC
                </td>
                <td><?=$htprice * 1.2;?></td>
            </tr>
        </table>
        <table class="table" align="center">
            <tr>
                <td>
                    <h2>Exemple de plan de coupe :</h2>
                </td>
            </tr>
            <tr>
                <td>
                    <img src="<?=url('img/plan-coupe.png');?>" style="max-width: 500px;margin:0 auto;display: block;" />
                </td>
            </tr>
        </table>
        {!! Form::model($devis, ['route' => ['devis.update', $devis->id], 'method' => 'put', 'class' => '']) !!}
      <form method="PUT" action="{{ route('devis.update',$devis->id) }}"> 
        <div class="row mb-4">
          <div class="col-md-12">
            <select class="form-control" id="idEtat" name="idEtat" >
              <?php $etats = DB::table('devisetats')->get();
              foreach ($etats as $k => $v) { ?>
                <option <?php if($v->id==$devis->idEtat)echo'selected'; ?> value="<?=$v->id?>"><?=$v->name;?></option>
              <?php } ?>
            </select>
        <?php if($devis->idEtat!=1 && $devis->idEtat!=4){ ?>
          <select class="form-control" id="idEtat" name="idRemise" >
            <option value="">Attribuer une remise</option>
              <?php $remises = DB::table('remises')->get();
              foreach ($remises as $k => $v) { ?>
                <option <?php if($v->id==$devis->idRemise)echo'selected'; ?> value="<?=$v->id?>"><?=$v->name;?> %</option>
              <?php } ?>
            </select>

        <?php } ?>
      </div>
    </div>
    {!! Form::submit('Mettre à jour mon devis', ['class' => 'btn btn-success pull-right']) !!}
    {!! Form::close() !!}
  </form> 
</div>
@endsection