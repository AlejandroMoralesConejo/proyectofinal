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
        'nombre', 'fecha', 'hora', 'idPista',
    ];

    /**
     * Relation with users (model, third table name, primary key, pk user)
     */

    public function users()
    {
        return $this->belongsToMany('App\User', 'partido_jugador', 'idPartido', 'idJug');
    }

    /**
     * Relation with courts (model and fk)
     */

    public function pista()
    {
        return $this->belongsTo('App\Pista', 'idPista');
    }
}
