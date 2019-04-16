<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\login;
use App\PimpinanModel;
use App\SantriModel;
use App\MahromModel;
use App\PerizinanModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{

    public function dashboard(){
    	if(!Session::get('login')){
            return redirect('login');
        }
        else{
            $kodeapp = Session::get('kodeapp');
            $pimpinan = PimpinanModel::where('kodeapp',$kodeapp)
                    ->count();
            $santri = SantriModel::where('kodeapp',$kodeapp)
                    ->count();
            $mahrom = MahromModel::where('kodeapp',$kodeapp)
                    ->count();
            $izin = PerizinanModel::where('kodeapp',$kodeapp)
                    ->count();
            return view('dashboard', ['pimpinan' => $pimpinan, 'santri' => $santri, 'mahrom' => $mahrom, 'izin' => $izin]);
        }
    }

    public function login(){
        if(!Session::get('login')){
            return view('login2');
        }
        else{
            return redirect('dashboard');
        }
    }

    public function loginPost(Request $request){
        $user = $request->user;
        $password = $request->password;

        $data = login::where('user',$user)->first();
        if($data >= '0'){
            if(Hash::check($password,$data->password)) {
                Session::put('kodeapp', $data->kodeapp);
                Session::put('nama_pondok', $data->nama_pondok);
                Session::put('user', $data->user);
                Session::put('password', $data->password);
                Session::put('login', TRUE);
                return redirect('dashboard');
            }
            else{
                return redirect('login')->with('alert','Password atau Email, Salah !'.Hash::check($password,$data->password));
            }
        }
        else{
            return redirect('login')->with('alert','Password atau Email, Salah!');
        }
    }
    public function logout(){
        Session::flush();
        return redirect('login')->with('alert','Kamu sudah logout');
    }
}
