@extends('layout')

@section('title')
    Création d'un client
@endsection

@section('content')
<div class="col-md-12">
	{!! Form::open(['route' => 'client.store']) !!}
		<div class="form-group col-md-4">
		    <label for="nom">Nom du client</label>
			<input type="text" class="form-control" id="nom" name="nom" required>
		</div>
		<div class="form-group col-md-4">
		    <label for="prenom">Prénom du client</label>
			<input type="text" class="form-control" id="prenom" name="prenom" required>
		</div>
		<div class="form-group col-md-4">
		    <label for="email">Email</label>
			<input type="email" class="form-control" id="email" name="email" required>
		</div>
		  {!! Form::submit('Générer le client', ['class' => 'btn btn-success pull-right']) !!}
	{!! Form::close() !!}
</div>
@endsection