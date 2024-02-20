<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Route;
use App\Models\Role;
use App\Models\role_user;
use App\Models\randevu_baglanti;
use App\Models\randevu_hizmet;
use App\Models\randevu_hizmet_kategori;
use App\Models\firma;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class OnlineRezervasyonController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       return view('admin.onlineRezervasyon.index');
    }
    
    public function get(Request $request)
    {
        if($request->id)
        {
            $data = randevu_baglanti::where('firma_id','=',Auth::User()->firma_id)->where('id','=',$request->id)->first();
        }else{
            $data = randevu_baglanti::where('firma_id','=',Auth::User()->firma_id)->get();
        }
        return ['status'=>true,'data'=>$data];
    }
    
    public function hizmetGet(Request $request)
    {
        if($request->id)
        {
            $data = randevu_hizmet::where('firma_id','=',Auth::User()->firma_id)->where('id','=',$request->id)->first();
        }else{
            $data = randevu_hizmet::where('firma_id','=',Auth::User()->firma_id)->get();
        }
        return ['status'=>true,'data'=>$data];
    }
    
    public function add(Request $request)
    {
        
        if(randevu_baglanti::where('baglanti_adi','=',$request->baglanti_adi)->where('firma_id','=',Auth::User()->firma_id)->first()){
            return ['status'=>false,'message'=>'Ekleme işlemi başarısız oldu.'];
        }else{
            $baglantiAdd = new randevu_baglanti();
            $baglantiAdd->baglanti_adi = $request->baglanti_adi;   
            $baglantiAdd->baglanti_hizmet_id = $request->baglanti_hizmet_id;
            $baglantiAdd->firma_id = Auth::User()->firma_id;
            $baglantiAdd->baglanti_tipi = $request->baglanti_tipi;
            $baglantiAdd->baglanti_hizmet_kategori_id = $request->baglanti_hizmet_kategori_id;
            $baglantiAdd->tema = $request->tema;
            $baglantiAdd->baglanti_url = $request->baglanti_url;
            if($baglantiAdd->save()){
                return ['status'=>true,'data'=>$baglantiAdd->id,'baglanti'=>$baglantiAdd,'message'=>'Başarıyla eklendi'];
            }else{
                return ['status'=>false,'data'=>null,'message'=>'Bu bağlantının benzeri bulunuyor.'];
            }
        }
    }
    
    public function update(Request $request)
    {
        $baglantiUpdate = randevu_baglanti::where('id','=',$request->id)->first();
        $baglantiUpdate->baglanti_adi = $request->baglanti_adi;   
        $baglantiUpdate->baglanti_hizmet_id = $request->baglanti_hizmet_id;
        $baglantiUpdate->firma_id = Auth::User()->firma_id;
        $baglantiUpdate->baglanti_tipi = $request->baglanti_tipi;
        $baglantiUpdate->baglanti_hizmet_kategori_id = $request->baglanti_hizmet_kategori_id;
        $baglantiUpdate->tema = $request->tema;
        $baglantiUpdate->baglanti_url = $request->baglanti_url;
        if($baglantiUpdate->save()){
            return ['status'=>true,'data'=>$baglantiUpdate->id,'baglanti'=>$baglantiUpdate,'message'=>'Başarıyla eklendi'];
        }else{
            return ['status'=>false,'data'=>null,'message'=>'Ekleme işlemi başarısız oldu.'];
        }
    }

    public function api(Request $request,$id=null)
    {
        if($id==null)
        {
            $data = randevu_hizmet_kategori::where('firma_id','=',Auth::User()->firma_id)->get();
        }else{
            $data = randevu_hizmet_kategori::where('firma_id','=',Auth::User()->firma_id)->where('id','=',$id)->first();
        }
        return ['status'=>true,'data'=>$data];
    }
    public function delete(Request $request)
    {
        $remove = randevu_baglanti::where('id','=',$request->id)->delete();
        
        if($remove){
            return ['status'=>true,'message'=>'Bağlantı silinmiştir.'];
        }else{
            return ['status'=>false,'message'=>'Bağlantı silme işlemi başarısız oldu.'];
        }
    }
}
