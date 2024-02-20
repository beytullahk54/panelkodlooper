<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\tbl_ayarlar;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class TestController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function sifreUret()
    {   
        $randomPassword = Str::random(12); // 12 karakter uzunluğunda bir şifre
        
        return ["sifre"=>$randomPassword,"sifrelenmis"=>Hash::make($randomPassword)];
    }
    
}
