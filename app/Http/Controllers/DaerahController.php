<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DaerahModel;
use Yajra\DataTables\DataTables;
use Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class DaerahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('daerah');
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
        DaerahModel::create([
            'kodeapp' => $kodeapp,
            'nama_daerah' => request('nama_daerah')
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Daerah Created'
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
        $daerah = DaerahModel::findOrFail($id);
        return $daerah;
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
        $contact = DaerahModel::find($id);
        $contact->update([
            'kodeapp' => $kodeapp,
            'nama_daerah' => request('nama_daerah')
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Daerah Updated'
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
        DaerahModel::where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Daerah Deleted'
        ]);
    }

    public function apiDaerah()
    {
        $kodeapp = Session::get('kodeapp');
        $daerah = DaerahModel::where('tbdaerah.kodeapp',$kodeapp)->get();

        return DataTables::of($daerah)
            ->addColumn('action', function($daerah){
                return '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a> ' .
                    '<a onclick="editForm('. $daerah->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a> ' .
                    '<a onclick="deleteData('. $daerah->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }
}
