<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PimpinanModel;
use App\JabatanModel;
use Yajra\DataTables\DataTables;
use Validator;
use Illuminate\Support\Facades\Session;

class PimpinanController extends Controller
{

    public function index()
    {
        $kodeapp = Session::get('kodeapp');
        $jbt = JabatanModel::where('kodeapp',$kodeapp)
                    ->orderByRaw('nama_jabatan ASC')
                    ->get();
        return view('pimpinan',['data' => $jbt]);
    }

    public function store(Request $request)
    {
    	$kodeapp = Session::get('kodeapp');
    	$order = PimpinanModel::max('id');
    	$order2 = $order + 1;
    	$idp = 'PIM'.$order2;
        PimpinanModel::create([
		    'kodeapp' => $kodeapp,
		    'id_pimpinan' => $idp,
		    'nama' => request('nama'),
		    'jabatan' => request('jabatan'),
		    'nohp' => request('nohp')
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
    public function show($id_admin)
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
        $pimpinan = PimpinanModel::findOrFail($id);
        return $pimpinan;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $input = $request->all();
        $contact = PimpinanModel::find($id);
        $contact->update($input);
        return response()->json([
            'success' => true,
            'message' => 'Contact Updated'
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
        PimpinanModel::where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Pimpinan Deleted'
        ]);
    }
    public function apiPimpinan()
    {
    	$kodeapp = Session::get('kodeapp');
        $pimpinan = PimpinanModel::where('kodeapp',$kodeapp)->get();

        return DataTables::of($pimpinan)
            ->addColumn('action', function($pimpinan){
                return '<a onclick="editForm('. $pimpinan->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a> ' .
                    '<a onclick="deleteData('. $pimpinan->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }
}
