<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JabatanModel extends Model
{
    protected $table = 'tbjabatan_pimpinan';

    protected $fillable = ['id','kodeapp','nama_jabatan'];
}
