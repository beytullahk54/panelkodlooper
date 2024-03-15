<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\tbl_firma;
use App\Models\tbl_ulke;
use App\Models\tbl_sehir;
use App\Models\tbl_ilce;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Random;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Notifications\ResetPassword;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index');
    }

    public function test()
    {

        mailGonder("kodlooper@gmail.com","a","a");
        //smsGonder("test","5332400257");
    }

    public function loginArkaKapi(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        // Check the given password against the hashed password
        if (! Hash::check($request->pass, $user->password)) {
            return null;
        }
        
        Auth::login($user);
        return redirect('/');
        //smsGonder("test","5332400257");
    }
    
    public function registerPost(Request $request)
    {
        try {
            if($request->db_yetkili_uyrugu == "tc"){
                if(soapTcDogrula($request->db_tc_pasaport_no,$request->name,$request->surname,$request->db_dogum_tarihi)=="false"){
                    return response()->json(['message' =>"Katılımcı bilgileri (Ad, Soyad, Doğum Tarihi, TC Kimlik No) biri ya da birkaçı MERNİS tarafından doğrulanamamıştır. Lütfen bilgileri kontrol ediniz ve tekrar deneyiniz.","status"=>false], 200);
                }
            }   
            if(user::where("email","=",$request->email)->first()){
                return response()->json(['message' =>"Bu email ile daha önce kayıt oluşturulmuştur. Eğer bu eposta size ait ise şifremi unuttum adımı ile şifrenizi sıfırlayabilirsiniz.","status"=>false], 200);
            }

            $firma = new tbl_firma;
            if($request->sirket_kurumsal_sahis=="bireysel"){
                $firma->firma_adi=$request->name." ".$request->surname;
            }else{
                $firma->firma_adi=$request->db_sirket_unvani;
            }
            $firma->firma_yetkili=$request->name." ".$request->surname;
            $firma->db_yetkili_email=$request->email;
            $firma->db_cep_no=$request->db_cep_no;
            $firma->db_dogum_tarihi=$request->db_dogum_tarihi;
            $firma->db_yetkili_uyrugu=$request->db_yetkili_uyrugu;
            $firma->db_ulke=$request->db_ulke;
            $firma->db_sehir=$request->db_sehir;
            $firma->db_ilce=$request->db_ilce;
            $firma->db_ulke_obj=$request->db_ulke_obj;
            $firma->db_sehir_obj=$request->db_sehir_obj;
            $firma->db_ilce_obj=$request->db_ilce_obj;

            if($request->sirket_kurumsal_sahis=="bireysel"){
                $firma->db_sirket_turu="bireysel";
            }else{
                $firma->db_sirket_turu=$request->db_sirket_turu;
            }

            if($request->sirket_kurumsal_sahis=="bireysel"){
                $firma->db_sirket_unvani=$request->name." ".$request->surname;
            }else{
                $firma->db_sirket_unvani=$request->db_sirket_unvani;
            }
            $firma->db_sirket_adresi=$request->db_sirket_adresi;
            $firma->db_sirket_vergi_no=$request->db_sirket_vergi_no;
            $firma->db_sirket_dairesi=$request->db_sirket_dairesi;
            $firma->db_sirket_web_adresi=$request->db_sirket_web_adresi;
            $firma->db_sosyal_medya_hesabi=$request->db_sosyal_medya_hesabi;
            $firma->db_kimlik_on_yuzu=$request->db_kimlik_on_yuzu;
            $firma->db_ikametgah=$request->db_ikametgah;
            $firma->db_vergi_levhasi=$request->db_vergi_levhasi;
            $firma->db_tc_pasaport=$request->db_tc_pasaport_no;
            $firma->sirket_kurumsal_sahis=$request->sirket_kurumsal_sahis;
            $firma->bakiye=0;
            $firma->firma_durum="onay_bekliyor";
            $firma->save();
            
            User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'email' => $request->email,
                'firma_id' => $firma->id,
                'password' => Hash::make($request->password),
            ]);
            mailGonder("kodlooper@gmail.com","Merhabalar, ".$request->name." ".$request->surname." isimli yetkili ".$request->db_sirket_unvani." şirket ünvanıyla bayi kaydı oluşturdu.","Bayi Paneli Kaydı");
            mailGonder("kampuslmsbayi@gmail.com","Merhabalar, ".$request->name." ".$request->surname." isimli yetkili ".$request->db_sirket_unvani." şirket ünvanıyla bayi kaydı oluşturdu.","Bayi Paneli Kaydı");
            
            mailGonder($request->email,"Sayın ". $request->name." ".$request->surname ."; Kampüs LMS bayilik başvurunuz ".Carbon::now()->format("d.m.y")." tarihinde tarafımıza başarıyla ulaşmıştır. Gerekli incelemenin ardından onay durumu daha sonra size bildirilecektir. Teşekkür ederiz. Kampüs LMS https://bayi.kampuslms.com","Kampüs LMS Bayilik Başvurusu");
            smsGonder("Sayın ". $request->name." ".$request->surname ."; Kampüs LMS bayilik başvurunuz ".Carbon::now()->format("d.m.y")." tarihinde tarafımıza başarıyla ulaşmıştır. Gerekli incelemenin ardından onay durumu daha sonra size bildirilecektir. Teşekkür ederiz. Kampüs LMS https://bayi.kampuslms.com",$request->db_cep_no);
            smsGonder("Sayın Yetkili, ". $request->name." ".$request->surname ." , ".$request->db_sirket_unvani." , ".$request->db_cep_no." ".Carbon::now()->format("d.m.y")." tarihinde bayilik başvurusu yapmıştır.","5307955054");

            return response()->json(['message' =>"Bayi başvurunuz başarıyla alınmıştır.Onay durumu ile ilgili ayrıca bilgi verilecektir.","status"=>true], 200);


        }catch(\Exception $e){
            debugSave( $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function registerSozlesmeCek(){
        return ["data"=>getSetting("hizmet_sozlemesi")]; 
    }
    public function ulkeGetir(){
        return tbl_ulke::get();
    }
    public function sehirGetir(Request $request){
        return tbl_sehir::where('ulke_id',"=",$request->ulke_id)->get();
    }
    public function ilceGetir(Request $request){
        return tbl_ilce::where('sehir_id',"=",$request->sehir_id)->get();
    }
    public function registerMailBilgilendirmesi(Request $request)
    {
        mailGonder("kodlooper@gmail.com","Merhabalar, Firma kayıt bilgileri dolduran bir müşteriniz bulunuyor. Mail Adresi: ".$request->email,"Bayi Paneli Ziyaretçisi");
        mailGonder("kampuslmsbayi@gmail.com","Merhabalar, Firma kayıt bilgileri dolduran bir müşteriniz bulunuyor. Mail Adresi: ".$request->email,"Bayi Paneli Ziyaretçisi");
    }

    public function sifremiUnuttum(Request $request)
    {
        $user = User::where('email',"=",$request->email)->first();
        $token = Password::createToken($user);
        $resetLink = url(config('app.url').route('password.reset', [
            'token' => $token,
            'email' => $user->getEmailForPasswordReset(),
        ], false));
        sifreSifirla($request->email,$resetLink,"Şifre Sıfırlama");
        return redirect()->back()->with("status","Şifre sıfırlama maili gönderilmiştir. Lütfen mailinizi kontrol ediniz.");
        return view("auth.passwords.reset")->with("token",$request->token);
        return $request->all();
    }

}
