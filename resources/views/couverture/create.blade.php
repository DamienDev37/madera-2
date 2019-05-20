@extends('layout')

@section('title')
    Création d'une couverture
@endsection

@section('content')
<div class="col-md-12">
	{!! Form::open(['route' => 'couverture.store']) !!}
		<div class="form-group col-md-4">
		    <label for="nom">Nom</label>
			<input type="text" class="form-control" id="nom" name="nom" required>
		</div>
		<div class="form-group col-md-4">
		    <label for="prenom">Prix</label>
			<input type="text" class="form-control" id="prenom" name="prenom" required>
		</div>
		<select class="form-control" name="idProduit[]">
                <option value="" selected>Choisissez un fournisseur</option>
                <?php if(isset($fournisseurs)){
                foreach ($fournisseurs as $k => $v) { ?>
                  <option value="<?=$v->id?>"><?=$v->name;?></option>
                <?php } }?>
        </select>
		  {!! Form::submit('Générer la couverture', ['class' => 'btn btn-success pull-right']) !!}
	{!! Form::close() !!}
</div>
@endsection