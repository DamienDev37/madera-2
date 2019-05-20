<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Couverture extends Model
{
    protected $table = 'couvertures';

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom', 'prix', 'idFournisseur',
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
