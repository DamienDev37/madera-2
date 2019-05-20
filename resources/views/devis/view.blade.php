@extends('layout')

@section('title')
    Ajouter un devis
@endsection

<?php

$client = new stdClass();
$client->id=1;
$client->nom="Dylan";
$clients[$client->id]=$client->nom;
$client = new stdClass();
$client->id=2;
$client->nom="Arthur";
$clients[$client->id]=$client->nom;


$gamme = new stdClass();
$gamme->id=1;
$gamme->nom="Ecologique";
$gammes[$gamme->id]=$gamme->nom;
$gamme = new stdClass();
$gamme->id=2;
$gamme->nom="Luxe";
$gammes[$gamme->id]=$gamme->nom;
?>

@section('content')
<div class="col-md-12">
	{!! Form::open(['route' => 'storeDevis']) !!}
		  <div class="form-group">
		    <label for="idClient">Nom du client</label>
		    <select class="form-control" id="idClient" name="idClient">
		    	<option value="">Choisissez le client</option>
		    	<?php foreach ($clients as $k => $v) { ?>
		    		<option value="<?=$k+1;?>"><?=$v;?></option>
		    	<?php } ?>
		    </select>
		  </div>
		  <!--- Gamme eco ----->
		  <div class="form-group">
		    <label for="gamme">Gamme</label>
		    <select class="form-control" id="gamme" name="gamme">
		    	<option value="">Choisissez une gamme</option>
		    	<?php foreach ($gammes as $k => $v) { ?>
		    		<option value="<?=$k+1;?>"><?=$v;?></option>
		    	<?php } ?>
		    </select>
		  </div>
		  {!! Form::submit('Générer mon devis', ['class' => 'btn btn-success pull-right']) !!}
	{!! Form::close() !!}
</div>
@endsection