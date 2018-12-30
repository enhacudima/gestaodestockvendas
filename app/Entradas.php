<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entradas extends Model
{
    protected $table = 'produtos_entradas';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;
}
