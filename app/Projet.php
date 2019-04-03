<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    protected $table = 'projets';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom', 'idClient', 'idCommercial', 'timestamp',
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
