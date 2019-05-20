@extends('layout')

@section('title')
    Toutes les gammes
@endsection

@section('content')
<div class="col-12 mb-5">
  {!! link_to_route('gamme.create', 'Ajouter une gamme', [], ['class' => 'btn btn-success']) !!}
</div>
<div class="col-12 table-responsive-sm">
	<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Nom gamme</th>
      <th scope="col">Finition</th>
      <th scope="col">Couverture</th>
      <th scope="col">Isolant</th>
      <th scope="col">Parepluie</th>
      <th scope="col">Editer la gamme</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($gammes as $gamme)
    <?php 
    $finition = DB::table('finitions')->whereId($gamme->idFinition)->first();
    $couverture = DB::table('couvertures')->whereId($gamme->idCouverture)->first();
    $isolant = DB::table('isolants')->whereId($gamme->idIsolant)->first();
    $parepluie = DB::table('parepluies')->whereId($gamme->idParePluie)->first();?>
    <tr>
      <td scope="row"><?=$gamme->nom;?></td>
      <td scope="row"><?=$finition->nom;?></td>
      <td scope="row"><?=$couverture->nom;?></td>
      <td scope="row"><?=$isolant->nom;?></td>
      <td scope="row"><?=$parepluie->Nom;?></td>
      <td>{!! link_to_route('gamme.edit', '', [$gamme->id], ['class' => 'fas fa-fw fa-pen']) !!}</td>
    </tr>
  @endforeach
  </tbody>
</table>
</div>
@endsection