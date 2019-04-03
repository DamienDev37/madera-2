@extends('layout')

@section('title')
    Tous les clients
@endsection

@section('content')
<div class="col-12">
  {!! link_to_route('client.create', 'Ajouter un client', [], ['class' => 'btn btn-success']) !!}
</div>
<div class="col-12 table-responsive-sm">
	<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Nom du client</th>
      <th scope="col">Prénom du client</th>
      <th scope="col">Email du client</th>
      <th scope="col">Editer le client</th>
      <th scope="col">Supprimer le client</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($clients as $client)
    <tr>
      <td scope="row"><?=$client->nom;?></td>
      <td scope="row"><?=$client->prenom;?></td>
      <td scope="row"><?=$client->email;?></td>
      <td>{!! link_to_route('client.edit', '', [$client->id], ['class' => 'fas fa-fw fa-pen']) !!}</td>
      <td>
      {!! Form::open(['method' => 'DELETE', 'route' => ['client.destroy', $client->id]]) !!}
        {!! Form::submit('Supprimer', ['class' => '', 'onclick' => 'return confirm(\'Vraiment supprimer ce client ?\')']) !!}
      {!! Form::close() !!}
    </td>
    </tr>
  @endforeach
  </tbody>
</table>
</div>
@endsection