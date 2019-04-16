<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JabatanModel;
use Yajra\DataTables\DataTables;
use Validator;
use Illuminate\Support\Facades\Session;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jabatan');
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
        JabatanModel::create([
            'kodeapp' => $kodeapp,
            'nama_jabatan' => request('nama_jabatan')
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
        $jbt = JabatanModel::findOrFail($id);
        return $jbt;
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
        $input = $request->all();
        $contact = JabatanModel::find($id);
        $contact->update($input);
        return response()->json([
            'success' => true,
            'message' => 'Jabatan Updated'
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
        JabatanModel::where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Jabatan Deleted'
        ]);
    }

    public function apiJabatan()
    {
        $kodeapp = Session::get('kodeapp');
        $jabatan = JabatanModel::where('kodeapp',$kodeapp)->get();

        return DataTables::of($jabatan)
            ->addColumn('action', function($jabatan){
                return '<a onclick="editForm('. $jabatan->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a> ' .
                    '<a onclick="deleteData('. $jabatan->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }
}
