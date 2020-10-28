<?php

namespace App\Http\Controllers;

use App\provinsi;
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
        $param['dataProvinsi'] = provinsi::all();
        return view('register',with($param));
    }

    public function post_register(Request $request)
    {

    }
}
