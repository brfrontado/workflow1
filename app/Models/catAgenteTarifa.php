<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;


class catAgenteTarifa extends Eloquent {
    public $timestamps = false;
    protected $table = 'catAgenteTarifa';
    protected $primaryKey = 'id';


    /*public function lineas() {
        return $this->hasMany(Lineas::class, 'marcaId', 'id');
    }*/

}
