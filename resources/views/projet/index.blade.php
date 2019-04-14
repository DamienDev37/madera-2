@extends('layout')

@section('title')
    Tous les projets
@endsection

@section('content')
<div class="col-12">

  <a href="{{ route('projet.create') }}" class="btn btn-success">Ajouter un projet</a>
</div>
<div class="col-12 table-responsive-sm">
	<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Nom du projet</th>
      <th scope="col">Client</th>
      <th scope="col">Date du projet</th>
      <th scope="col">Voir</th>
      <th scope="col">Supprimer</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($projets as $projet)
    <?php 
    $client = DB::table('clients')->where('id', '=', $projet->idClient)->first(); 
    ?>
    <tr>
      <td scope="row"><?=$projet->nom;?></td>
      <td scope="row"><?=$client->nom.' '. $client->prenom ;?></td>
      <td scope="row"><?=date('d/m/Y',$projet->timestamp);?></td>
      <td><a href="{{ route('projet.show', ['id' => $projet->id]) }}" class="btn btn-primary" >Voir le projet</a></td>
      <td>
        {!! Form::open(['method' => 'DELETE', 'route' => ['projet.destroy', $projet->id]]) !!}
              {!! Form::submit('Supprimer ce projet', ['class' => 'btn btn-danger', 'onclick' => 'return confirm(\'Vraiment supprimer ce projet ?\')']) !!}
            {!! Form::close() !!}
    </td>
    </tr>
  @endforeach
  </tbody>
</table>
</div>
@endsection