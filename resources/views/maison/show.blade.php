@extends('layout')

@section('title')
  Choix de la gamme et modules
@endsection

@section('content')
<input type="hidden" name="idChoiceGamme" value="<?=$maison->idGamme;?>" />
<div class="col-md-12">
  {!! Form::model($maison, ['route' => ['maison.update', $maison->id], 'method' => 'put', 'class' => '']) !!}
  <div class="row">
    <div class="form-group col-md-12">
        <label for="idGamme">Gamme de la maison</label>
        <select required class="form-control" id="idGamme" name="idGamme">
          <option value="" selected>Choisissez la gamme</option>
          <?php foreach ($gammes as $k => $v) { ?>
            <option <?php if($v->id==$maison->idGamme)echo'selected'; ?> value="<?=$v->id?>"><?=$v->nom;?></option>
          <?php } ?>
        </select>
    </div>
    <?php foreach ($gammes as $k => $v) {
        $finition = DB::table('finitions')->where('id', '=', $v->idFinition)->first();
        $couverture = DB::table('couvertures')->where('id', '=', $v->idCouverture)->first();
        $isolant = DB::table('isolants')->where('id', '=', $v->idIsolant)->first();
        $parepluie = DB::table('parepluies')->where('id', '=', $v->idParePluie)->first();
     ?>
      <div class="form-group col-md-12 wrapGamme gamme<?=$v->id;?> <?php if($v->id!=$maison->idGamme)echo'd-none'; ?>">
          <p>Finition : <?=$finition->nom;?></p>
          <p>Couverture : <?=$couverture->nom;?></p>
          <p>Isolant : <?=$isolant->nom;?></p>
          <p>Parepluie : <?=$parepluie->Nom;?></p>
      </div>
    <?php }?>
  </div>
  <div class="row">
    <div class="col-md-12">
      <h4>Sections</h4>
    </div>
    <?php $composants1 = DB::table('composants')
    ->where('idMaison', '=', $maison->id)
    ->where('idFamille', '=', 1)
    ->get();  ?>
    <div class="col-md-12">
      <div class="card-deck" name="wrapSectionProducts">
        <?php if(isset($composants1)){foreach($composants1 as $k => $v){?>
        <div class="card cardProduct my-3">
          <div class="card-body">
            <h5 class="card-title">Produit existant</h5>
              <input type="hidden" class="form-control" name="idMaison[]" value="<?=$maison->id;?>" />
              <select class="form-control" name="idProduit[]">
                <option value="" selected>Choisissez un produit</option>
                <?php if(isset($sections)){
                foreach ($sections as $kk => $vv) { ?>
                  <option value="<?=$vv->id?>" <?php if($v->idProduit==$vv->id){echo 'selected';}?>><?=$vv->typeproduit;?></option>
                <?php } }?>
              </select>
              <label class="mt-3">Quantité</label>
              <input type="number" class="form-control" name="quantite[]" value="<?=$v->quantite;?>" />
              <input type="hidden" class="form-control" name="idFamille[]" value="1"/>
          </div>
          <a class="deteleCardProduct btn btn-danger w-100">
            <input type="hidden" value="1" class="isVisible" name="isVisible[]" />
          Supprimer ce produit</a>

        </div>
      <?php }} ?>
      </div>
      <div class="form-group col-md-12 mt-4">
        <a class="btn btn-success" name="addSectionProduct">Ajouter un produit</a>
      </div>  
    </div> 
    <div class="col-md-12">
      <h4>Montants</h4>
    </div>
    <?php $composants2 = DB::table('composants')->where([
      ['idMaison', '=', $maison->id],
      ['idFamille', '=', 2],
    ])->get();  ?>
    <div class="col-md-12">
      <div class="card-deck" name="wrapMontantProducts">
        <?php if(isset($composants2)){foreach($composants2 as $k => $v){?>
        <div class="card cardProduct my-3">
          <div class="card-body">
            <h5 class="card-title">Produit existant</h5>
              <input type="hidden" class="form-control" name="idMaison[]" value="<?=$maison->id;?>" />
              <select class="form-control" name="idProduit[]">
                <option value="" selected>Choisissez un produit</option>
                <?php foreach ($montants as $kk => $vv) { ?>
                  <option value="<?=$vv->id?>" <?php if($vv->id==$v->idProduit){echo'selected';}?> ><?=$vv->typeproduit;?></option>
                <?php } ?>
              </select>
              <label class="mt-3">Quantité</label>
              <input type="number" class="form-control" name="quantite[]" value="<?=$v->quantite;?>" />
              <input type="hidden" class="form-control" name="idFamille[]" value="2"/>
          </div>
          <a class="deteleCardProduct btn btn-danger w-100">
            <input type="hidden" value="1" class="isVisible" name="isVisible[]" />
          Supprimer ce produit</a>
        </div>
      <?php }} ?>
      </div>
      <div class="form-group col-md-12 mt-4">
        <a class="btn btn-success" name="addMontantProduct">Ajouter un produit</a>
      </div>  
    </div> 
    <div class="col-md-12">
      <h4>Remplissage entre deux montants</h4>
    </div>
    <?php $composants3 = DB::table('composants')->where([
      ['idMaison', '=', $maison->id],
      ['idFamille', '=', 3],
    ])->get();  ?>
    <div class="col-md-12">
      <div class="card-deck" name="wrapRempliProducts">
        <?php if(isset($composants3)){foreach($composants3 as $k => $v){?>
        <div class="card cardProduct my-3">
          <div class="card-body">
            <h5 class="card-title">Produit existant</h5>
              <input type="hidden" class="form-control" name="idMaison[]" value="<?=$maison->id;?>" />
              <select class="form-control" name="idProduit[]">
                <option value="" selected>Choisissez un produit</option>
                <?php foreach ($remplissages as $kk => $vv) { ?>
                  <option value="<?=$vv->id?>" <?php if($vv->id==$v->idProduit){echo'selected';}?> ><?=$vv->typeproduit;?></option>
                <?php } ?>
              </select>
              <label class="mt-3">Quantité</label>
              <input type="number" class="form-control" name="quantite[]" value="<?=$v->quantite;?>" />
              <input type="hidden" class="form-control" name="idFamille[]" value="3"/>
          </div>
          <a class="deteleCardProduct btn btn-danger w-100">
            <input type="hidden" value="1" class="isVisible" name="isVisible[]" />
          Supprimer ce produit</a>
        </div>
      <?php }} ?>
      </div>
      <div class="form-group col-md-12 mt-4">
        <a class="btn btn-success" name="addRempliProduct">Ajouter un produit</a>
      </div>  
    </div>
    <div class="form-group col-md-12">
      {!! Form::submit('Générer ma maison', ['class' => 'btn btn-success pull-right']) !!}
    </div>  
  </div>
  
  {!! Form::close() !!}
