<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SantriModel;
use App\DaerahModel;
use App\KamarModel;
use App\MahromModel;
use Yajra\DataTables\DataTables;
use Validator;
use Illuminate\Support\Facades\Session;

class SantriController extends Controller
{
	public function index()
    {
        $daerah = DaerahModel::all();
        $kamar = KamarModel::all();
        return view('santri',['kamar' => $kamar],['daerah' => $daerah]);
    }

    public function store(Request $request)
    {
    	$kodeapp = Session::get('kodeapp');
        $input = $request->photo;
        
        $input = null;

        if ($request->hasFile('photo')) {
            $input = '/upload/photo/' . str_slug(request('nis'), '-') . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('/upload/photo'), $input);
        }

        SantriModel::create([
		    'kodeapp' => $kodeapp,
		    'nis' => request('nis'),
		    'nama' => request('nama'),
            'daerah' => request('daerah'),
		    'kamar' => request('kamar'),
		    'tempat_lahir' => request('tempat_lahir'),
		    'tanggal_lahir' => request('tanggal_lahir'),
		    'status' => request('status'),
            'photo' => $input
		]);
        return response()->json([
            'success' => true,
            'message' => 'Pimpinan Created'
        ]);
    }

    public function edit($id)
    {
        $santri = SantriModel::findOrFail($id);
        return $santri;
    }

    public function update(Request $request,$id)
    {
        $input = $request->all();
        $contact = SantriModel::find($id);
        $input['photo'] = $contact->photo;
        if ($request->hasFile('photo')){
            if (!$contact->photo == NULL){
                unlink(public_path($contact->photo));
            }
            $input['photo'] = '/upload/photo/'.str_slug($input['nis'], '-').'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('/upload/photo/'), $input['photo']);
        }
        $contact->update($input);
        return response()->json([
            'success' => true,
            'message' => 'Santri Updated'
        ]);
    }

    public function destroy(Request $request,$id)
    {
        $input = $request->all();
        $contact = SantriModel::find($id);

        if (!$contact->photo == NULL){
            unlink(public_path($contact->photo));
        }

        MahromModel::where('nis', $contact->nis)->delete();
        SantriModel::where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Santri Deleted'
        ]);
    }

	public function apiSantri()
	{
		$kodeapp = Session::get('kodeapp');
	    $santri = SantriModel::where('kodeapp',$kodeapp)
                ->get();

	    return DataTables::of($santri)
            ->addColumn('photo', function($santri){
                if ($santri->photo == NULL){
                    return 'No Image';
                }
                return '<img class="rounded-square" width="50" height="50" src="'. url($santri->photo) .'" alt="">';
            })
	        ->addColumn('action', function($santri){
	            return '<a onclick="editForm('. $santri->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a> ' .
	                '<a onclick="deleteData('. $santri->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>';
	        })
	        ->rawColumns(['photo','action'])
	        ->addIndexColumn()
	        ->make(true);
	}
}
