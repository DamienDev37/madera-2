@extends('layout')

@section('title')
    Devis
@endsection

@section('content')
<div class="col-12 table-responsive-sm">
  <table class="table table-striped text-center">
  <thead>
    <tr>
      <th scope="col">N° du devis</th>
      <th scope="col">N° de la maison</th>
      <th scope="col">Client</th>
      <th scope="col">Etat du devis</th>
      <th scope="col">Voir le devis</th>
      <th scope="col">Voir le pdf</th>
      <th scope="col">Générer le dossier technique</th>
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
      <td scope="row"><?=$v->id;?></td>
      <td scope="row"><?=$v->idMaison;?></td>
      <td scope="row"><?=$client->nom.' '. $client->prenom ;?></td>
      <td scope="row"><?=$etat->name;?></td>
      <?php if($v->idEtat!=6){ ?>
      <td><a href="{{ route('devis.edit', ['id' => $v->id]) }}" class="btn btn-primary" >Editer le devis</a></td>
      <?php }else{?>
        <td scope="row">Devis validé</td>
      <?php } ?>
      <?php if($v->idEtat==6){ ?>
      <td><a href="{{ route('pdf.show', ['id' => $v->id]) }}" class="btn btn-success" target="_blank" >Voir le devis pdf</a></td>
      <td><a href="{{ route('pdf.edit', ['id' => $v->id]) }}" class="btn btn-success" target="_blank" >Voir le dossier technique</a></td>
    <?php }else{?>
      <td colspan="2">Devis en cours
      </td>
    <?php }?>
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