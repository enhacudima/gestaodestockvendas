<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;
}
