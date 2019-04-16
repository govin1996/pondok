<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaerahModel extends Model
{
    protected $table = 'tbdaerah';

    protected $fillable = ['id','kodeapp','nama_daerah'];
}
