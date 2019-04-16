<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeringatanPergiModel extends Model
{
    protected $table = 'tbperingatan_pergi';

    protected $fillable = ['id','kodeapp','waktu'];
}
