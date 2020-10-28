<?php

namespace App\Http\Controllers;

use App\model\kotaModel;
use App\model\provinsiModel;
use App\model\userModel;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function post_login(Request $request)
    {

    }

    public function register()
    {
        $param['dataProvinsi'] = ProvinsiModel::all();
        $param['dataKota'] = kotaModel::all();
        return view('register',with($param));
    }

    public function post_register(Request $request)
    {
        $alamat = $request->inpAlamat;
        $namadpn = $request->inpNamaDepan;
        $namabel = $request->inpNamaBelakang;
        $nohp = $request->inpNoHp;
        $user = $request->inpNama;
        $email = $request->inpEmail;
        $prov = $request->prov;
        $kota = $request->kota;
        $alamat = $request->inpAlamat;
        $pass = $request->inpPass;
        $cpass = $request->incpConPass;


        if($request->btnreg){
            if($pass == $cpass){
                dd('sama');
                $data = new userModel();
                $data->nama_depan = $namadpn;
                $data->nama_belakang = $namabel;
                $data->email = $email;
                $data->username = $user;
                $data->password = $pass;
                $data->alamat = $alamat;
                $data->kota = $kota;
                $data->no_telp = $nohp;
                $data->save();

            }

        }else if($request->btnlogin){
            dd("ini login");
        }
    }
}
