<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\tbl_firma;
use App\Models\tbl_bakiye;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;


class BakiyeController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */

    // Constructor (kurucu) metodunda global ismi belirleme
    public function __construct()
    {
        $this->globalName = "Bakiye";
    }

    public function index(User $model)
    {
        return view('pages.admin.bakiyeIslemleri');
    }
    
    public function get(Request $request)
    {

        $firma = Auth::User()->firma;
        $data = tbl_bakiye::query();

        if ($request->filled('queryData')) {
            $data->where('db_odeme_miktari', 'LIKE', '%' . $request->queryData . '%');
        }
        if ($request->filled('baslangicTarihi')) {
            $data->whereDate('created_at', '>=', $request->baslangicTarihi);
        }
        if ($request->filled('firmaSelect')) {
            $data->where('db_firma_id', '=', $request->firmaSelect);
        }
        if ($request->filled('islemDurumuSelect')) {
            $data->where('db_odeme_durumu', '=', $request->islemDurumuSelect);
        }
        if ($request->filled('odemeDurumuSelect')) {
            $data->where('db_odeme_turu', '=', $request->odemeDurumuSelect);
        }

        
        if ($request->filled('bitisTarihi')) {
            $data->whereDate('created_at', '<=', $request->bitisTarihi);
        }
        $data->with("firma");

        $data = $data->orderBy('id', 'desc')->get();

        $bayis = tbl_firma::get();
        return ["data"=>$data,"firma"=>$firma,"bayi"=>$bayis];
    }
   
        
    public function create(Request $request)
    {   
        try {
            //return $request->all()
            $firma = tbl_firma::where("id","=",$request->bayi["id"])->first();
            $firma->bakiye = $firma->bakiye + $request->bakiye;
            if($firma->save()){
                $bakiye = new tbl_bakiye();
                $bakiye->db_firma_id=$request->bayi["id"];
                $bakiye->db_odeme_miktari=$request->bakiye;
                $bakiye->db_odeme_turu="yonetici";
                $bakiye->db_odeme_durumu="odeme_onaylandi";
                $bakiye->save();

                smsGonder("Sayın ". $firma->firma_yetkili ."; Kampüs LMS yöneticisi tarafından ".Carbon::now()->format("d.m.y")." tarihinde bakiye hesabınıza  ".$request->bakiye." TL,yüklenmiştir. Kalan yeni bakiyeniz ".$firma->bakiye ." TL Teşekkür ederiz. Kampüs LMS https://bayi.kampuslms.com",$firma->db_cep_no);
                mailGonder($firma->db_yetkili_email,"Sayın ". $firma->firma_yetkili ."; Kampüs LMS yöneticisi tarafından ".Carbon::now()->format("d.m.y")." tarihinde bakiye hesabınıza  ".$request->bakiye." TL,yüklenmiştir. Kalan yeni bakiyeniz ".$firma->bakiye ." TL Teşekkür ederiz. Kampüs LMS https://bayi.kampuslms.com","Kampus LMS - Bakiye");

                return response()->json(['message' => $this->globalName.' başarıyla eklendi',"status"=>true], 200);
            }else{
                return response()->json(['message' => $this->globalName.' ekleme işlemi başarısız',"status"=>false], 200);
            }
        } catch (\Exception $e) {
            // Hata durumunda buraya düşeriz

            debugSave( $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
        
    public function islemYap(Request $request)
    { 
        //return $request->islemList["islem"];
        //return $request->islemList["data"];
        //return $request->islemList["data"]["id"];
        
        $firma_update = tbl_bakiye::where("id","=",$request->islemList["data"]["id"])->first();
        $firma_update->db_odeme_durumu = $request->islemList["islem"];
        $firma_update->db_islem_yapan_id = Auth::User()->id;
        if($firma_update->save())
        {
            if($request->islemList["islem"] == "odeme_onaylandi")
            {
                $firma = tbl_firma::where("id","=",$firma_update->db_firma_id)->first();
                $firma->bakiye = floatval($firma->bakiye) + floatval($firma_update->db_odeme_miktari);
                $firma->save();

                smsGonder("Sayın ". $firma->firma_yetkili ."; Kampüs LMS bayi üzerinden ".Carbon::now()->format("d.m.y")." tarihinde yüklemiş olduğunuz ".$firma_update->db_odeme_miktari." TL, bakiye hesabınıza tanımlanmıştır. Kalan yeni bakiyeniz ".$firma->bakiye ." TL Teşekkür ederiz. Kampüs LMS https://bayi.kampuslms.com",$firma->db_cep_no);
                mailGonder($firma->db_yetkili_email,"Sayın ". $firma->firma_yetkili ."; Kampüs LMS bayi üzerinden ".Carbon::now()->format("d.m.y")." tarihinde yüklemiş olduğunuz ".$firma_update->db_odeme_miktari." TL, bakiye hesabınıza tanımlanmıştır. Kalan yeni bakiyeniz ".$firma->bakiye ." TL Teşekkür ederiz. Kampüs LMS https://bayi.kampuslms.com","Kampus LMS - Bakiye");

            }
            if($request->islemList["islem"] == "islem_iptal_edildi")
            {
               /* $firma = tbl_firma::where("id","=",$firma_update->db_firma_id)->first();
                $firma->bakiye = floatval($firma->bakiye) - floatval($firma_update->db_odeme_miktari);
                $firma->save();*/

                smsGonder("Sayın ". $firma->firma_yetkili ."; Kampüs LMS bayi üzerinden ".Carbon::now()->format("d.m.y")." tarihinde bakiye hesabınıza  ".$firma_update->db_odeme_miktari." TL, geri ödeme/iade yapılmıştır. Kalan yeni bakiyeniz ".$firma->bakiye ." TL Teşekkür ederiz. Kampüs LMS https://bayi.kampuslms.com",$firma->db_cep_no);
                mailGonder($firma->db_yetkili_email,"Sayın ". $firma->firma_yetkili ."; Kampüs LMS bayi üzerinden ".Carbon::now()->format("d.m.y")." tarihinde bakiye hesabınıza  ".$firma_update->db_odeme_miktari." TL, geri ödeme/iade yapılmıştır. Kalan yeni bakiyeniz ".$firma->bakiye ." TL Teşekkür ederiz. Kampüs LMS https://bayi.kampuslms.com","Kampus LMS - Bakiye");

            }
            if($request->islemList["islem"] == "bayi_islem_iptal")
            {

            }
            return response()->json(['message' =>'İşlem başarılı',"status"=>true], 200);

        }

        return $request->all();
    }

    //BAYİ
    public function indexBayi(User $model)
    {
        return view('pages.bayi.bakiyeIslemleri');
    }
    
    public function newPageBayi(User $model)
    {
        return view('pages.bayi.bakiyeIslemleriNew');
    }
    public function bakiyeKontrolBayi(Request $request)
    {

        if(Auth::User()->firma->db_min_bakiye != null)
        {
            $min_bakiye = Auth::User()->firma->db_min_bakiye;
        }else{
            $min_bakiye =getSetting("baslangic_bakiyesi");
        }
        //return $min_bakiye;

        if(!tbl_bakiye::where("db_firma_id","=",Auth::User()->firma_id)->where("db_odeme_durumu","!=","onay_bekliyor")->first())
        {    
            if($request->bakiye < $min_bakiye)
            {
                return ["status"=>"false","message"=>"İlk bakiyenizin en az ". $min_bakiye." ₺ olması olmalıdır. Yüklediğiniz bakiyeyi katılımcı eklerken kullanabileceksiniz.","min_bakiye"=>$min_bakiye ];
            }
        }
        return ["status"=>"true","min_bakiye"=>$min_bakiye ];
    }
    public function getBayi(Request $request)
    {

        $firma = Auth::User()->firma;
        $data = tbl_bakiye::query();

        if ($request->filled('queryData')) {
            $data->where('db_odeme_miktari', 'LIKE', '%' . $request->queryData . '%');
        }
        if ($request->filled('baslangicTarihi')) {
            $data->whereDate('created_at', '>=', $request->baslangicTarihi);
        }
        
        if ($request->filled('bitisTarihi')) {
            $data->whereDate('created_at', '<=', $request->bitisTarihi);
        }
        $data->where("db_firma_id","=",Auth::User()->firma_id);

        $data = $data->orderBy('id', 'desc')->get();

        $bayis = tbl_firma::get();
        return ["data"=>$data,"firma"=>$firma,"bayi"=>$bayis];
    }

        
    public function createBayi(Request $request)
    {
        //return $request->all();
        try {
            //return $request->all();
            /*$firma = Auth::User()->firma;
            $firma->bakiye = Auth::User()->firma->bakiye + $request->bakiye;*/
            
            //if($firma->save()){
                $bakiye = new tbl_bakiye();
                $bakiye->db_firma_id=Auth::User()->firma_id;
                $bakiye->db_odeme_miktari=$request->bakiye;
                $bakiye->db_odeme_turu=$request->db_odeme_turu;
                $bakiye->db_odeme_durumu="onay_bekliyor";
                $bakiye->save();
                
                if($request->db_odeme_turu == "banka")
                {
                    smsGonder("Sayın ". Auth::User()->name." ".Auth::User()->surname ."; Kampüs LMS bayi paneli üzerinden ".Carbon::now()->format("d.m.y")." tarihinde Havale /EFT ile bakiye yükleme talebinde bulundunuz. Aşağıda verilen banka hesabına ".$request->bakiye." TL ödeme yapınız. T.C. Ziraat Bankası IBAN: TR680001001767726331125009 Alıcı Hesap: Kampüs Kariyer. Ödeme kontrolünden sonra bakiyeniz hesabınıza tanımlanacak ve size ayrı bir bilgilendirme yapılacaktır. Kampüs LMS https://bayi.kampuslms.com",Auth::User()->firma["db_cep_no"]);
                    mailGonder(Auth::User()->email,"Sayın ". Auth::User()->name." ".Auth::User()->surname ."; Kampüs LMS bayi paneli üzerinden ".Carbon::now()->format("d.m.y")." tarihinde Havale /EFT ile bakiye yükleme talebinde bulundunuz. Aşağıda verilen banka hesabına ".$request->bakiye." TL ödeme yapınız. T.C. Ziraat Bankası IBAN: TR680001001767726331125009 Alıcı Hesap: Kampüs Kariyer. Ödeme kontrolünden sonra bakiyeniz hesabınıza tanımlanacak ve size ayrı bir bilgilendirme yapılacaktır. Kampüs LMS https://bayi.kampuslms.com","Kampus LMS - Bakiye");

                }

                return response()->json(['message' => $this->globalName.' talebi başarıyla oluşturuldu.',"status"=>true,'data'=>$bakiye], 200);
            /*}else{
                return response()->json(['message' => $this->globalName.' ekleme işlemi başarısız',"status"=>false], 200);
            }*/
        } catch (\Exception $e) {
            // Hata durumunda buraya düşeriz

            debugSave( $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
