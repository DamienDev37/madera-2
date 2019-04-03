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
      <th scope="col">Commercial</th>
      <th scope="col">Voir le projet</th>
      <th scope="col">Supprimer le projet</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($projets as $projet)
    <?php 
    $commercial = DB::table('commerciaux')->where('id', '=', $projet->idCommercial)->first();
    $client = DB::table('clients')->where('id', '=', $projet->idClient)->first(); 
    ?>
    <tr>
      <td scope="row"><?=$projet->nom;?></td>
      <td scope="row"><?=$client->nom.' '. $client->prenom ;?></td>
      <td scope="row"><?=$commercial->nom.' '. $commercial->prenom ;?></td>
      <td><a href="{{ route('projet.show', ['id' => $projet->id]) }}" class="fas fa-fw fa-eye" ></a></td>
      <td>
        <a class="btn" onclick="event.preventDefault();document.getElementById('deleteProjet').submit();"><i class="fas fa-trash"></i></a>
                        <form id="deleteProjet" action="{{ route('projet.destroy',[$projet->id]) }}" method="DELETE" style="display: none;">
                            @csrf
                        </form>
    </td>
    </tr>
  @endforeach
  </tbody>
</table>
</div>
@endsection