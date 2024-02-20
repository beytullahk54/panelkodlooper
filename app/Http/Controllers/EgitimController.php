<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\tbl_egitim;
use App\Models\tbl_kategori;
use App\Models\tbl_universite;
use App\Models\tbl_firma;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EgitimController extends Controller
{
    private $globalName;

    // Constructor (kurucu) metodunda global ismi belirleme
    public function __construct()
    {
        $this->globalName = "Eğitimler";
    }

    //ADMİN
    
    public function index(User $model)
    {
        return view('pages.admin.egitim');
    }
    
    public function yeni(User $model)
    {
        return view('pages.admin.egitimYeni');
    }
    
    public function detayPage($id)
    {
        return view('pages.admin.egitimDetayPage')->with('id',$id);
    }
    
    public function kopyala(Request $request)
    {
        try {
            tbl_egitim::create($request->data);
            return response()->json(['message' => $this->globalName.' başarıyla eklendi',"status"=>true], 200);
        } catch (\Exception $e) {

            debugSave( $e->getMessage());
            // Hata durumunda buraya düşeriz
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }
    public function guncelle($id)
    {
        return view('pages.admin.egitimGuncelle')->with("id",$id);
    }
    
    public function guncelleApi(Request $request)
    {
        $data= tbl_egitim::where("id","=",$request->id)->first();
        return ["data"=>$data];
    }
    public function get(Request $request)
    {
        $data = tbl_egitim::query();

        if ($request->filled('queryData')) {
            $data->where('db_adi','LIKE','%'.$request->queryData.'%')
            ->orWhere('db_kategori','LIKE','%'.$request->queryData.'%')
            ->orWhere('db_universite','LIKE','%'.$request->queryData.'%')
            ->orWhere('db_egitim_kodu','LIKE','%'.$request->queryData.'%');
        }

        if ($request->filled('durumSelect')) {
            $data->where('db_basvuru_durumu','=',$request->durumSelect);
        }

        if ($request->filled('kategoriSelect')) {
            $data->where('db_kategori->id','=',$request->kategoriSelect);
        }

        if ($request->filled('universiteSelect')) {
            $data->whereJsonContains('db_universite', ['id' => $request->universiteSelect]);
        }

        $data = $data->orderBy('id','desc')->with("firma")->paginate(50);

        return ["data"=>$data];
    }
    public function getData(Request $request)
    {
        $data= tbl_egitim::where('id','=',$request->id)->first();
        return ["data"=>$data];
    }

    public function getKategori(Request $request)
    {
        $data= tbl_kategori::get();
        return ["data"=>$data];
    }
    
    public function getUniversite(Request $request)
    {
        $data= tbl_universite::get();
     
        return ["data"=>$data];
    }
    public function getFiltrele(Request $request)
    {
        return $request->all();
        $data= tbl_egitim::paginate(50);
        return ["data"=>$data];
    }
    public function create(Request $request)
    {
        //return $request->all();

        //return $request->all();
     
        try {
            tbl_egitim::create($request->all());
            return response()->json(['message' => $this->globalName.' başarıyla eklendi',"status"=>true], 200);
        } catch (\Exception $e) {

            debugSave( $e->getMessage());
            // Hata durumunda buraya düşeriz
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function detayPageBayi($id)
    {
        return view('pages.bayi.egitimDetayPage')->with('id',$id);
    }
    
    public function gorselUpload(Request $request,$id="")
    {
        $uploadParameterArr = ['baseFolderName' => ""];

        $result = dosya($request->file, "uploads/".$id."/", $uploadParameterArr);
        
        return $result;
    }
    public function gorselCokluUpload(Request $request,$id="")
    {
        $uploadParameterArr = ['baseFolderName' => ""];

        $result = dosya($request->file, "uploads/".$id."/", $uploadParameterArr);
        
        return $result;

    }
    public function update(Request $request)
    {   
        try {
            //return $request->all();
            $tblEgitim = tbl_egitim::find($request->id);
            if ($tblEgitim) {
              // $updateData = $request->only(['universite', 'digerveri']); // Güncellenmesi istenen alanları belirtin
        
                $tblEgitim->update($request->all());
        
                return response()->json(['message' => 'TblEgitim başarıyla güncellendi', 'status' => true], 200);
            } else {
                return response()->json(['error' => 'TblEgitim bulunamadı'], 404);
            }
            /*$katilimci = tbl_egitim::find($request->id);
            $katilimci->db_adi = $request->db_adi;*/
            return response()->json(['message' => $this->globalName.' başarıyla güncellendi',"status"=>true], 200);
            
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
    public function fiyatGuncelle(Request $request)
    {   
        try {
            //return $request->all();
            $katilimci = tbl_egitim::find($request->id);
            $katilimci->db_bayi_alis_fiyati = $request->db_bayi_alis_fiyati;
            
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
    public function islemGuncelle(Request $request)
    {   
        try {
            //return $request->all();
            $db = tbl_egitim::find($request->id);
            $db[$request->key] = $request->value;
            
            if($db->save()){
                $tbl_firma = tbl_firma::where("id","=",$db->db_firma_id)->first();
                if($request->key=="db_bayi_onay_durumu" && $request->value=="acik" ){
                        smsGonder("Sayın ". $tbl_firma->firma_yetkili ."; Kampüs LMS bayi paneli üzerinden önermiş olduğunuz ".$db->db_adi." eğitimi/programı ".Carbon::now()->format("d.m.y")." tarihinde onaylanmıştır. https://panel.kampuslms.com bağlantısından bayi paneline giriş yapabilir, katılımcı ekleyebilir ve tüm süreçleri panel üzerinden takip edebilirsiniz. Teşekkür ederiz. Kampüs LMS https://bayi.kampuslms.com",$tbl_firma->db_cep_no);
                        mailGonder($tbl_firma->db_yetkili_email,"Sayın ". $tbl_firma->firma_yetkili ."; Kampüs LMS bayi paneli üzerinden önermiş olduğunuz ".$db->db_adi." eğitimi/programı ".Carbon::now()->format("d.m.y")." tarihinde onaylanmıştır. https://panel.kampuslms.com bağlantısından bayi paneline giriş yapabilir, katılımcı ekleyebilir ve tüm süreçleri panel üzerinden takip edebilirsiniz. Teşekkür ederiz. Kampüs LMS https://bayi.kampuslms.com","Kampus LMS - Eğitim");

                }
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
            $katilimci = tbl_egitim::find($request->data['id']);
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
        return view('pages.bayi.egitim');
    }
    public function getBayi(Request $request)
    {

        if($request->queryData){

            $data= tbl_egitim::where('db_adi','LIKE','%'.$request->queryData.'%')
            ->orWhere('db_kategori','LIKE','%'.$request->queryData.'%')
            ->orWhere('db_universite','LIKE','%'.$request->queryData.'%')
            ->orWhere('db_egitim_kodu','LIKE','%'.$request->queryData.'%')
            ->orWhere('db_egitim_kodu','LIKE','%'.$request->queryData.'%')
            ->whereNull('db_firma_id')
            ->with("firma")
            ->paginate(50);
        }else{
            $data= tbl_egitim::orderBy('id','desc')
            ->whereNull('db_firma_id')
            ->with("firma")
            ->paginate(50);
        }
        return ["data"=>$data];
    }
}
