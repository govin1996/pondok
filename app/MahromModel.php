<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MahromModel extends Model
{
    protected $table = 'tbkeluarga';

    protected $fillable = ['id','kodeapp','id_keluarga','nis','nama','nohp','status'];
}
