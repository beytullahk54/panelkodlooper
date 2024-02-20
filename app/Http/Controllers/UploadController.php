<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\tbl_firma;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;

class UploadController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function gorselUpload(Request $request,$id="")
    {
        $uploadParameterArr = ['baseFolderName' => ""];

        $result = dosya($request->file, "uploads/".$id."/", $uploadParameterArr);
        
        return $result;
    }
}
