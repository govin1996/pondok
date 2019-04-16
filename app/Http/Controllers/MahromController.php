<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MahromModel;
use App\SantriModel;
use Yajra\DataTables\DataTables;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class MahromController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mahrom');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kodeapp = Session::get('kodeapp');
        $order = MahromModel::max('id');
        $order2 = $order + 1;
        $idp = 'IK-'.$order2;
        MahromModel::create([
            'kodeapp' => $kodeapp,
            'id_keluarga' => $idp,
            'nis' => request('nis'),
            'nama' => request('nama_mahrom'),
            'nohp' => request('nohp'),
            'status' => request('status')
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Pimpinan Created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mahrom = MahromModel::findOrFail($id);
        return $mahrom;
    }

    public function cari(Request $request)
    {
        $kodeapp = Session::get('kodeapp');
        // check if ajax request is coming or not
        if($request->ajax()) {
            // select country name from database
            $data = SantriModel::where('nis', '=', $request->nis)
                ->where('kodeapp', '=', $kodeapp)
                ->get();
            // declare an empty array for output
            $output = '';
            // if searched countries count is larager than zero
            if (count($data)>0) {
                // concatenate output to the array
                // $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                // loop through the result array
                foreach ($data as $row){
                    // concatenate output to the array
                    $output = $row->nama;
                }
                // end of output
                // $output .= '</ul>';
            }
            else {
                // if there's no matching results according to the input
                // $output .= '<li class="list-group-item">'.'No results'.'</li>';
            }
            // return output result array
            return $output;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kodeapp = Session::get('kodeapp');
        $contact = MahromModel::find($id);
        $contact->update([
            'kodeapp' => $kodeapp,
            'nama' => request('nama_mahrom'),
            'nohp' => request('nohp'),
            'status' => request('status')
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Mahrom Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MahromModel::where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Mahrom Deleted'
        ]);
    }

    public function apiMahrom()
    {
        $kodeapp = Session::get('kodeapp');
        $mahrom = MahromModel::where('tbkeluarga.kodeapp',$kodeapp)
            ->join('tbsantri', 'tbkeluarga.nis' , 'tbsantri.nis')
            ->select('tbkeluarga.id','tbkeluarga.kodeapp','tbkeluarga.id_keluarga','tbkeluarga.nis',DB::raw('GROUP_CONCAT(DISTINCT(tbkeluarga.nama)) as nama_mahrom'),'tbkeluarga.nohp','tbkeluarga.status','tbsantri.nama as nama_santri')
            ->groupBy('tbkeluarga.nis')
            ->orderByRaw('tbkeluarga.nis ASC')
            ->orderByRaw('tbkeluarga.id ASC')
            ->get();

        return DataTables::of($mahrom)
            ->addColumn('action', function($mahrom){
                return '<a href="'.url('/mahromdetail/'. $mahrom->nis .'').'" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>';
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

}
