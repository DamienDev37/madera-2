@extends('layout')

@section('title')
    Création d'un produit
@endsection

@section('content')
<div class="container-fluid">
<div class="row justify-content-center">
<div class="col-md-8">
	<form method="POST" action="{{ route('produit.store') }}" enctype="multipart/form-data"> 
		@csrf
		<div class="form-group">
		    <label for="idFamille">Famille du produit</label>
		    <select class="form-control" id="idFamille" name="idFamille" required>
		    	<option value="">Sélectionnez une famille</option>
		    	<?php foreach($familles as $k => $v){ ?>
		    	<option value="<?=$v->id;?>"><?=$v->nom;?></option>
		    <?php } ?>
		    </select>
		</div>
		<div class="form-group">
		    <label for="typeproduit">Type de produit</label>
			<input type="text" class="form-control" id="typeproduit" name="typeproduit" required>
		</div>
		<div class="form-group">
		    <label for="prix">Prix</label>
			<input type="number" step="0.01" class="form-control" id="prix" name="prix" min="0" required>
		</div>
		<div class="form-group">
		    <label for="cctp">CCTP</label>
			<input type="file" class="form-control" id="cctp" name="cctp" required>
		</div>
		<div class="form-group">
		    <label for="img">Image du produit</label>
			<input type="file" class="form-control" id="img" name="img" required>
		</div>
		<button type="submit" class="btn btn-success">Générer mon produit</button>
	</form> 
</div>
</div>
</div>
@endsection