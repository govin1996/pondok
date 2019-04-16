<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class login extends Model
{
    protected $table = 'tboperator';

    protected $fillable = ['kodeapp','nama_pondok','user','password'];
}
