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
      <th scope="col">Nb étages</th>
      <th scope="col">Longueur</th>
      <th scope="col">Largeur</th>
      <th scope="col">Voir le devis</th>
      <th scope="col">Modifier la maison</th>
      <th scope="col">Supprimer la maison</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($maisons as $maison)
    <tr>
      <td scope="row">{!! $maison->id !!}</td>
      <td scope="row">{!! $maison->nbetages !!}</td>
      <td scope="row">{!! $maison->longueur !!}</td>
      <td scope="row">{!! $maison->largeur !!}</td>
      <td><a href="{{ route('pdf.show', ['id' => $maison->id]) }}" class="fas fa-fw fa-eye" ></a></td>
      <td><a href="{{ route('maison.show', ['id' => $maison->id]) }}" class="fas fa-fw fa-eye" ></a></td>
      <td>
        <a class="btn" onclick="event.preventDefault();document.getElementById('deleteContent').submit();"><i class="fas fa-trash"></i></a>
        <form id="deleteContent" action="{{ route('maison.destroy',[$maison->id]) }}" method="DELETE" style="display: none;">
        @csrf
        </form>
      </td>
      @endforeach
    </tr>
  </tbody>
</table>
</div>
@endsection