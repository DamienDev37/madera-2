@extends('layout')

@section('title')
    Tous les produits
@endsection

@section('content')
<?php if(Auth::user()->isAdmin ==1){?>
<div class="col-12 my-4">
  {!! link_to_route('produit.create', 'Ajouter un produit', [], ['class' => 'btn btn-success']) !!}
</div>
<?php }?>
<div class="container-fluid">
	<div class="card-deck">
	<?php if(isset($produits)){
		foreach($produits as $k => $v){
			$famille = DB::table('familles')->whereId($v->idFamille)->first();?>
			
	    <div class="card mb-4">
	        <img class="card-img-top" src="{{ asset('storage/produit/'.$v->img) }}" alt="Image du produit <?=$v->id;?>">
	        <div class="card-body">
	        	<h5 class="card-title">Famille : <?=$famille->nom;?></h5>
	            <h5 class="card-title"><?=$v->typeproduit;?></h5>
	            <h5 class="card-title"><?=$v->prix;?> €</h5>
	            <p class="card-text"><a href="<?=asset('storage/produit/'.$v->cctp);?>" target="_blank">Voir le CCTP</a></p>
	            <?php if(Auth::user()->isAdmin ==1){?>
	            <div class="d-inline-flex mr-2">
	            <a href="{{ route('produit.edit', ['id' => $v->id]) }}" class="btn btn-primary " >Editer ce produit</a>
	        </div><div class="d-inline-flex">
		        {!! Form::open(['method' => 'DELETE', 'route' => ['produit.destroy', $v->id]]) !!}
			        {!! Form::submit('Supprimer ce produit', ['class' => 'btn btn-danger', 'onclick' => 'return confirm(\'Vraiment supprimer ce produit ?\')']) !!}
			      {!! Form::close() !!}
			  </div>
			  <?php }?>
	        </div>
	    
	        <div class="card-footer">
	            <small class="text-muted">Mis à jour le : <?=date('d/m/Y',$v->timestamp);?></small>
	        </div>
	    </div>
		<?php }
	}?>
	</div>
</div>
@endsection