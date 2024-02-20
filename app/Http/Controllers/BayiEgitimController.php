<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\tbl_egitim;
use App\Models\tbl_kategori;
use App\Models\tbl_universite;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class BayiEgitimController extends Controller
{
    private $globalName;

    // Constructor (kurucu) metodunda global ismi belirleme
    public function __construct()
    {
        $this->globalName = "Eğitimlerim";
    }

    public function get(Request $request)
    {
        if($request->queryData){
            $data= tbl_egitim::where('db_firma_id',"=",Auth::User()->firma_id)
            ->orWhere('db_kategori','LIKE','%'.$request->queryData.'%')
            ->orWhere('db_universite','LIKE','%'.$request->queryData.'%')
            ->orWhere('db_egitim_kodu','LIKE','%'.$request->queryData.'%')
            ->where('db_adi','LIKE','%'.$request->queryData.'%')->paginate();
        }else{
            $data= tbl_egitim::where('db_firma_id',"=",Auth::User()->firma_id)->paginate(10);
        }
        return ["data"=>$data];
    }
    
    public function yeni(User $model)
    {
        return view('pages.bayi.egitimYeni');
    }
    
    public function create(Request $request)
    {
        //return $request->all();

        
        if(Auth::User()->firma_id){
            try {
                
                tbl_egitim::create($request->all());
                smsGonder("Sayın ". Auth::User()->name." ".Auth::User()->surname ."; Kampüs LMS bayi paneli üzerinden önermiş olduğunuz ".$request->db_adi." eğitimi/programı ".Carbon::now()->format("d.m.y")." tarihinde tarafımıza başarıyla ulaşmıştır. Gerekli incelemenin ve uygunluk kontrolünden sonra onay durumu daha sonra size bildirilecektir. Teşekkür ederiz. Kampüs LMS https://bayi.kampuslms.com",Auth::User()->firma->db_cep_no);
                mailGonder(Auth::User()->email,"Sayın ". Auth::User()->name." ".Auth::User()->surname ."; Kampüs LMS bayi paneli üzerinden önermiş olduğunuz ".$request->db_adi." eğitimi/programı ".Carbon::now()->format("d.m.y")." tarihinde tarafımıza başarıyla ulaşmıştır. Gerekli incelemenin ve uygunluk kontrolünden sonra onay durumu daha sonra size bildirilecektir. Teşekkür ederiz. Kampüs LMS https://bayi.kampuslms.com","Kampus LMS - Eğitim");


                return response()->json(['message' => $this->globalName.' başarıyla eklendi',"status"=>true], 200);
            } catch (\Exception $e) {

                debugSave( $e->getMessage());
                // Hata durumunda buraya düşeriz
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }else{
            try {
                tbl_egitim::create($request->all());
                return response()->json(['message' => $this->globalName.' başarıyla eklendi',"status"=>true], 200);
            } catch (\Exception $e) {

                debugSave( $e->getMessage());
                // Hata durumunda buraya düşeriz
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
        
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

    public function getFirma(Request $request)
    {
        $data = Auth::User()->firma;
        return ["data"=>$data];
    }

    public function getData(Request $request){
        
        $data= tbl_egitim::where('db_firma_id',"=",Auth::User()->firma_id)->where('id','=',$request->id)->first();
        return ["data"=>$data];
    }

    public function detayPageBayi($id)
    {
        return view('pages.bayi.egitimDetayPage')->with('id',$id);
    }
   

    //BAYİ

    public function indexBayi(User $model)
    {
        return view('pages.bayi.egitimlerim');
    }
}
