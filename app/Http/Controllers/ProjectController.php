<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\tbl_project;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private $globalName;

    // Constructor (kurucu) metodunda global ismi belirleme
    public function __construct()
    {
        $this->globalName = "Proje";
    }

    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('pages.admin.project.index');
    }
    
    public function get(Request $request)
    {
        $data= tbl_project::paginate(10);
        return ["data"=>$data];
    }
    public function getFiltrele(Request $request)
    {
        return $request->all();
        $data= tbl_project::paginate(10);
        return ["data"=>$data];
    }
    public function create(Request $request)
    {
        
        try {
            //return $request->all();
            $katilimci_create = new tbl_project();
            $katilimci_create->db_adi = $request->db_adi;
            $katilimci_create->db_project_start_date = $request->db_project_start_date;
            $katilimci_create->db_project_end_date = $request->db_project_end_date;
            
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
            $katilimci = tbl_project::find($request->id);
            $katilimci->db_adi = $request->db_adi;
            $katilimci->db_project_start_date = $request->db_project_start_date;
            $katilimci->db_project_end_date = $request->db_project_end_date;
            
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
            $katilimci = tbl_project::find($request->data['id']);
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
