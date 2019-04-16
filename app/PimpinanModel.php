<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PimpinanModel extends Model
{
    protected $table = 'tbpimpinan';

    protected $fillable = ['id','kodeapp','id_pimpinan','nama','jabatan','nohp'];
}
