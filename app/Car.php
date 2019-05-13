<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'car';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;
}
