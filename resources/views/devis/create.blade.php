@extends('layout')

@section('title')
    Ajouter un devis
@endsection

@section('content')
<div class="col-md-12">
	{!! Form::open(['route' => 'storeDevis', 'class' => 'form-control']) !!}
		  <div class="form-group">
		    <label for="nomclient">Nom du client</label>
		    {!! Form::text('nomclient', null, ['class' => 'form-control', 'placeholder' => 'Nom du client']) !!}
		  </div>
		  <?php $gammes = array(0 => 'Ecologique', 1 => 'Luxe'); ?>
		  <!--- Gamme eco ----->
		  <div class="form-group d-none formGroup">
		    <label for="gamme">Gamme</label>
		    <select class="form-control" id="gamme" name="gamme">
		    	<option value="">Choisissez une gamme</option>
		    	<?php foreach ($gammes as $k => $v) { ?>
		    		<option value="<?=$k;?>"><?=$v;?></option>
		    	<?php } ?>
		    	c
		    	
		    </select>
		  </div>

		  {!! Form::submit('Générer mon devis', ['class' => 'btn btn-success pull-right']) !!}
	{!! Form::close() !!}
</div>
@endsection