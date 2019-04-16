<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SantriModel extends Model
{
    protected $table = 'tbsantri';

    protected $fillable = ['id','kodeapp','nis','nama','daerah','kamar','tempat_lahir','tanggal_lahir','status','photo'];
}
