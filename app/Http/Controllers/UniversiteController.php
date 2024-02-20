<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\tbl_universite;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UniversiteController extends Controller
{
    private $globalName;

    // Constructor (kurucu) metodunda global ismi belirleme
    public function __construct()
    {
        $this->globalName = "Üniversiteler";
    }

    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('pages.admin.universite');
    }
    
    public function get(Request $request)
    {
        if($request["query"] != null or $request["query"] != ""){ 
            $data= tbl_universite::where("db_adi","LIKE","%".$request["query"]."%")->orderBy('db_adi','asc')->paginate(500);
        }else{
            $data= tbl_universite::orderBy('db_adi','asc')->paginate(500);
        }
        return ["data"=>$data];
    }
    public function create(Request $request)
    {
        
        try {
            //return $request->all();
            $katilimci_create = new tbl_universite();
            $katilimci_create->db_adi = $request->db_adi;
            $katilimci_create->db_edevlet = "aktif";
            $katilimci_create->db_durum = "aktif";
            $katilimci_create->db_ulusal_gecerlilik = "aktif";
            $katilimci_create->db_uluslararasi_gecerlilik = "aktif";
            
            if($katilimci_create->save()){
                
                return response()->json(['message' =>'İşlem başarılı',"status"=>true], 200);
            }else{
                return response()->json(['message' => 'İşlem başarısız',"status"=>false], 200);
            }
        } catch (\Exception $e) {
            debugSave( $e->getMessage());
            // Hata durumunda buraya düşeriz
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function onayla(Request $request)
    {
        //return $request->dataList['id'];
        //return $request->dataList['key'];
        try {
            //return $request->all();
            $katilimci_create = tbl_universite::where("id","=",$request->dataList["id"])->first();
            $katilimci_create[$request->dataList['key']] = $request->dataList['value'];
            
            if($katilimci_create->save()){
                
                return response()->json(['message' => ' İşlem başarılı',"status"=>true], 200);
            }else{
                return response()->json(['message' => ' İşlem başarısız',"status"=>false], 200);
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
            $katilimci = tbl_universite::find($request->id);
            $katilimci->db_adi = $request->db_adi;
            
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
            $katilimci = tbl_universite::find($request->data['id']);
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
        return view('pages.bayi.universite');
    }
    
    public function getBayi(Request $request)
    {
        $data= tbl_universite::orderBy('db_adi','asc')->paginate(500);
        return ["data"=>$data];
    }
}
