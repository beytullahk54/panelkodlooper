<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\tbl_firma;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class BayiController extends Controller
{
    private $globalName;

    // Constructor (kurucu) metodunda global ismi belirleme
    public function __construct()
    {
        $this->globalName = "Bayi";
    }

    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('pages.admin.bayi');
    }
    
    
    public function get(Request $request)
    {

        $data = tbl_firma::query();

        if ($request->filled('queryData')) {
            $data->where('firma_adi', 'LIKE', '%' . $request->queryData . '%')
                ->orWhere('firma_yetkili', 'LIKE', '%' . $request->queryData . '%')
                ->orWhere('db_yetkili_email', 'LIKE', '%' . $request->queryData . '%')
                ->orWhere('db_tc_pasaport', 'LIKE', '%' . $request->queryData . '%')
                ->orWhere('db_cep_no', 'LIKE', '%' . $request->queryData . '%');
        }
        
        if ($request->filled('baslangicTarihi')) {
            $data->whereDate('created_at', '>=', $request->baslangicTarihi);
        } 
        
        if ($request->filled('bitisTarihi')) {
            $data->whereDate('created_at', '<=', $request->bitisTarihi);
        } 
        if ($request->filled('durumSelect')) {
            $data->where('firma_durum', '=', $request->durumSelect);
        }
        if ($request->filled('tipSelect')) {
            $data->where('sirket_kurumsal_sahis', '=', $request->tipSelect);
        }

        $data = $data->orderBy('id', 'desc')->paginate();

        $bayis = tbl_firma::get();


        $bayi_toplam_bakiye = 0;
        $bayiler = tbl_firma::get();
        foreach($bayiler as $bayi)
        {
            $bayi_toplam_bakiye = $bayi->bakiye + $bayi_toplam_bakiye;
        }
        return ["data"=>$data,"toplam_bakiye"=>$bayi_toplam_bakiye];
    }
    public function islemYap(Request $request)
    {
        //return $request->data['id'];
        $firma_update = tbl_firma::where("id","=",$request->data['id'])->first();
        $firma_update->firma_durum = $request->data['onayDurum'];
        if($firma_update->save()){
            if($request->data['onayDurum']=="onaylandi")
            {
                smsGonder("Sayın ". $firma_update->firma_yetkili ."; Kampüs LMS bayilik başvurunuz ".Carbon::now()->format("d.m.y")." tarihinde onaylanmıştır. https://panel.kampuslms.com bağlantısından bayi paneline giriş yapabilir, bakiye ve katılımcı ekleyebilir, tüm süreçleri panel üzerinden takip edebilirsiniz. Teşekkür ederiz. Kampüs LMS https://bayi.kampuslms.com",$firma_update->db_cep_no);
                mailGonder($firma_update->db_yetkili_email,"Sayın ". $firma_update->firma_yetkili ."; Kampüs LMS bayilik başvurunuz ".Carbon::now()->format("d.m.y")." tarihinde onaylanmıştır. https://panel.kampuslms.com bağlantısından bayi paneline giriş yapabilir, bakiye ve katılımcı ekleyebilir, tüm süreçleri panel üzerinden takip edebilirsiniz. Teşekkür ederiz. Kampüs LMS https://bayi.kampuslms.com","Kampus LMS Bayi Paneli");

            }
            if($request->data['onayDurum']=="onaylanmadi")
            {
                smsGonder("Sayın ". $firma_update->firma_yetkili ."; Kampüs LMS bayi başvurunuz ".Carbon::now()->format("d.m.y")." tarihinde onaylanmamıştır / uygun görülmemiştir.  Bayi panelinde bulunan SSS (sıkça sorulan sorular) sayfasından ret nedenlerini inceleyebilirsiniz. Teşekkür ederiz. Kampüs LMS https://bayi.kampuslms.com ",$firma_update->db_cep_no);
                mailGonder($firma_update->db_yetkili_email,"Sayın ". $firma_update->firma_yetkili ."; Kampüs LMS bayi başvurunuz ".Carbon::now()->format("d.m.y")." tarihinde onaylanmamıştır / uygun görülmemiştir.  Bayi panelinde bulunan SSS (sıkça sorulan sorular) sayfasından ret nedenlerini inceleyebilirsiniz. Teşekkür ederiz. Kampüs LMS https://bayi.kampuslms.com ","Kampus LMS Bayi Paneli");

            }
            if($request->data['onayDurum']=="iptal_edildi")
            {
                smsGonder("Sayın ". $firma_update->firma_yetkili ."; Kampüs LMS bayiliğiniz ".Carbon::now()->format("d.m.y")." tarihinde iptal edilmiştir. Bayi panelinde bulunan SSS (sıkça sorulan sorular) sayfasından bayilik iptal nedenlerini inceleyebilirsiniz. Teşekkür ederiz. Kampüs LMS https://bayi.kampuslms.com",$firma_update->db_cep_no);
                mailGonder($firma_update->db_yetkili_email,"Sayın ". $firma_update->firma_yetkili ."; Kampüs LMS bayiliğiniz ".Carbon::now()->format("d.m.y")." tarihinde iptal edilmiştir. Bayi panelinde bulunan SSS (sıkça sorulan sorular) sayfasından bayilik iptal nedenlerini inceleyebilirsiniz. Teşekkür ederiz. Kampüs LMS https://bayi.kampuslms.com","Kampus LMS Bayi Paneli");
            }

            return response()->json(['message' => $this->globalName.' işlemi başarıyla tamamlandı',"status"=>true], 200);
        }else{
            return response()->json(['message' => $this->globalName.' işlem başarısız.',"status"=>true], 200);

        }
        return $request->all();
        $data= tbl_firma::paginate(10);
        return ["data"=>$data];
    }
    public function view(Request $request)
    {
        $firma = tbl_firma::where("id","=",$request->id)->first();
        return view("pages.admin.bayiView")->with("id",$request->id);    
        return ["data"=>$firma];
    }
    public function viewGet(Request $request)
    {
        $firma = tbl_firma::where("id","=",$request->id)->first();
        $user=User::where("firma_id","=",$request->id)->first();

        return ["data"=>$firma,"user"=>$user];
    }
    public function create(Request $request)
    {
        
        try {
            //return $request->all();
            $katilimci_create = new tbl_firma();
            $katilimci_create->db_adi = $request->db_adi;
            
            if($katilimci_create->save()){
                
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
    public function update(Request $request)
    {   
        try {
            
            if(User::where("firma_id","=",$request->id)->first()->email != $request->db_yetkili_email)
            {
                if(User::where("email","=",$request->db_yetkili_email)->first()){
                    return response()->json(['message' =>"Bu email adresi daha önceden kullanılmış. Lütfen kullanılmayan bir email deneyiniz","status"=>"false"], 200);
                }
            }
            
            if(soapTcDogrula($request->db_tc_pasaport,$request->name,$request->surname,$request->db_dogum_tarihi) != "true"){
                return response()->json(['message' =>"Katılımcı bilgileri (Ad, Soyad, Doğum Tarihi, TC Kimlik No) biri ya da birkaçı MERNİS tarafından doğrulanamamıştır. Lütfen bilgileri kontrol ediniz ve tekrar deneyiniz.","status"=>"false"], 200);
            }
            
            //return $request->all();
            $firma = tbl_firma::find($request->id);
            $firma->firma_adi=$request->db_sirket_unvani;
            $firma->firma_yetkili=$request->firma_yetkili;
            $firma->db_yetkili_email=$request->db_yetkili_email;
            $firma->db_cep_no=$request->db_cep_no;
            $firma->db_dogum_tarihi=$request->db_dogum_tarihi;
            $firma->db_yetkili_uyrugu=$request->db_yetkili_uyrugu;
            $firma->db_ulke=$request->db_ulke;
            $firma->db_sehir=$request->db_sehir;
            $firma->db_ilce=$request->db_ilce;
            $firma->db_ulke_obj=$request->db_ulke_obj;
            $firma->db_sehir_obj=$request->db_sehir_obj;
            $firma->db_ilce_obj=$request->db_ilce_obj;
            $firma->db_sirket_turu=$request->db_sirket_turu;
            $firma->db_min_bakiye=$request->db_min_bakiye;
            $firma->db_sirket_unvani=$request->db_sirket_unvani;
            $firma->db_sirket_adresi=$request->db_sirket_adresi;
            $firma->db_sirket_vergi_no=$request->db_sirket_vergi_no;
            $firma->db_sirket_dairesi=$request->db_sirket_dairesi;
            $firma->db_sirket_web_adresi=$request->db_sirket_web_adresi;
            $firma->db_sosyal_medya_hesabi=$request->db_sosyal_medya_hesabi;
            $firma->db_kimlik_on_yuzu=$request->db_kimlik_on_yuzu;
            $firma->db_ikametgah=$request->db_ikametgah;
            $firma->db_vergi_levhasi=$request->db_vergi_levhasi;
            $firma->db_tc_pasaport=$request->db_tc_pasaport;
            $firma->sirket_kurumsal_sahis=$request->sirket_kurumsal_sahis;
            
            if($firma->save()){
                $user = User::where("firma_id","=",$request->id)->first();
                $user->name = $request->name;
                $user->surname = $request->surname;
                $user->email = $request->db_yetkili_email;
                if(!empty($request->db_sifre)){
                    $user->password = Hash::make($request->db_sifre);
                }
                $user->save();
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
            $katilimci = tbl_firma::find($request->data['id']);
            if($katilimci->delete()){
                return response()->json(['message' => $this->globalName.' silme işlemi başarılı',"status"=>true], 200); 
            }
        } catch (\Exception $e) {
            // Hata durumunda buraya düşeriz

            debugSave( $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
