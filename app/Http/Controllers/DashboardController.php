<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\tbl_ayarlar;
use App\Models\tbl_katilimci;
use App\Models\tbl_bakiye;
use App\Models\tbl_egitim;
use App\Models\tbl_firma;
use App\Models\tbl_universite;
use App\Models\tbl_destek;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class DashboardController extends Controller
{
    private $globalName;

    // Constructor (kurucu) metodunda global ismi belirleme
    public function __construct()
    {
        $this->globalName = "Dashboard";
    }

    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('dashboard');
    }
    
    public function get(Request $request)
    {
        if(Auth::User()->admin==1){

            $tbl = tbl_katilimci::where('db_firma_id',"=",Auth::User()->firma_id)->where("firma_durum","=","onaylandi")->count();

            $onay_bekleyen_katilimci        = tbl_katilimci::count()-tbl_katilimci::where("db_katilimci_durum","like","%"."Onaylandı"."%")->count();
            $onaylanan_katilimci            = tbl_katilimci::where("db_katilimci_durum","like","%"."Onaylandı"."%")->count();
            $toplam_katilimci               = tbl_katilimci::count();
            $onay_bekleyen_bayiler          = tbl_firma::where("firma_durum","=","onay_bekliyor")->count();
            $onaylanan_bayiler              = tbl_firma::where("firma_durum","=","onaylandi")->count();
            $toplam_bayiler                 = tbl_firma::count();
            $aktif_universite               = tbl_universite::where("db_durum","=","aktif")->count();
            $aktif_egitim                   = tbl_egitim::where('db_basvuru_durumu',"=","acik")->count();
            $toplam_egitim                  = tbl_egitim::count();
            $aktif_destek_talepleri         = tbl_destek::where('db_destek_durumu',"!=","tamamlandi")->orWhere('db_destek_durumu')->where("db_firma_id","=",Auth::User()->firma_id)->count();
            $tamamlanan_destek_talepleri    = tbl_destek::where('db_destek_durumu',"=","tamamlandi")->count();
            $toplam_destek_talepleri        = tbl_destek::count();

            $bugun = Carbon::now()->setTimezone('Europe/Istanbul');
            $yarin = Carbon::now()->setTimezone('Europe/Istanbul')->addDay(1);
            $startOfWeek = Carbon::now()->setTimezone('Europe/Istanbul')->startOfWeek();
            $endOfWeek = Carbon::now()->setTimezone('Europe/Istanbul')->endOfWeek();
            $ayin_baslangici = Carbon::now()->setTimezone('Europe/Istanbul')->startOfMonth();

            $tbl_bakiye_odeme_onay_bekliyor = tbl_bakiye::where('db_odeme_durumu','=',"onay_bekliyor")->get();
            $tbl_bakiye_odeme_onay_bekliyor_toplam=$tbl_bakiye_odeme_onay_bekliyor->sum("db_odeme_miktari");

            $tbl_bakiye_odeme_mevcut_bakiye = tbl_firma::get();
            $tbl_bakiye_odeme_mevcut_bakiye_toplam=$tbl_bakiye_odeme_mevcut_bakiye->sum("bakiye");

            $tbl_bakiye_ciro = tbl_bakiye::where('db_odeme_durumu','=',"odeme_onaylandi")->orWhere('db_odeme_durumu','=',"kredi_karti_onaylandi")->get();;
            $tbl_bakiye_ciro_toplam=$tbl_bakiye_ciro->sum("db_odeme_miktari");

            $tbl_bugun_yuklenen_bakiye_ciro = tbl_bakiye::whereDate("created_at","=",$bugun)->where('db_odeme_durumu','=',"odeme_onaylandi")->orWhere('db_odeme_durumu','=',"kredi_karti_onaylandi")->get();
            $tbl_bugun_yuklenen_bakiye_ciro_toplam = tbl_bakiye::whereDate("created_at", "=", $bugun)
            ->where(function ($query) {
                $query->where('db_odeme_durumu', '=', "odeme_onaylandi")
                    ->orWhere('db_odeme_durumu', '=', "kredi_karti_onaylandi");
            })
            ->sum("db_odeme_miktari");
            $startOfWeek = $startOfWeek->startOfWeek(); // Bu haftanın başlangıcı (Pazartesi)
            $ayin_baslangici = $ayin_baslangici->startOfMonth()->addDay();

            $tbl_buhafta_yuklenen_bakiye_ciro_toplam = tbl_bakiye::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->where(function ($query) {
                $query->where('db_odeme_durumu', '=', "odeme_onaylandi")
                    ->orWhere('db_odeme_durumu', '=', "kredi_karti_onaylandi");
            })
            ->sum("db_odeme_miktari");
            /*$tbl_buhafta_yuklenen_bakiye_ciro = tbl_bakiye::whereBetween('created_at', [$startOfWeek, $endOfWeek])->where('db_odeme_durumu','=',"odeme_onaylandi")->orWhere('db_odeme_durumu','=',"kredi_karti_onaylandi")->get();;
            $tbl_buhafta_yuklenen_bakiye_ciro_toplam=$tbl_buhafta_yuklenen_bakiye_ciro->sum("db_odeme_miktari");*/
            


            $tbl_buay_yuklenen_bakiye_ciro_toplam = tbl_bakiye::whereBetween('created_at', [$ayin_baslangici, $endOfWeek])
            ->where(function ($query) {
                $query->where('db_odeme_durumu', '=', "odeme_onaylandi")
                    ->orWhere('db_odeme_durumu', '=', "kredi_karti_onaylandi");
            })
            ->sum("db_odeme_miktari");

            /*$tbl_buay_yuklenen_bakiye_ciro = tbl_bakiye::whereBetween('created_at', [$ayin_baslangici, $endOfWeek])->where('db_odeme_durumu','=',"odeme_onaylandi")->orWhere('db_odeme_durumu','=',"kredi_karti_onaylandi")->get();;
            $tbl_buay_yuklenen_bakiye_ciro_toplam=$tbl_buay_yuklenen_bakiye_ciro->sum("db_odeme_miktari");*/

            
            $firma = Auth::User()->firma;
            return [
                    "bugun"                                    => $bugun,
                    "startOfWeek"                              => $startOfWeek,
                    "endOfWeek"                                => $endOfWeek,
                    "ayin_baslangici"                          => $ayin_baslangici,
                    "tbl_bakiye_odeme_onay_bekliyor"           =>  $tbl_bakiye_odeme_onay_bekliyor_toplam,
                    "tbl_bakiye_mevcut"                        =>  $tbl_bakiye_odeme_mevcut_bakiye_toplam,
                    "tbl_bakiye_ciro"                          =>  $tbl_bakiye_ciro_toplam,
                    "tbl_bugun_yuklenen_bakiye_ciro_toplam"    =>  $tbl_bugun_yuklenen_bakiye_ciro_toplam,
                    "tbl_buhafta_yuklenen_bakiye_ciro_toplam"  =>  $tbl_buhafta_yuklenen_bakiye_ciro_toplam,
                    "tbl_buay_yuklenen_bakiye_ciro_toplam"     =>  $tbl_buay_yuklenen_bakiye_ciro_toplam,
                    "tbl_test"                                 =>  $tbl,
                    "firma"                                    =>  $firma,
                    "onay_bekleyen_katilim"                    =>  $onay_bekleyen_katilimci,
                    "onaylanan_katilimci"                      =>  $onaylanan_katilimci,
                    "onay_bekleyen_bayiler"                    =>  $onay_bekleyen_bayiler,
                    "onaylanan_bayiler"                        =>  $onaylanan_bayiler,
                    "toplam_bayiler"                           =>  $toplam_bayiler,
                    "aktif_egitim"                             =>  $aktif_egitim,
                    "toplam_egitim"                            =>  $toplam_egitim,
                    "aktif_universite"                         =>  $aktif_universite,
                    "toplam_katilimci"                         =>  $toplam_katilimci,
                    "aktif_destek_talepleri"                   =>  $aktif_destek_talepleri,
                    "tamamlanan_destek_talepleri"              =>  $tamamlanan_destek_talepleri,
                    "toplam_destek_talepleri"                  =>  $toplam_destek_talepleri,
                ];
        }else{    
            $tbl = tbl_katilimci::where('db_firma_id',"=",Auth::User()->firma_id)->where("firma_durum","=","onaylandi")->count();

            $toplam_katilimci              = tbl_katilimci::where('db_firma_id',"=",Auth::User()->firma_id)->count();
            $onaylanan_katilimci           = tbl_katilimci::where('db_firma_id',"=",Auth::User()->firma_id)->where("db_katilimci_durum","like","%"."Onaylandı"."%")->count();
            $onay_bekleyen_katilimci       = $toplam_katilimci - $onaylanan_katilimci;
            $aktif_universite              = tbl_universite::where("db_durum","=","aktif")->count();
            $aktif_egitim                  = tbl_egitim::where('db_basvuru_durumu',"=","acik")->count();
            $toplam_egitim                 = tbl_egitim::count();
            $aktif_destek_talepleri        = tbl_destek::where('db_destek_durumu',"!=","tamamlandi")->where("db_firma_id","=",Auth::User()->firma_id)->count();
            $tamamlanan_destek_talepleri   = tbl_destek::where('db_destek_durumu',"=","tamamlandi")->where('db_firma_id',"=",Auth::User()->firma_id)->count();
            $toplam_destek_talepleri = tbl_destek::where('db_firma_id',"=",Auth::User()->firma_id)->count();

            $firma = Auth::User()->firma;
            return [
                    "tbl_test"                          =>  $tbl,
                    "firma"                             =>  $firma,
                    "onay_bekleyen_katilim"             =>  $onay_bekleyen_katilimci,
                    "onaylanan_katilimci"               =>  $onaylanan_katilimci,
                    "aktif_egitim"                      =>  $aktif_egitim,
                    "toplam_egitim"                     =>  $toplam_egitim,
                    "aktif_universite"                  =>  $aktif_universite,
                    "toplam_katilimci"                  =>  $toplam_katilimci,
                    "aktif_destek_talepleri"            =>  $aktif_destek_talepleri,
                    "tamamlanan_destek_talepleri"       =>  $tamamlanan_destek_talepleri,
                    "toplam_destek_talepleri"           =>  $toplam_destek_talepleri,
                ];
        }
    }
   
    //BAYİ

    public function indexBayi(User $model)
    {
        return view('pages.bayi.universite');
    }
    
}
