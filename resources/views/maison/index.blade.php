@extends('layout')

@section('title')
    Tous les projets
@endsection

@section('content')
<div class="col-12">
  {!! link_to_route('projet.create', 'Ajouter un projet', [], ['class' => 'btn btn-success']) !!}
</div>
<div class="col-12 table-responsive-sm">
	<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Nom du projet</th>
      <th scope="col">Client</th>
      <th scope="col">Commercial</th>
      <th scope="col">Modifier le projet</th>
      <th scope="col">Supprimer le projet</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($projets as $projet)
    <?php 
    $commercial = DB::table('commerciaux')->where('id', '=', $projet->idCommercial)->first();; 
    $client = DB::table('clients')->where('id', '=', $projet->idClient)->first(); 
    ?>
    <tr>
      <td scope="row"><?=$projet->nom;?></td>
      <td scope="row"><?=$client->nom.' '. $client->prenom ;?></td>
      <td scope="row"><?=$commercial->nom.' '. $commercial->prenom ;?></td>
      <td>{!! link_to_route('projet.show', '', [$projet->id], ['class' => 'fas fa-fw fa-pen']) !!}</td>
      <td>
      {!! Form::open(['method' => 'DELETE', 'route' => ['projet.destroy', $projet->id]]) !!}
        {!! Form::submit('Supprimer', ['class' => '', 'onclick' => 'return confirm(\'Vraiment supprimer ce projet ?\')']) !!}
      {!! Form::close() !!}
    </td>
    </tr>
  @endforeach
  </tbody>
</table>
</div>
@endsection