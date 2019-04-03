<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Composant extends Model
{
    protected $table = 'composants';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idMaison','idProduit','quantite', 'idFamille'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];
}
