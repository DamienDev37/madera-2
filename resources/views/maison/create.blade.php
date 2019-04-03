@extends('layout')

@section('title')
    Création d'une maison
@endsection

@section('content')
<div class="col-md-12">
	{!! Form::open(['route' => 'maison.store']) !!}
	<div class="row">
		<input type="hidden" class="form-control" id="idProjet" name="idProjet" value="1">
		<div class="form-group col-md-4">
		    <label for="idGamme">Gamme de la maison</label>
		    <select required class="form-control" id="idGamme" name="idGamme">
		    	<option value="">Choisissez la gamme</option>
		    	<?php foreach ($gammes as $k => $v) { ?>
		    		<option value="<?=$v->id?>"><?=$v->nom;?></option>
		    	<?php } ?>
		    </select>
		  </div>
		<div class="form-group col-md-4">
		    <label for="nbetages">Nombre d'étages</label>
			<input required type="number" class="form-control" id="nbetages" min="0" step="1" name="nbetages">
		</div>
		<div class="form-group col-md-4">
		    <label for="longueur">Longueur</label>
			<input required type="number" class="form-control" id="longueur" min="0" step="1" name="longueur">
		</div>
		<div class="form-group col-md-4">
		    <label for="largeur">Largeur</label>
			<input required type="number" class="form-control" id="largeur" min="0" step="1" name="largeur">
		</div>
		<div class="form-group col-md-4">
		    <label for="hauteur">Hauteur</label>
			<input required type="number" class="form-control" id="hauteur" min="0" step="1" name="hauteur">
		</div>
		<div class="form-group col-md-4">
		    <label for="hauteurToit">Hauteur du toit</label>
			<input required type="number" class="form-control" id="hauteurToit" min="0" step="1" name="hauteurToit">
		</div>
		<input type="hidden" name="timestamp" value="<?=time();?>">
		<div class="form-group col-md-4">
		  {!! Form::submit('Générer ma maison', ['class' => 'btn btn-success pull-right']) !!}
		</div>	
	</div>
	{!! Form::close() !!}

</div>
@endsection