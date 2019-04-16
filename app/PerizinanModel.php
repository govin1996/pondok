<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerizinanModel extends Model
{
    protected $table = 'tbizin';

    protected $fillable = ['id','kodeapp','id_izin','nis','keperluan','tipe_penjemput','nama_penjemput','tgl_plg','tgl_kembali','jam_pergi','jam_kembali','approve','status_kembali'];
}
