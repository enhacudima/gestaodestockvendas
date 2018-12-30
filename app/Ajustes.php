<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ajustes extends Model
{
    protected $table = 'produtos_ajustes';
    protected $guarded =array();
        protected $hidden = [
        'remember_token',
    ];

    public $primaryKey = 'id';

    public $timestamps=true;
}
