@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mx-auto">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <?php if(Auth::user()->isAdmin ==1){?>
                        Il y a <?=count($users)-1;?> commerciaux pour <?=count($clients);?> clients.<br/>
                        Actuellement, <?=count($projets);?> projets sont en cours ou finalisés.
                    <?php }else{?>
                        Vous avez <?=count($clients);?> clients.<br/>
                        Actuellement, <?=count($projets);?> projets sont en cours ou finalisés.
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
