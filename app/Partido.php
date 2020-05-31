<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    protected $table = 'partido';
    protected $primaryKey = 'idPartido';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'fecha', 'hora', 
    ];

    public function users()
    {
        return $this->belongsToMany('App\User', 'partido_jugador', 'idPartido', 'idJug');
    }

    public function pista()
    {
        return $this->belongsTo('App\Pista', 'idPista');
    }
}
