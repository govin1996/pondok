<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApproveModel extends Model
{
    protected $table = 'tbapprove';

    protected $fillable = ['id','kodeapp','id_izin','id_pimpinan','status'];
}
