@extends('layout')

@section('title')
    Création d'un projet
@endsection

@section('content')
<div class="col-md-12">
	{!! Form::open(['route' => 'projet.store']) !!}
		<div class="form-group">
		    <label for="nom">Nom du projet</label>
		    <input type="text" class="form-control" id="nom" name="nom">
		  </div>
		  <div class="form-group">
		    <label for="idClient">Nom du client</label>
		    <select class="form-control" id="idClient" name="idClient">
		    	<option value="">Choisissez le client</option>
		    	<?php foreach ($clients as $k => $v) { ?>
		    		<option value="<?=$v->id?>"><?=$v->nom.' '.$v->prenom;?></option>
		    	<?php } ?>
		    </select>
		  </div>
		  <input type="hidden" class="form-control" id="idCommercial" name="idCommercial" value="<?=Auth::user()->id;?>">
		  
		<input type="hidden" class="form-control" id="timestamp" name="timestamp" value="<?=time();?>">
		  {!! Form::submit('Générer mon projet', ['class' => 'btn btn-success pull-right']) !!}
	{!! Form::close() !!}
</div>
@endsection