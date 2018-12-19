<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    protected $table = 'mesa';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;
}
