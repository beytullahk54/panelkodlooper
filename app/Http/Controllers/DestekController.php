<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\tbl_firma;
use App\Models\tbl_destek;
use App\Models\tbl_destek_cevaplar;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class DestekController extends Controller
{
    private $globalName;

    // Constructor (kurucu) metodunda global ismi belirleme
    public function __construct()
    {
        $this->globalName = "Destek";
    }

    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('pages.admin.destek');
    }
    
    public function detay($id)
    {
        return view('pages.admin.destekDetay')->with("id",$id);
    }
    
    public function get(Request $request)
    {

        $data = tbl_destek::query();

        if ($request->filled('seciliBayi')) {
            $data->where('db_firma_id','=',$request->seciliBayi);
        }

        if($request->durum=="cevaplananlar")
        {
            $data->where('db_destek_durumu',"=","cevaplanandi")->orWhere('db_destek_durumu');
        }
        if($request->durum=="bekleyenler")
        {
            $data->where('db_destek_durumu',"!=","tamamlandi")->orWhere('db_destek_durumu');
        }
        if($request->durum=="tamamlananlar")
        {
            $data->where('db_destek_durumu',"=","tamamlandi");
        }

        $data = $data->orderBy('id',"desc")->with("firma")->with("firma")->paginate(10);
        return ["data"=>$data];
    }
    public function bayiGet()
    {
        return ["data"=>tbl_firma::get()];
    }

    public function getDetay(Request $request)
    {
        $data= tbl_destek::where("id","=",$request->id)->first();
        $data_mesajlar= tbl_destek_cevaplar::where("db_destek_id","=",$request->id)->orderBy('id',"desc")->get();
        return ["data"=>$data,"data_mesajlar"=>$data_mesajlar];
    }

    public function getFiltrele(Request $request)
    {
        return $request->all();
        $data= tbl_destek::paginate(10);
        return ["data"=>$data];
    }
    public function create(Request $request)
    {
        try {
            //return $request->all();
            $katilimci_create = new tbl_destek();
            $katilimci_create->db_destek_konu = $request->db_destek_konu;
            $katilimci_create->db_destek_aciklama = $request->db_destek_aciklama;
            $katilimci_create->db_firma_id = $request->db_firma_id;
            $katilimci_create->db_destek_durumu = "acik";
            
            
            if($katilimci_create->save()){
                $tbl_firma = tbl_firma::where("id","=",$request->db_firma_id)->first();
                
                return response()->json(['message' => $this->globalName.' başarıyla gönderildi',"status"=>true], 200);
            }else{
                return response()->json(['message' => $this->globalName.' ekleme işlemi başarısız',"status"=>false], 200);
            }
        } catch (\Exception $e) {

            debugSave( $e->getMessage());
            // Hata durumunda buraya düşeriz
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function update(Request $request)
    {   
        try {
            //return $request->all();
            $katilimci = tbl_destek::find($request->id);
            $katilimci->db_destek_konu = $request->db_destek_konu;
            $katilimci->db_destek_aciklama = $request->db_destek_aciklama;
            
            if($katilimci->save()){
                return response()->json(['message' => $this->globalName.' başarıyla güncellendi',"status"=>true], 200);
            }else{
                return response()->json(['message' => $this->globalName.' ekleme işlemi başarısız',"status"=>false], 200);
            }
        } catch (\Exception $e) {
            // Hata durumunda buraya düşeriz

            debugSave( $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function islemGuncelle(Request $request)
    {   
        try {
            //return $request->all();
            $katilimci = tbl_destek::find($request->data['id']);
            $katilimci->db_destek_durumu = $request->islem;
            
            if($katilimci->save()){
                return response()->json(['message' => $this->globalName.' başarıyla güncellendi',"status"=>true], 200);
            }else{
                return response()->json(['message' => $this->globalName.' ekleme işlemi başarısız',"status"=>false], 200);
            }
        } catch (\Exception $e) {
            // Hata durumunda buraya düşeriz

            debugSave( $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function delete(Request $request)
    {
        //$data = katilimcilar::get();
        try {
            $katilimci = tbl_destek::find($request->data['id']);
            if($katilimci->delete()){
                return response()->json(['message' => $this->globalName.' silme işlemi başarılı',"status"=>true], 200); 
            }
        } catch (\Exception $e) {

            debugSave( $e->getMessage());
            // Hata durumunda buraya düşeriz
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function storeDetay(Request $request)
    {
        try {
            //return $request->all();
            $destek_create = new tbl_destek_cevaplar();
            $destek_create->db_destek_id = $request->id;
            $destek_create->db_destek_user_id = Auth::User()->id;
            $destek_create->db_destek_gonderen_tipi = "yonetici";
            $destek_create->db_destek_mesaj = $request->mesaj;
            $destek_create->db_destek_dosya = $request->db_destek_dosya;

            if($destek_create->save()){
                
                $destek_create = tbl_destek::where("id","=",$request->id)->first();
                $destek_create->db_destek_durumu = "cevaplandi";
                $destek_create->save();
                $tbl_firma = tbl_firma::where("id","=",$destek_create->db_firma_id)->first();
                

                return response()->json(['message' => $this->globalName.' başarıyla cevaplandı',"status"=>true], 200);
            }else{
                return response()->json(['message' => $this->globalName.' ekleme işlemi başarısız',"status"=>false], 200);
            }
        } catch (\Exception $e) {

            debugSave( $e->getMessage());
            // Hata durumunda buraya düşeriz
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function onaylaDetay(Request $request)
    {
        try {
            //return $request->all();
            $destek_create = tbl_destek::where("id","=",$request->id)->first();
            $destek_create->db_destek_durumu = "tamamlandi";

            if($destek_create->save()){
                
                return response()->json(['message' => $this->globalName.' durumunuz başarıyla değiştirilmiştir.',"status"=>true], 200);
            }else{
                return response()->json(['message' => $this->globalName.' işlem başarısız',"status"=>false], 200);
            }
        } catch (\Exception $e) {

            debugSave( $e->getMessage());
            // Hata durumunda buraya düşeriz
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    //BAYİ


    public function indexBayi(User $model)
    {
        return view('pages.bayi.destek');
    }
    
    public function getBayi(Request $request)
    {

        if($request->durum=="bekleyenler")
        {
            $data= tbl_destek::where('db_destek_durumu',"!=","tamamlandi")->where("db_firma_id","=",Auth::User()->firma_id)->orderBy('id',"desc")->paginate(10);
        }
        if($request->durum=="tamamlananlar")
        {
            $data= tbl_destek::where('db_destek_durumu',"=","tamamlandi")->where("db_firma_id","=",Auth::User()->firma_id)->orderBy('id',"desc")->paginate(10);
        }
        return ["data"=>$data];
    }
    
    public function detayBayi($id)
    {
        return view('pages.bayi.destekDetay')->with("id",$id);
    }
    public function createBayi(Request $request)
    {
        try {
            //return $request->all();
            $katilimci_create = new tbl_destek();
            $katilimci_create->db_destek_konu = $request->db_destek_konu;
            $katilimci_create->db_destek_aciklama = $request->db_destek_aciklama;
            $katilimci_create->db_firma_id = Auth::User()->firma_id;
            $katilimci_create->db_destek_durumu = "acik";
            $katilimci_create->db_gorsel = $request->destekGorsel;
            
            if($katilimci_create->save()){
                $tbl_firma = tbl_firma::where("id","=",$katilimci_create->db_firma_id)->first();

                return response()->json(['message' => $this->globalName.' başarıyla gönderildi',"status"=>true], 200);
            }else{
                return response()->json(['message' => $this->globalName.' ekleme işlemi başarısız',"status"=>false], 200);
            }
        } catch (\Exception $e) {

            debugSave( $e->getMessage());
            // Hata durumunda buraya düşeriz
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function getDetayBayi(Request $request)
    {
        $data= tbl_destek::where("db_firma_id","=",Auth::User()->firma_id)->where("id","=",$request->id)->first();
        $data_mesajlar= tbl_destek_cevaplar::where("db_destek_id","=",$request->id)->orderBy('id',"desc")->get();
        return ["data"=>$data,"data_mesajlar"=>$data_mesajlar];
    }
    public function storeDetayBayi(Request $request)
    {
        try {
            //return $request->all();
            $destek_create = new tbl_destek_cevaplar();
            $destek_create->db_destek_id = $request->id;
            $destek_create->db_destek_user_id = Auth::User()->id;
            $destek_create->db_destek_gonderen_tipi = "kullanici";
            $destek_create->db_destek_mesaj = $request->mesaj;
            $destek_create->db_firma_id = Auth::User()->firma_id;
            $destek_create->db_destek_dosya = $request->db_destek_dosya;

            if($destek_create->save()){
                $data= tbl_destek::where("id","=",$request->id)->first();
                $data->db_destek_durumu = "acik";
                $data->save();
                
                return response()->json(['message' => $this->globalName.' başarıyla cevaplandı',"status"=>true], 200);
            }else{
                return response()->json(['message' => $this->globalName.' ekleme işlemi başarısız',"status"=>false], 200);
            }
        } catch (\Exception $e) {

            debugSave( $e->getMessage());
            // Hata durumunda buraya düşeriz
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function onaylaDetayBayi(Request $request)
    {
        try {
            //return $request->all();
            $destek_create = tbl_destek::where("id","=",$request->id)->first();
            $destek_create->db_destek_durumu = "tamamlandi";

            if($destek_create->save()){
                
                return response()->json(['message' => $this->globalName.' durumunuz başarıyla değiştirilmiştir.',"status"=>true], 200);
            }else{
                return response()->json(['message' => $this->globalName.' işlem başarısız',"status"=>false], 200);
            }
        } catch (\Exception $e) {

            debugSave( $e->getMessage());
            // Hata durumunda buraya düşeriz
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
