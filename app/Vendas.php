<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    protected $table = 'venda';
    protected $guarded =array();
        protected $hidden = [
        'remember_token',
    ];

    public $primaryKey = 'id';

    public $timestamps=true;
}
