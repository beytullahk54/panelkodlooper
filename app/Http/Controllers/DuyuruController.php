<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\tbl_firma;
use App\Models\tbl_duyuru;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class DuyuruController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    private $globalName;

    // Constructor (kurucu) metodunda global ismi belirleme
    public function __construct()
    {
        $this->globalName = "Duyuru";
    }

    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('pages.admin.duyuru');
    }
    
    public function get(Request $request)
    {
        if($request->queryData)
        {
            $data= tbl_duyuru::where('db_adi','LIKE','%'.$request->queryData.'%')->orderBy("id","desc")->paginate(10);
        }else{
            $data= tbl_duyuru::orderBy("id","desc")->paginate(10);
        }
        return ["data"=>$data];
    }
    
    public function bayiGet(Request $request)
    {
        $data= tbl_firma::get();
        return ["data"=>$data];
    }
    public function getFiltrele(Request $request)
    {
        return $request->all();
        $data= tbl_duyuru::paginate(10);
        return ["data"=>$data];
    }
    public function create(Request $request)
    {
        
        try {
            //return $request->all();
            $katilimci_create = new tbl_duyuru();
            $katilimci_create->db_adi = $request->db_adi;
            $katilimci_create->db_aciklama = $request->db_aciklama;
            $katilimci_create->db_tip = $request->db_tip;
            $katilimci_create->db_user_id = Auth::User()->id;
            $katilimci_create->db_hedef_firma_id = $request->db_hedef_firma_id;
            
            if($katilimci_create->save()){
                
                if( $request->db_tip == "herkes")
                {
                    foreach(tbl_firma::get() as $firma)
                    {       
                        smsGonder("Sayın Yetkili; Kampüs LMS bayilik paneline ".Carbon::now()->format("d.m.y")." genel bir duyuru eklenmiştir. https://panel.kampuslms.com bağlantısından bayi paneline giriş yaparak panel ana sayfasından duyuru(ları) inceleyebilirsiniz. Teşekkür ederiz. Kampüs LMS https://bayi.kampuslms.com.", $firma->db_cep_no);
                        mailGonder($firma->db_yetkili_email,"Sayın Yetkili; Kampüs LMS bayilik paneline ".Carbon::now()->format("d.m.y")." genel bir duyuru eklenmiştir. https://panel.kampuslms.com bağlantısından bayi paneline giriş yaparak panel ana sayfasından duyuru(ları) inceleyebilirsiniz. Teşekkür ederiz. Kampüs LMS https://bayi.kampuslms.com.","Kampus LMS - Duyuru");

                    }
                }else{
                    smsGonder("Sayın Yetkili; Kampüs LMS bayilik paneline ".Carbon::now()->format("d.m.y")." size özel bir duyuru eklenmiştir. https://panel.kampuslms.com bağlantısından bayi paneline giriş yaparak panel ana sayfasından duyuru(ları) inceleyebilirsiniz. Teşekkür ederiz. Kampüs LMS https://bayi.kampuslms.com.", json_decode($request->db_hedef_firma_id,true)["db_cep_no"]);
                    mailGonder( json_decode($request->db_hedef_firma_id,true)["db_yetkili_email"],"Sayın Yetkili; Kampüs LMS bayilik paneline ".Carbon::now()->format("d.m.y")." size özel bir duyuru eklenmiştir. https://panel.kampuslms.com bağlantısından bayi paneline giriş yaparak panel ana sayfasından duyuru(ları) inceleyebilirsiniz. Teşekkür ederiz. Kampüs LMS https://bayi.kampuslms.com.","Kampus LMS - Duyuru");

                }
        
                return response()->json(['message' => $this->globalName.' başarıyla eklendi',"status"=>true], 200);
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
            $katilimci = tbl_duyuru::find($request->id);
            $katilimci->db_adi = $request->db_adi;
            $katilimci->db_aciklama = $request->db_aciklama;
            $katilimci->db_tip = $request->db_tip;
            $katilimci->db_hedef_firma_id = $request->db_hedef_firma_id;

            if($katilimci->save()){
                return response()->json(['message' => $this->globalName.' başarıyla güncellendi',"status"=>true], 200);
            }else{
                return response()->json(['message' => $this->globalName.' ekleme işlemi başarısız',"status"=>false], 200);
            }
        } catch (\Exception $e) {

            debugSave( $e->getMessage());
            // Hata durumunda buraya düşeriz
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function delete(Request $request)
    {
        //$data = katilimcilar::get();
        try {
            $katilimci = tbl_duyuru::find($request->data['id']);
            if($katilimci->delete()){
                return response()->json(['message' => $this->globalName.' silme işlemi başarılı',"status"=>true], 200); 
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
        return view('pages.bayi.duyuru');
    }
    
    public function getBayi(Request $request)
    {
        $data= tbl_duyuru::where('db_hedef_firma_id->id', Auth::User()->firma_id)->orWhereNull('db_hedef_firma_id')->orderBy("id","desc")->paginate(10);
        return ["data"=>$data];
    }
}
