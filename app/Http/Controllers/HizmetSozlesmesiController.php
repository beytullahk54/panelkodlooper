<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\tbl_ayarlar;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class HizmetSozlesmesiController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function indexBayi(User $model)
    {
        return view('pages.bayi.hizmetSozlesmesi');
    }

    public function get()
    {
        return tbl_ayarlar::where("db_key","=","hizmet_sozlemesi")->first();
    }
}
