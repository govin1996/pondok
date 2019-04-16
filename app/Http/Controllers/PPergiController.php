<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PeringatanPergiModel;
use Yajra\DataTables\DataTables;
use Validator;
use Illuminate\Support\Facades\Session;

class PPergiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ppergi');
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
        PeringatanPergiModel::create([
            'kodeapp' => $kodeapp,
            'waktu' => request('waktu')
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Peringatan Pergi Created'
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PeringatanPergiModel::where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Peringatan Pergi Deleted'
        ]);
    }

    public function apiPPergi()
    {
        $kodeapp = Session::get('kodeapp');
        $ppergi = PeringatanPergiModel::where('kodeapp',$kodeapp)->get();

        return DataTables::of($ppergi)
            ->addColumn('action', function($ppergi){
                return '<a onclick="deleteData('. $ppergi->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Hapus </a>';
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }
}
