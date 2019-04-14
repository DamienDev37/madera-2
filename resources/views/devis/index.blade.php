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
      <th scope="col">Client</th>
      <th scope="col">Etat du devis</th>
      <th scope="col">Voir le devis</th>
      <th scope="col">Supprimer le devis</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td scope="row">Dylan Legrocon</td>
      <td scope="row"></td>
      <td><a href="<?=url('/devis/1');?>"><i class="fas fa-fw fa-pen"></i></a></td>
      <td><a href="<?=url('/delete/1');?>"><i class="fas fa-fw fa-trash-alt"></i></a></td>
    </tr>
  </tbody>
</table>
</div>


<div class="col-12 table-responsive-sm">
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">N° du devis</th>
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
      <td scope="row"><?=$client->nom.' '. $client->prenom ;?></td>
      <td scope="row"><?=$etat->name;?></td>
     
    </tr>
  @endforeach
<?php } ?>
  </tbody>
</table>
</div>
@endsection