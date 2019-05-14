<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteVenda extends Model
{
    protected $table = 'cliente_venda';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;
}
