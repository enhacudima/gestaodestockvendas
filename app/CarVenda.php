<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarVenda extends Model
{
    protected $table = 'car_venda';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;
}
