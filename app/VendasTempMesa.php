<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendasTempMesa extends Model
{
    protected $table = 'vendas_temp_mesa';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;
}
