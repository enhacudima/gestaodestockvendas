<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendasTroco extends Model
{
    protected $table = 'venda_troco';
    protected $guarded =array();
        protected $hidden = [
        'remember_token',
    ];

    public $primaryKey = 'id';

    public $timestamps=true;
}
