@extends('layout')

@section('title')
    Tous les couvertures
@endsection

@section('content')
<div class="col-12 mb-5">
  {!! link_to_route('couverture.create', 'Ajouter une couverture', [], ['class' => 'btn btn-success']) !!}
</div>
<div class="col-12 table-responsive-sm">
	<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Nom couverture</th>
      <th scope="col">Prix</th>
      <th scope="col">Editer la couverture</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($couvertures as $couverture)
    <tr>
      <td scope="row"><?=$couverture->nom;?></td>
      <td scope="row"><?=$couverture->prenom;?></td>
      <td scope="row"><?=$couverture->email;?></td>
      <td>{!! link_to_route('couverture.edit', '', [$couverture->id], ['class' => 'fas fa-fw fa-pen']) !!}</td>
    </tr>
  @endforeach
  </tbody>
</table>
</div>
@endsection