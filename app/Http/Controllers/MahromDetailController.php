<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MahromModel;
use App\SantriModel;
use Yajra\DataTables\DataTables;
use Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class MahromDetailController extends Controller
{
    public function index()
    {
        return view('mahromdetail');
    }

    public function apiMahromDetail($id)
    {
        $kodeapp = Session::get('kodeapp');
        $mahrom = MahromModel::where('tbkeluarga.kodeapp',$kodeapp)
        	->where('tbkeluarga.nis', $id)
            ->join('tbsantri', 'tbkeluarga.nis' , 'tbsantri.nis')
            ->select('tbkeluarga.id','tbkeluarga.kodeapp','tbkeluarga.id_keluarga','tbkeluarga.nis','tbkeluarga.nama as nama_mahrom','tbkeluarga.nohp','tbkeluarga.status','tbsantri.nama as nama_santri')
            ->orderByRaw('tbkeluarga.id ASC')
            ->get();

        return DataTables::of($mahrom)
            ->addColumn('action', function($mahrom){
                return '<a onclick="editForm('. $mahrom->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a> ' .
                    '<a onclick="deleteData('. $mahrom->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }
}
