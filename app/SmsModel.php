<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsModel extends Model
{
    protected $table = 'tbsms';

    protected $fillable = ['id','kodeapp','id_izin','id_pimpinan','nohp','isi','status'];
}
