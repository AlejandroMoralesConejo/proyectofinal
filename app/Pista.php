<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pista extends Model
{
    protected $table = 'pista';
    protected $primaryKey = 'idPista';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombreP', 'direccionP', 
    ];

    /**
     * relation with matches
     */
    
    public function partidos()
    {
        return $this->hasMany('App\Partido', 'idPista', 'idPista');
    }
}
