<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard');
    }

    public function takvim()
    {
        return view("pages.takvim");
    }

    public function onlineRezervasyon()
    {
        return view("pages.onlineRezervasyon");
    }

    public function hizmetler()
    {
        return view("pages.hizmetler");
    }

    public function personel()
    {
        return view("pages.personel");
    }

    public function istatistik()
    {
        return view("pages.istatistik");
    }

    public function destek()
    {
        return view("pages.destek");
    }

    public function musteriler()
    {
        return view("pages.musteriler");
    }
}
