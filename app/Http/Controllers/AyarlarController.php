<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\tbl_ayarlar;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AyarlarController extends Controller
{
    private $globalName;

    // Constructor (kurucu) metodunda global ismi belirleme
    public function __construct()
    {
        $this->globalName = "Ayarlar";
    }

    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('pages.admin.ayarlar');
    }
    
    public function get(Request $request)
    {
        $data= tbl_ayarlar::paginate(10);
        return ["data"=>$data];
    }
    public function getFiltrele(Request $request)
    {
        return $request->all();
        $data= tbl_ayarlar::paginate(10);
        return ["data"=>$data];
    }
    public function update(Request $request)
    {   
        try {
            $katilimci = tbl_ayarlar::where("db_key","=",$request->db_key)->first();
            $katilimci->db_value = $request->db_value;
            
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

    //BAYİ

    public function indexBayi(User $model)
    {
        return view('pages.bayi.universite');
    }
    
    public function getBayi(Request $request)
    {
        $data= tbl_ayarlar::paginate(10);
        return ["data"=>$data];
    }
}
