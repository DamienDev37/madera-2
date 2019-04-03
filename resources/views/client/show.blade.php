@extends('layout')

@section('title')
    Maisons du projet
@endsection

@section('content')
<div class="col-md-12">
  {!! Form::model($client, ['route' => ['client.update', $client->id], 'method' => 'put', 'class' => '']) !!}
    <div class="form-group col-md-4">
        <label for="nom">Nom du client</label>
      <input type="text" class="form-control" id="nom" name="nom" value="<?=$client->nom;?>">
    </div>
    <div class="form-group col-md-4">
        <label for="prenom">Prénom du client</label>
      <input type="text" class="form-control" id="prenom" name="prenom" value="<?=$client->prenom;?>">
    </div>
    <div class="form-group col-md-4">
        <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="email" value="<?=$client->email;?>">
    </div>
      {!! Form::submit('Mettre à jour le client', ['class' => 'btn btn-success pull-right']) !!}
  {!! Form::close() !!}
</div>
@endsection