<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    protected $table = 'devis';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idCommercial', 'idMaison', 'idEtat', 'idRemise', 'isValidated', 'isOut', 'total','numeroDevis',
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
