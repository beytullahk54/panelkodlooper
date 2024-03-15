<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\tbl_markalar;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class HizmetController extends Controller
{
    private $globalName;

    // Constructor (kurucu) metodunda global ismi belirleme
    public function __construct()
    {
        $this->globalName = "Markalar";
    }

    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index($hizmet)
    {
        return view('pages.admin.hizmet.index')->with("hizmet",$hizmet);
    }
    public function view($id)
    {
        return view('pages.admin.hizmet.view')->with("id",$id);
    }
    
    public function get(Request $request)
    {
        $data= tbl_markalar::orderBy("db_hizmet_bitis_tarihi","asc")->where("db_hizmet","=",$request->hizmet)->paginate(10);
        $dataCount=tbl_markalar::orderBy("created_at","desc")->where("db_hizmet","=",$request->hizmet)->count();
        return ["data"=>$data,"dataCount"=>$dataCount];
    }
    
    public function getData(Request $request)
    {
        $data= tbl_markalar::where("id","=",$request->id)->first();
        return ["data"=>$data];
    }
    public function getFiltrele(Request $request)
    {
        return $request->all();
        $data= tbl_markalar::paginate(10);
        return ["data"=>$data];
    }
    public function create(Request $request)
    {
        
        try {
            //return $request->all();
            $katilimci_create = new tbl_markalar();
            $katilimci_create->db_name = $request->db_name;
            $katilimci_create->db_hizmet = $request->db_hizmet;
            $katilimci_create->db_hizmet_bitis_tarihi = $request->db_hizmet_bitis_tarihi;
            $katilimci_create->db_hizmet_ucreti = $request->db_hizmet_ucreti;
            
            
            if($katilimci_create->save()){
                
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
            $katilimci = tbl_markalar::find($request->id);
            $katilimci->db_name = $request->db_name;
            $katilimci->db_hizmet_bitis_tarihi = $request->db_hizmet_bitis_tarihi;
            $katilimci->db_hizmet_ucreti = $request->db_hizmet_ucreti;
            
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
            $katilimci = tbl_markalar::find($request->data['id']);
            if($katilimci->delete()){
                return response()->json(['message' => $this->globalName.' silme işlemi başarılı',"status"=>true], 200); 
            }
        } catch (\Exception $e) {
            debugSave( $e->getMessage());
            // Hata durumunda buraya düşeriz
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
