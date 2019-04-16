<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KamarModel;
use Yajra\DataTables\DataTables;
use Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kamar');
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
        KamarModel::create([
            'kodeapp' => $kodeapp,
            'nama_kamar' => request('nama_kamar')
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Kamar Created'
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
        $mahrom = KamarModel::findOrFail($id);
        return $mahrom;
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
        $contact = KamarModel::find($id);
        $contact->update([
            'kodeapp' => $kodeapp,
            'nama_kamar' => request('nama_kamar')
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Kamar Updated'
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
        KamarModel::where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Kamar Deleted'
        ]);
    }

    public function apiKamar()
    {
        $kodeapp = Session::get('kodeapp');
        $kamar = KamarModel::where('tbkamar.kodeapp',$kodeapp)->get();

        return DataTables::of($kamar)
            ->addColumn('action', function($kamar){
                return '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a> ' .
                    '<a onclick="editForm('. $kamar->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a> ' .
                    '<a onclick="deleteData('. $kamar->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }
}
