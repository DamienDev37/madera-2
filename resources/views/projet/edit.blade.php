@extends('layout')

@section('title')
    Editer mon projet
@endsection

@section('content')
<div class="col-md-12">
  <form method="PUT" action="{{ route('projet.update',$projet->id) }}"> 
    <input type="hidden" id="id" name="id" value="<?=$projet->id;?>">
    @csrf
    <div class="form-group">
        <label for="idFamille">Commercial</label>
        <select class="form-control" id="idFamille" name="idFamille" required>
          <option value="">Sélectionnez une Commercial</option>
          <?php foreach($commercials as $k => $v){ ?>
          <option <?php if($v->id==$projet->idCommercial){echo'selected';}?> value="<?=$v->id;?>"><?=$v->lastname.' '.$v->name;?></option>
        <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="typeproduit">Type de produit</label>
      <input type="text" class="form-control" id="typeproduit" name="typeproduit" value="<?=$produit->typeproduit;?>" required>
    </div>
    <div class="form-group">
        <label for="prix">Prix</label>
      <input type="number" step="0.01" class="form-control" id="prix" name="prix" value="<?=$produit->prix;?>" min="0" required>
    </div>
    <div class="form-group">
        <label for="cctp">CCTP</label>
      <input type="file" class="form-control" id="cctp" name="cctp" value="">
      <img class="mt-3" style="width:100px;height:auto;" src="<?=asset('storage/produit/'.$produit->cctp);?>" />
    </div>
    <div class="form-group">
        <label for="img">Image du produit</label>
      <input type="file" class="form-control" id="img" name="img">
      <img class="mt-3" style="width:100px;height:auto;" src="<?=asset('storage/produit/'.$produit->img);?>" />
    </div>
    <button type="submit" class="btn btn-success">Mettre à jour mon produit</button>
  </form> 
</div>
@endsection