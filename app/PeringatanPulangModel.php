<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeringatanPulangModel extends Model
{
    protected $table = 'tbperingatan_pulang';

    protected $fillable = ['id','kodeapp','hari','jam'];
}
