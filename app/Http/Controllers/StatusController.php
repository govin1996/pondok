<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StatusModel;
use App\KamarModel;
use Yajra\DataTables\DataTables;
use Validator;
use Illuminate\Support\Facades\Session;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('status');
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
        StatusModel::create([
            'kodeapp' => $kodeapp,
            'nama_status' => request('nama_status')
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Status Created'
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
        $jbt = StatusModel::findOrFail($id);
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
        $contact = StatusModel::find($id);
        $contact->update($input);
        return response()->json([
            'success' => true,
            'message' => 'Status Updated'
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
        StatusModel::where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Status Deleted'
        ]);
    }

    public function apiStatus()
    {
        $kodeapp = Session::get('kodeapp');
        $sts = StatusModel::where('kodeapp',$kodeapp)->get();

        return DataTables::of($sts)
            ->addColumn('action', function($sts){
                return '<a onclick="editForm('. $sts->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a> ' .
                    '<a onclick="deleteData('. $sts->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }
}
