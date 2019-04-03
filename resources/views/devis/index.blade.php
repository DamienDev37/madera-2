@extends('layout')

@section('title')
    Devis
@endsection

@section('content')
<div class="col-12">
	<a href="<?=url('/devis/create');?>" class="btn btn-success">Ajouter un devis</a>
</div>
<div class="col-12 table-responsive-sm">
	<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Client</th>
      <th scope="col">Modifier le devis</th>
      <th scope="col">Supprimer le devis</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td scope="row">Dylan Legrocon</td>
      <td><a href="<?=url('/devis/1');?>"><i class="fas fa-fw fa-pen"></i></a></td>
      <td><a href="<?=url('/delete/1');?>"><i class="fas fa-fw fa-trash-alt"></i></a></td>
    </tr>
  </tbody>
</table>
</div>
@endsection