<div class="card cardProduct cardSectionToDuplicate my-3" style="display:none;">
          <div class="card-body">
            <h5 class="card-title">Produit ajouté</h5>
              <input type="hidden" class="form-control" name="idMaison[]" value="<?=$maison->id;?>" />
              <select class="form-control" name="idProduit[]">
                <option value="" selected>Choisissez un produit</option>
                <?php if(isset($sections)){foreach ($sections as $k => $v) { ?>
                  <option value="<?=$v->id;?>"><?=$v->typeproduit;?></option>
                <?php }} ?>
              </select>
              <label class="mt-3">Quantité</label>
              <input type="number" class="form-control" name="quantite[]" />
              <input type="hidden" class="form-control" name="idFamille[]" value="1"/>
          </div>
          <a class="deteleCardProduct btn btn-danger w-100">
            <input type="hidden" value="1" class="isVisible" name="isVisible[]" />
          Supprimer ce produit</a>
        </div>
  <div class="card cardProduct cardMontantToDuplicate my-3" style="display:none;">
          <div class="card-body">
            <h5 class="card-title">Produit ajouté</h5>
              <input type="hidden" class="form-control" name="idMaison[]" value="<?=$maison->id;?>" />
              <select class="form-control" name="idProduit[]">
                <option value="" selected>Choisissez un produit</option>
                <?php if(isset($montants)){foreach ($montants as $k => $v) { ?>
                  <option value="<?=$v->id;?>"><?=$v->typeproduit;?></option>
                <?php }} ?>
              </select>
              <label class="mt-3">Quantité</label>
              <input type="number" class="form-control" name="quantite[]" />
              <input type="hidden" class="form-control" name="idFamille[]" value="2"/>
              <input type="hidden" class="form-control" name="isVisible[]" value="1" />
          </div>
          <a class="deteleCardProduct btn btn-danger w-100">
            <input type="hidden" value="1" class="isVisible" name="isVisible[]" />
          Supprimer ce produit</a>
        </div>
  <div class="card cardProduct cardRempliToDuplicate my-3" style="display:none;">
          <div class="card-body">
            <h5 class="card-title">Produit ajouté</h5>
              <input type="hidden" class="form-control" name="idMaison[]" value="<?=$maison->id;?>" />
              <select class="form-control" name="idProduit[]">
                <option value="" selected>Choisissez un produit</option>
                <?php if(isset($remplissages)){foreach ($remplissages as $k => $v) { ?>
                  <option value="<?=$v->id;?>"><?=$v->typeproduit;?></option>
                <?php }} ?>
              </select>
              <label class="mt-3">Quantité</label>
              <input type="number" class="form-control" name="quantite[]" />
              <input type="hidden" class="form-control" name="idFamille[]" value="3"/>

          </div>
          <a class="deteleCardProduct btn btn-danger w-100">
            <input type="hidden" value="1" class="isVisible" name="isVisible[]" />
          Supprimer ce produit</a>
        </div>
        
</div>
@endsection