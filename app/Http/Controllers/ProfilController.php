<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Auth;

class ProfilController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('pages.bayi.profil');
    }
    public function yeni(User $model)
    {
        return view('yeni');
    }
    public function get(User $model)
    {
        return ["data"=>Auth::User()->firma,"user"=>Auth::User()];
    }
}
