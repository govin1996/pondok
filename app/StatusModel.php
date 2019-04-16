<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusModel extends Model
{
    protected $table = 'tb_status';

    protected $fillable = ['id','kodeapp','nama_status'];
}
