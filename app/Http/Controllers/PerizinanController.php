<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SantriModel;
use App\MahromModel;
use App\PerizinanModel;
use App\PimpinanModel;
use App\SmsModel;
use App\ApproveModel;
use Yajra\DataTables\DataTables;
use Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PerizinanController extends Controller
{
    public function index(){
    	return view('perizinan');
    }

    public function show(){

    }

    public function update(){

    }

    public function store(Request $request)
    {
        $kodeapp = Session::get('kodeapp');
        $tipe = $request->input('keperluan');
        $penjemput = $request->input('tipe_penjemput');

        if($penjemput == "Mahrom"){
            $nama = $request->input('nama');
        }else{
            $nama = $request->input('nama_penjemput');
        }

        if($tipe == "Pergi"){
            $order = PerizinanModel::max('id');
            $order2 = $order + 1;
            $idizin = 'IZIN'.$order2;
            $status = "0";
            PerizinanModel::create([
                'kodeapp' => $kodeapp,
                'id_izin' => $idizin,
                'nis' => request('nis'),
                'keperluan' => $tipe,
                'tipe_penjemput' => request('tipe_penjemput'),
                'nama_penjemput' => $nama,
                'jam_pergi' => request('jam_pergi'),
                'jam_kembali' => request('jam_kembali'),
                'status_kembali' => $status
            ]);

            $pimpinan = PimpinanModel::where('kodeapp',$kodeapp)
                    ->get();

            $isipesan = "Assalamualaikum, Santri \n"."Nama : ".$request->input('nama_santri')." \n"."Keperluan : ".$request->input('keperluan')." \n"."Membutuhkan Persetujuan Jenengan. Terimakasih";

            if (count($pimpinan)>0) {
                foreach ($pimpinan as $row){
                    SmsModel::create([
                        'kodeapp' => $kodeapp,
                        'id_izin' => $idizin,
                        'id_pimpinan' => $row->id_pimpinan,
                        'nohp' => $row->nohp,
                        'isi' => $isipesan,
                        'status' => $status
                    ]);
                    ApproveModel::create([
                        'kodeapp' => $kodeapp,
                        'id_izin' => $idizin,
                        'id_pimpinan' => $row->id_pimpinan,
                        'status' => $status
                    ]);
                }
            }
            else {
            }

            return response()->json([
                'success' => true,
                'message' => 'Pergi'
            ]);

        }else{
            $order = PerizinanModel::max('id');
            $order2 = $order + 1;
            $idizin = 'IZIN'.$order2;
            $status = "0";
            PerizinanModel::create([
                'kodeapp' => $kodeapp,
                'id_izin' => $idizin,
                'nis' => request('nis'),
                'keperluan' => $tipe,
                'tipe_penjemput' => request('tipe_penjemput'),
                'nama_penjemput' => $nama,
                'tgl_plg' => request('tgl_pulang'),
                'tgl_kembali' => request('tgl_kembali'),
                'status_kembali' => $status
            ]);

            $pimpinan = PimpinanModel::where('kodeapp',$kodeapp)
                    ->get();

            $isipesan = "Assalamualaikum, Santri \n"."Nama : ".$request->input('nama_santri')." \n"."Keperluan : ".$request->input('keperluan')." \n"."Membutuhkan Persetujuan Jenengan. Terimakasih";

            if (count($pimpinan)>0) {
                foreach ($pimpinan as $row){
                    SmsModel::create([
                        'kodeapp' => $kodeapp,
                        'id_izin' => $idizin,
                        'id_pimpinan' => $row->id_pimpinan,
                        'nohp' => $row->nohp,
                        'isi' => $isipesan,
                        'status' => $status
                    ]);
                    ApproveModel::create([
                        'kodeapp' => $kodeapp,
                        'id_izin' => $idizin,
                        'id_pimpinan' => $row->id_pimpinan,
                        'status' => $status
                    ]);
                }
            }
            else {
            }

            return response()->json([
                'success' => true,
                'message' => 'Pulang'
            ]);
        }
    }

    public function edit($id)
    {
        $izin = PerizinanModel::where('tbizin.id', $id)
                    ->join('tbsantri', 'tbizin.nis' , 'tbsantri.nis')
                    ->select('tbizin.*','tbsantri.photo', 'tbsantri.nama')
                    ->first();
        return $izin;
    }

    public function destroy($id)
    {
        $idizin = PerizinanModel::where('tbizin.id', $id)
                    ->select('tbizin.id_izin')
                    ->first();

        PerizinanModel::where('id_izin', $idizin->id_izin)->delete();
        ApproveModel::where('id_izin', $idizin->id_izin)->delete();
        SmsModel::where('id_izin', $idizin->id_izin)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Izin Deleted'
        ]);
    }

    function fetch(Request $request)
    {
    $kodeapp = Session::get('kodeapp');
     $select = $request->get('select');
     $value = $request->get('value');
     $dependent = 'nama';
     $status = 'status';
     $data = MahromModel::where($select, $value)
       ->get();
     $output = '<option value="">Select '.ucfirst($dependent).'</option>';
     foreach($data as $row)
	     {
	      $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.', '.$row->$status.'</option>';
	     }
     echo $output;
    }

    public function cari(Request $request)
    {
        $kodeapp = Session::get('kodeapp');
        if($request->ajax()) {
            $data = SantriModel::where('nis', 'LIKE', '%'.$request->nis.'%')
                ->where('kodeapp', '=', $kodeapp)
                ->get();
            $output = '';
            $nis = '';
            if (count($data)>0) {
                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                foreach ($data as $row){
                    if($request->nis == ''){
                        $output .= '</ul>';
                    }else{
                        $output .= '<li class="list-group-item">'.$row->nama.'</li>';
                    }
                    $nis = $row->nis;
                }
                $output .= '</ul>';
            }
            else {
                $output .= '<li class="list-group-item">'.'No results'.'</li>';
            }
            return $output;

        }
    }

    public function apiIzin()
    {
        $kodeapp = Session::get('kodeapp');
        $izin = PerizinanModel::where('tbizin.kodeapp',$kodeapp)
            ->join('tbsantri', 'tbizin.nis' , 'tbsantri.nis')
            ->select('tbizin.*','tbsantri.nama as nama_santri')
            ->orderByRaw('tbizin.id ASC')
            // ->orderByRaw('tbizin.nis ASC')
            ->get();

        return DataTables::of($izin)
            ->addColumn('action', function($izin){
                return '<a onclick="cek('. $izin->id .')" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Detail </a> ' .
                    '<a onclick="deleteData('. $izin->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Hapus </a> ' .
                    '<a onclick="pulang('. $izin->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-ok"></i> Kembali </a>';
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function apiApprove($id)
    {
        $kodeapp = Session::get('kodeapp');
        $izin = ApproveModel::where('tbapprove.kodeapp',$kodeapp)
            ->where('tbapprove.id_izin', $id)
            ->join('tbpimpinan', 'tbapprove.id_pimpinan' , 'tbpimpinan.id_pimpinan')
            ->select('tbapprove.*','tbpimpinan.nama')
            ->orderByRaw('tbapprove.id ASC')
            ->get();

        $jmlapprove = ApproveModel::where('tbapprove.kodeapp',$kodeapp)
            ->where('tbapprove.id_izin', $id)
            ->where('tbapprove.status', '0')
            ->count();

        $datalengkap = PerizinanModel::where('tbizin.kodeapp',$kodeapp)
            ->where('tbizin.id_izin', $id)
            ->where('tbizin.approve', '0')
            ->count();

        return view('detailapprove',['data' => $izin, 'jmlapprove' => $jmlapprove, 'datalengkap' => $datalengkap]);
    }

    public function setujui($idapprove, $act)
    {
        $contact = ApproveModel::find($idapprove);
        $contact->update([
            'status' => $act
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Approve Status Updated'
        ]);
    }

    public function datalengkap($idizin)
    {
        PerizinanModel::where('id_izin', $idizin)
                                ->update([
                                    'approve' => '1'
                                ]);

        $izin = PerizinanModel::where('tbizin.id_izin', $idizin)
                            ->join('tbsantri', 'tbizin.nis' , 'tbsantri.nis')
                            ->select('tbizin.*','tbsantri.nama as nama_santri')
                            ->first();

        $kodeapp = Session::get('kodeapp');
        $mahrom = MahromModel::where('kodeapp',$kodeapp)
                    ->where('tbkeluarga.nis', $izin->nis)
                    ->get();

        if($izin->keperluan == "Pergi"){
            $isipesan = "Assalamualaikum, Santri dengan "."Nama ".$izin->nama_santri." izin ".$izin->keperluan." dari jam ".$izin->jam_pergi." sampai jam ".$izin->jam_kembali." dengan dijemput oleh ".$izin->nama_penjemput.". Terimakasih";
        }else{
            $isipesan = "Assalamualaikum, Santri dengan "."Nama ".$izin->nama_santri." izin ".$izin->keperluan." dari tanggal ".$izin->tgl_plg." sampai tanggal ".$izin->tgl_kembali." dengan dijemput oleh ".$izin->nama_penjemput.". Terimakasih";
        }

        if (count($mahrom)>0) {
            foreach ($mahrom as $row){
                SmsModel::create([
                    'kodeapp' => $kodeapp,
                    'id_izin' => $idizin,
                    'id_pimpinan' => $row->id_keluarga,
                    'nohp' => $row->nohp,
                    'isi' => $isipesan,
                    'status' => '0'
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Approve Izin Status Updated'
        ]);
    }

    public function pulang($idizin)
    {
        date_default_timezone_set('Asia/Jakarta');

        $contact = PerizinanModel::find($idizin);

        $keperluan = $contact->keperluan;

        $tglkembali = new Carbon($contact->tgl_kembali);
        $jamkembali = new Carbon($contact->jam_kembali);

        $now = Carbon::now();
        $difference = $tglkembali->diffInDays($now);
        $difference2 = $jamkembali->diffInMinutes($now);

        if($keperluan == "Pulang"){
            if($difference>0){
                if($tglkembali>$now){
                    $telat = "Sudah (Kembali Lebih Awal)";
                }else{
                    $telat = "Sudah (Telat ".$difference." Hari)";
                }
            }else{
                $telat = "Sudah (Tepat Waktu)";
            }
        }else{
            if($difference2>0){
                $telat = "Sudah (Telat ".$difference2." Menit)";
            }else{
                $telat = "Sudah (Tepat Waktu)";
            }
        }

        $contact->update([
            'status_kembali' => $telat
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Pulang Status Updated'
        ]);
    }
}
