@extends('layout')

@section('title')
    Maisons du projet
@endsection

@section('content')
<div class="col-12">
    <a class="btn btn-success" href="{{ route('maison.create', ['idProjet' => $id]) }}">Ajouter une maison</a>
</div>
<div class="col-12 table-responsive-sm">
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Date de création / mise à jour</th>
      <th scope="col">Nb étages</th>
      <th scope="col">Longueur</th>
      <th scope="col">Largeur</th>
      <th scope="col">Générer un devis</th>
      <th scope="col">Modifier la maison</th>
      <th scope="col">Supprimer la maison</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($maisons as $maison)
    <tr>
      <td scope="row">{!! $maison->id !!}</td>
      <td scope="row"><?=date('d/m/Y',$maison->timestamp);?></td>
      <td scope="row">{!! $maison->nbetages !!}</td>
      <td scope="row">{!! $maison->longueur !!}</td>
      <td scope="row">{!! $maison->largeur !!}</td>
      <td><a href="{{ route('devis.show', ['id' => $maison->id]) }}" class="fas fa-fw fa-file-pdf" ></a></td>
      <td><a href="{{ route('maison.show', ['id' => $maison->id]) }}" class="fas fa-fw fa-pen" ></a></td>
      <td>
      {!! Form::open(['method' => 'DELETE', 'route' => ['maison.destroy', $maison->id]]) !!}
        {!! Form::submit('Supprimer', ['class' => 'btn btn-danger', 'onclick' => 'return confirm(\'Vraiment supprimer cette maison ?\')']) !!}
      {!! Form::close() !!}
    </td>
      @endforeach
    </tr>
  </tbody>
</table>
</div>
@endsection