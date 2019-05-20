@extends('layout')

@section('title')
    Couverture - Edition
@endsection

@section('content')
<div class="col-md-12">
  {!! Form::model($couverture, ['route' => ['couverture.update', $couverture->id], 'method' => 'put', 'class' => '']) !!}
    <div class="form-group col-md-4">
        <label for="nom">Nom</label>
      <input type="text" class="form-control" id="nom" name="nom" required>
    </div>
    <div class="form-group col-md-4">
        <label for="prenom">Prix</label>
      <input type="text" class="form-control" id="prenom" name="prenom" required>
    </div>
    <select class="form-control" name="idFournisseur">
                <option value="" selected>Choisissez un fournisseur</option>
                <?php if(isset($fournisseurs)){
                foreach ($fournisseurs as $k => $v) { ?>
                  <option value="<?=$v->id?>" <?php if($v->id==$couverture->idFournisseur){echo'selected';}?>><?=$v->name;?></option>
                <?php } }?>
        </select>
      {!! Form::submit('Mettre à jour la couverture', ['class' => 'btn btn-success pull-right']) !!}
  {!! Form::close() !!}
</div>
@endsection