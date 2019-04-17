@extends('layout')

@section('title')
    Devis
@endsection

@section('content')
<div class="col-12 table-responsive-sm">
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">N° du devis</th>
      <th scope="col">N° de la maison</th>
      <th scope="col">Client</th>
      <th scope="col">Etat du devis</th>
      <th scope="col">Voir le devis</th>
      <th scope="col">Supprimer le devis</th>
    </tr>
  </thead>
  <tbody>
    <?php if(isset($devis)){?>
    @foreach ($devis as $k => $v)
    <?php 
    $client = DB::table('clients')->where('id', '=', $v->idClient)->first(); 
    $maison = DB::table('maison')->where('id', '=', $v->idMaison)->first(); 
    $etat = DB::table('devisetats')->where('id', '=', $v->idEtat)->first(); 
    ?>
    <tr>
      <td scope="row"><?=$v->numeroDevis;?></td>
      <td scope="row"><?=$v->idMaison;?></td>
      <td scope="row"><?=$client->nom.' '. $client->prenom ;?></td>
      <td scope="row"><?=$etat->name;?></td>
      <td><a href="{{ route('devis.edit', ['id' => $v->id]) }}" class="btn btn-primary" >Editer le devis</a></td>
      <td>
        {!! Form::open(['method' => 'DELETE', 'route' => ['devis.destroy', $v->id]]) !!}
              {!! Form::submit('Supprimer ce devis', ['class' => 'btn btn-danger', 'onclick' => 'return confirm(\'Vraiment supprimer ce devis ?\')']) !!}
            {!! Form::close() !!}
      </td>
    </tr>
  @endforeach
<?php } ?>
  </tbody>
</table>
</div>
@endsection