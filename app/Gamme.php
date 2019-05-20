<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gamme extends Model
{
    protected $table = 'gammes';

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom', 'idFinition', 'idCouverture','idIsolant','idParepluie',
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
