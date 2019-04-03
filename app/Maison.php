<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maison extends Model
{
    protected $table = 'maison';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idProjet', 'nbetages', 'longueur', 'largeur', 'hauteur', 'hauteurToit', 'idGamme','timestamp',
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
