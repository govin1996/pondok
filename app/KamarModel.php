<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KamarModel extends Model
{
    protected $table = 'tbkamar';

    protected $fillable = ['id','kodeapp','nama_kamar'];
}
