<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Hash;

class VersionController extends Controller
{
    public function index($erisim = null)
    {
        ini_set('memory_limit', '1024M');
        if ($erisim == null) {
            return 'Erişiminiz yok';
        } elseif ($erisim == 'kodlooper@19') {
            /*$this->version20211201();
            $this->version20211214();
            $this->version20231030();
            $this->version20231103();
            $this->version20231107();
            $this->version20231110();
            $this->version20231120();
            $this->version20231125();*/
            $this->version2024221();
            
           
            //return "Toplam Öğrenci sayısı:".$nowDay." <br> Bugün eklenen öğrenci sayısı  ".$nowStudentCount." <br> Toplam Sertifika Verilen Katılımcı  version20201228 Veritabanı güncellemeleri başarılı";
            return "Güncelleme başarılı oldu";
        }
    }
    public function pull(Request $request)
    {
        // Güvenlik kontrolü yapabilirsiniz, örneğin sadece belirli bir IP'den gelen isteklere izin verebilirsiniz.
        // if ($request->ip() == 'izinli-ip-adresi') {
        //     return response('Unauthorized.', 401);
        // }

        // Git pull işlemini gerçekleştir.

        //$gitPath = '/var/www/vhosts/kampuslms.com/panel.kampuslms.com'; // Git deposunun bulunduğu dizin
        $process = new Process(['git', 'pull']);
        //$process->setWorkingDirectory($gitPath);
        $process->setTimeout(3600);

        try {
            $process->mustRun();
            $output = $process->getOutput();
        } catch (ProcessFailedException $exception) {
            $output = $exception->getMessage();
        }

        // Sonucu döndür (isteğe bağlı).
        return response()->json([
            'output' => $output,
        ]);
    }
    public function userCreate($name,$username,$password)
    {
        tbl_katilimcilar::create([
            'name' => $name,
            'email' => $username
        ]);
    }
    public function version2024221()
    {


        if (!Schema::hasTable('tbl_projects')) {
            Schema::create('tbl_projects', function (Blueprint $table) {
                $table->increments('id');
                $table->string('db_firma_id')->nullable();
                $table->string('db_adi')->nullable();
                $table->string('db_durumu')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasColumn('tbl_projects', 'db_project_start_date')) {
            Schema::table('tbl_projects', function (Blueprint $table) {
                $table->date('db_project_start_date')->nullable();
                $table->date('db_project_end_date')->nullable();
            });
        }   
    }  
    public function version20231125()
    {

        if (!Schema::hasColumn('tbl_varyants', 'db_order')) {
            Schema::table('tbl_varyants', function (Blueprint $table) {
                $table->string('db_order')->nullable();
            });
        }   
        if (!Schema::hasColumn('tbl_katilimcis', 'db_ulke')) {
            Schema::table('tbl_katilimcis', function (Blueprint $table) {
                $table->string('db_ulke')->after("db_adres")->nullable();
                $table->string('db_sehir')->after("db_ulke")->nullable();
                $table->string('db_ilce')->after("db_sehir")->nullable();
            });
        }   
        
        if (!Schema::hasColumn('tbl_katilimcis', 'db_program_obj')) {
            Schema::table('tbl_katilimcis', function (Blueprint $table) {
                $table->json('db_program_obj')->after("db_ilce")->nullable();
                $table->json('db_ilce_obj')->after("db_ilce")->nullable();
                $table->json('db_ulke_obj')->after("db_ilce")->nullable();
                $table->json('db_sehir_obj')->after("db_ilce")->nullable();
            });
        }
        if (!Schema::hasColumn('tbl_katilimcis', 'db_uyruk')) {
            Schema::table('tbl_katilimcis', function (Blueprint $table) {
                $table->string('db_uyruk')->after("db_sehir_obj")->nullable();
            });
        }
        if (!Schema::hasColumn('tbl_katilimcis', 'db_tarih_araligi')) {
            Schema::table('tbl_katilimcis', function (Blueprint $table) {
                $table->string('db_tarih_araligi')->after("db_sehir_obj")->nullable();
            });
        }
        if (!Schema::hasColumn('tbl_katilimcis', 'db_katilimci_dosya')) {
            Schema::table('tbl_katilimcis', function (Blueprint $table) {
                $table->json('db_katilimci_dosya')->after("db_sehir_obj")->nullable();
            });
        }
        if (!Schema::hasColumn('tbl_katilimcis', 'db_katilimci_dosya2')) {
            Schema::table('tbl_katilimcis', function (Blueprint $table) {
                $table->string('db_katilimci_dosya2')->after("db_katilimci_dosya")->nullable();
            });
        }   
        if (!Schema::hasColumn('tbl_katilimcis', 'db_bayi_not')) {
            Schema::table('tbl_katilimcis', function (Blueprint $table) {
                $table->text('db_bayi_not')->after("db_katilimci_dosya")->nullable();
            });
        }   
        if (!Schema::hasColumn('tbl_katilimcis', 'db_katilimci_durum')) {
            Schema::table('tbl_katilimcis', function (Blueprint $table) {
                $table->json('db_katilimci_durum')->after("db_bayi_not")->nullable();
            });
        }   
        

        if (!Schema::hasTable('password_resets')) {
            Schema::create('password_resets', function (Blueprint $table) {
                $table->string('email')->index();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
            });
        }
        if (!Schema::hasColumn('tbl_firmas', 'sirket_kurumsal_sahis')) {
            Schema::table('tbl_firmas', function (Blueprint $table) {
                $table->string('sirket_kurumsal_sahis')->after("db_sirket_turu")->nullable();
            });
        }
        if (!Schema::hasColumn('tbl_firmas', 'db_ulke_obj')) {
            Schema::table('tbl_firmas', function (Blueprint $table) {
                $table->json('db_ulke_obj')->after("sirket_kurumsal_sahis")->nullable();
                $table->json('db_sehir_obj')->after("db_ulke_obj")->nullable();
                $table->json('db_ilce_obj')->after("db_sehir_obj")->nullable();
            });
        }
        if (!Schema::hasColumn('tbl_firmas', 'db_min_bakiye')) {
            Schema::table('tbl_firmas', function (Blueprint $table) {
                $table->json('db_min_bakiye')->after("sirket_kurumsal_sahis")->nullable();
            });
        }

        if (!Schema::hasColumn('tbl_desteks', 'db_gorsel')) {
            Schema::table('tbl_desteks', function (Blueprint $table) {
                $table->string('db_gorsel')->after("db_destek_durumu")->nullable();
            });
        }   
        if (!Schema::hasColumn('tbl_bakiyes', 'db_islem_yapan_id')) {
            Schema::table('tbl_bakiyes', function (Blueprint $table) {
                $table->string('db_islem_yapan_id')->after("db_firma_id")->nullable();
            });
        }

        if (!Schema::hasColumn('tbl_katilimcis', 'db_satis_sitesi')) {
            Schema::table('tbl_katilimcis', function (Blueprint $table) {
                $table->json('db_satis_sitesi')->after("db_genel_toplam")->nullable();
                $table->json('db_site_odeme_turu')->after("db_satis_sitesi")->nullable();
            });
        }

        if (!Schema::hasColumn('tbl_destek_cevaplars', 'db_destek_dosya')) {
            Schema::table('tbl_destek_cevaplars', function (Blueprint $table) {
                $table->json('db_destek_dosya')->after("db_destek_mesaj")->nullable();
            });
        }
        
    }
    public function version20231120()
    {
     
        if (!Schema::hasColumn('tbl_katilimcis', 'db_baslama_tarihi')) {
            Schema::table('tbl_katilimcis', function (Blueprint $table) {
                $table->string('db_baslama_tarihi')->after("db_program_id")->nullable();
                $table->string('db_bitis_tarihi')->after("db_baslama_tarihi")->nullable();
            });
        }
        if (!Schema::hasColumn('tbl_egitims', 'db_bayi_onay_durumu')) {
            Schema::table('tbl_egitims', function (Blueprint $table) {
                $table->string('db_bayi_onay_durumu')->after("db_basvuru_durumu")->nullable();
            });
        }
        if (!Schema::hasColumn('tbl_bakiyes', 'db_iyzico_id')) {
            Schema::table('tbl_bakiyes', function (Blueprint $table) {
                $table->string('db_iyzico_id')->after("db_odeme_durumu")->nullable();
            });
        }
        if (!Schema::hasColumn('tbl_egitims', 'db_firma_id')) {
            Schema::table('tbl_egitims', function (Blueprint $table) {
                $table->string('db_firma_id')->after("db_ders_notu_sayisi")->nullable();
            });
        }
    }
    public function version20231110()
    {

        if (!Schema::hasColumn('tbl_firmas', 'db_ilce')) {
            Schema::table('tbl_firmas', function (Blueprint $table) {
                $table->string('db_ilce')->after("db_sirket_turu")->nullable();
            });
        }

        if (!Schema::hasTable('tbl_duyurus')) {
            Schema::create('tbl_duyurus', function (Blueprint $table) {
                $table->increments('id');
                $table->string('db_adi')->nullable();
                $table->string('db_aciklama')->nullable();
                $table->string('db_tip')->nullable();
                $table->string('db_hedef_firma_id')->nullable();
                $table->string('db_user_id')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasColumn('tbl_firmas', 'db_tc_pasaport')) {
            Schema::table('tbl_firmas', function (Blueprint $table) {
                $table->string('db_tc_pasaport')->after("db_sirket_turu")->nullable();
            });
        }

        if (!Schema::hasColumn('tbl_katilimcis', 'db_siparis_not')) {
            Schema::table('tbl_katilimcis', function (Blueprint $table) {
                $table->string('db_siparis_not')->after("db_genel_toplam")->nullable();
            });
        }

        if (!Schema::hasColumn('tbl_firmas', 'db_yetkili_email')) {
            Schema::table('tbl_firmas', function (Blueprint $table) {
                $table->string('db_yetkili_email')->after("db_dogum_tarihi")->nullable();
            });
        }
        if (!Schema::hasColumn('users', 'surname')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('surname')->after("name")->nullable();
            });
        }
        
        if (!Schema::hasColumn('tbl_firmas', 'db_dogum_tarihi')) {
            Schema::table('tbl_firmas', function (Blueprint $table) {
                $table->string('db_dogum_tarihi')->after("firma_yetkili")->nullable();
                $table->string('db_yetkili_uyrugu')->after("db_dogum_tarihi")->nullable();
                $table->string('db_cep_no')->after("db_dogum_tarihi")->nullable();
                $table->string('db_ulke')->after("db_dogum_tarihi")->nullable();
                $table->string('db_sehir')->after("db_dogum_tarihi")->nullable();
                $table->string('db_sirket_turu')->after("db_dogum_tarihi")->nullable();
                $table->string('db_sirket_unvani')->after("db_dogum_tarihi")->nullable();
                $table->stringlo('db_sirket_adresi')->after("db_dogum_tarihi")->nullable();
                $table->string('db_sirket_vergi_no')->after("db_dogum_tarihi")->nullable();
                $table->string('db_sirket_dairesi')->after("db_dogum_tarihi")->nullable();
                $table->string('db_sirket_web_adresi')->after("db_dogum_tarihi")->nullable();
                $table->string('db_sosyal_medya_hesabi')->after("db_dogum_tarihi")->nullable();
            });
        }
        if (!Schema::hasColumn('tbl_firmas', 'db_kimlik_on_yuzu')) {
            Schema::table('tbl_firmas', function (Blueprint $table) {
                $table->string('db_kimlik_on_yuzu')->after("db_dogum_tarihi")->nullable();
                $table->string('db_ikametgah')->after("db_dogum_tarihi")->nullable();
                $table->string('db_vergi_levhasi')->after("db_dogum_tarihi")->nullable();
            });
        }
        
        if (!Schema::hasColumn('tbl_egitims', 'db_sertifika_sayisi')) {
            Schema::table('tbl_egitims', function (Blueprint $table) {
                $table->string('db_sertifika_sayisi')->after("db_uluslararasi_onayi")->nullable();
                $table->string('db_ders_notu_sayisi')->after("db_uluslararasi_onayi")->nullable();
            });
        }
        if (!Schema::hasColumn('tbl_egitims', 'db_egitmenler')) {
            Schema::table('tbl_egitims', function (Blueprint $table) {
                $table->string('db_egitmenler')->after("db_uluslararasi_onayi")->nullable();
            });
        }
        if (!Schema::hasColumn('tbl_egitims', 'db_egitmen_ozgecmis')) {
            Schema::table('tbl_egitims', function (Blueprint $table) {
                $table->string('db_egitmen_ozgecmis')->after("db_egitmenler")->nullable();
            });
        }
        if (!Schema::hasColumn('tbl_egitims', 'db_egitmen_sozlesme')) {
            Schema::table('tbl_egitims', function (Blueprint $table) {
                $table->string('db_egitmen_sozlesme')->after("db_egitmen_ozgecmis")->nullable();
            });
        }
        if (!Schema::hasColumn('tbl_egitims', 'db_egitim_yeri')) {
            Schema::table('tbl_egitims', function (Blueprint $table) {
                $table->string('db_egitim_yeri')->after("db_egitim_dili")->nullable();
                $table->string('db_egitim_kodu')->after("db_egitim_yeri")->nullable();
                $table->string('db_canli_ders_sayisi')->after("db_video_sayisi")->nullable();
                $table->string('db_orgun_ders_sayisi')->after("db_canli_ders_sayisi")->nullable();
                $table->string('db_hibrit_ders_sayisi')->after("db_orgun_ders_sayisi")->nullable();
                $table->string('db_ozel_ders_sayisi')->after("db_hibrit_ders_sayisi")->nullable();
                $table->string('db_ders_notu_toplam_sayfa_sayisi')->after("db_ozel_ders_sayisi")->nullable();
                $table->string('db_odev_sayisi')->after("db_ders_notu_toplam_sayfa_sayisi")->nullable();
                $table->string('db_proje_sayisi')->after("db_odev_sayisi")->nullable();
                $table->string('db_sozlu_sayisi')->after("db_proje_sayisi")->nullable();
                $table->string('db_uygulama_sayisi')->after("db_sozlu_sayisi")->nullable();
                $table->string('db_kontenjan_sayisi')->after("db_uygulama_sayisi")->nullable();
                $table->string('db_icerik_ureticileri')->after("db_kontenjan_sayisi")->nullable();
            });
        }
    }
    public function version20231107()
    {

        if (!Schema::hasTable('tbl_destek_cevaplars')) {
            Schema::create('tbl_destek_cevaplars', function (Blueprint $table) {
                $table->increments('id');
                $table->string('db_destek_id')->nullable();
                $table->string('db_destek_user_id')->nullable();
                $table->string('db_destek_gonderen_tipi')->nullable();
                $table->string('db_destek_mesaj')->nullable();
                $table->string('db_firma_id')->nullable();
                $table->timestamps();
            });
        }
    }
    public function version20231103()
    {
        if (!Schema::hasTable('tbl_firma_bakiyes')) {
            Schema::create('tbl_firma_bakiyes', function (Blueprint $table) {
                $table->increments('id');
                $table->string('db_firma_id')->nullable();
                $table->string('db_bakiye')->nullable();
                $table->timestamps();
                
            });
        }
        if (!Schema::hasTable('tbl_debugs')) {
            Schema::create('tbl_debugs', function (Blueprint $table) {
                $table->increments('id');
                $table->string('debug')->nullable();
                $table->timestamps();
                
            });
        }
    
    }

    public function version20231030()
    {
        if (!Schema::hasTable('tbl_katilimcis')) {
            Schema::create('tbl_katilimcis', function (Blueprint $table) {
                $table->increments('id');
                $table->string('db_firma_id')->nullable();
                $table->string('db_user_id')->nullable();
                $table->string('db_adi')->nullable();
                $table->string('db_soyadi')->nullable();
                $table->string('db_dogum_tarihi')->nullable();
                $table->string('db_tc_pasaport')->nullable();
                $table->string('db_cep_no')->nullable();
                $table->string('db_email')->nullable();
                $table->string('db_adres')->nullable();
                $table->string('firma_durum')->nullable()->comment('Firma Durumu');
                $table->string('db_program_id')->nullable();
                $table->string('db_program_adi')->nullable();
                $table->string('db_universite')->nullable();
                $table->string('db_varyant')->nullable();
                $table->string('db_program_ucret')->nullable();
                $table->string('db_varyant_toplam_ucret')->nullable();
                $table->string('db_genel_toplam')->nullable();
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('tbl_katilimcilar_egitims')) {
            Schema::create('tbl_katilimcilar_egitims', function (Blueprint $table) {
                $table->increments('id');
                $table->string('db_katilimci_id')->nullable();
                $table->string('db_egitim_id')->nullable();
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('tbl_katilimcilar_egitim_varyants')) {
            Schema::create('tbl_katilimcilar_egitim_varyants', function (Blueprint $table) {
                $table->increments('id');
                $table->string('db_katilimci_id')->nullable();
                $table->string('db_egitim_id')->nullable();
                $table->string('db_varyant_id')->nullable();
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('tbl_universites')) {
            Schema::create('tbl_universites', function (Blueprint $table) {
                $table->increments('id');
                $table->string('db_adi')->nullable();
                $table->string('db_logo')->nullable();
                $table->string('db_durum')->nullable();
                $table->string('db_edevlet')->nullable();
                $table->string('db_ulusal_gecerlilik')->nullable();
                $table->string('db_uluslararasi_gecerlilik')->nullable();
                $table->string('db_firma_durum')->nullable()->comment('Firma Durumu');
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('tbl_egitims')) {
            Schema::create('tbl_egitims', function (Blueprint $table) {
                $table->increments('id');
                $table->string('db_gorsel')->nullable();
                $table->string('db_adi')->nullable();
                $table->string('db_ingilizce_adi')->nullable();
                $table->string('db_egitmenler')->nullable();
                $table->string('db_basvuru_durumu')->nullable();
                $table->string('db_kategori')->nullable();
                $table->string('db_universite')->nullable();
                $table->string('db_bayi_alis_fiyati')->nullable();
                $table->string('db_min_tavsiye_satis_fiyati')->nullable();
                $table->string('db_liste_satis_fiyati')->nullable();
                $table->string('db_edevlet_onayi')->nullable();
                $table->string('db_sertifika_turu')->nullable();
                $table->string('db_sertifika_saati')->nullable();
                $table->string('db_egitim_suresi')->nullable();
                $table->string('db_egitim_dili')->nullable();
                $table->string('db_transkript')->nullable();
                $table->string('db_yabanci_dil_sertifika')->nullable();
                $table->string('db_egitim_yonetimi')->nullable();
                $table->string('db_icerik_turu')->nullable();
                $table->string('db_video_sayisi')->nullable();
                $table->string('db_pdf_kitap_sayisi')->nullable();
                $table->string('db_pdf_sayfa_sayisi')->nullable();
                $table->string('db_interaktif_ders_sayisi')->nullable();
                $table->string('db_sinav_sayisi')->nullable();
                $table->string('db_egitim_hakkinda')->nullable();
                $table->string('db_egitim_icerigi')->nullable();
                $table->string('db_aciklamalar')->nullable();
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('tbl_varyants')) {
            Schema::create('tbl_varyants', function (Blueprint $table) {
                $table->increments('id');
                $table->string('db_firma_id')->nullable();
                $table->string('db_adi')->nullable();
                $table->string('db_fiyati')->nullable();
                $table->string('db_durumu')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('tbl_bakiyes')) {
            Schema::create('tbl_bakiyes', function (Blueprint $table) {
                $table->increments('id');
                $table->string('db_firma_id')->nullable();
                $table->string('db_odeme_miktari')->nullable();
                $table->string('db_odeme_turu')->nullable();
                $table->string('db_odeme_durumu')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('tbl_ayarlars')) {
            Schema::create('tbl_ayarlars', function (Blueprint $table) {
                $table->increments('id');
                $table->string('db_key')->nullable();
                $table->string('db_value')->nullable();
                $table->string('db_aciklama')->nullable();
                $table->string('db_type')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('tbl_desteks')) {
            Schema::create('tbl_desteks', function (Blueprint $table) {
                $table->increments('id');
                $table->string('db_destek_konu')->nullable();
                $table->string('db_destek_aciklama')->nullable();
                $table->string('db_destek_gonderen')->nullable();
                $table->string('db_destek_durumu')->nullable();
                $table->string('db_firma_id')->nullable();
                $table->timestamps();
            });
        }
    }
    public function version20211214()
    {
        if (!Schema::hasTable('tbl_firmas')) {
            Schema::create('tbl_firmas', function (Blueprint $table) {
                $table->increments('id');
                $table->string('firma_adi')->nullable()->comment('Firma Adı');
                $table->string('firma_telefon')->nullable()->comment('Firma Telefon Numarası');
                $table->string('firma_yetkili')->nullable()->comment('Firma Yetkili Adı Soyadı');
                $table->string('bakiye')->nullable()->comment('Firma Bakiyesi');
                $table->string('firma_durum')->nullable()->comment('Firma Durumu');
                $table->timestamps();
            });
        }
    }
    public function version20211201()
    {
        /*if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable()->comment('Adı');
                $table->string('surname')->nullable()->comment('Soyadı');
                $table->string('email')->nullable()->comment('Email Adresi');
                $table->string('password')->nullable()->comment('Şifre ');
                $table->string('firma_id')->nullable()->comment('Firma İd');
                $table->string('remember_token')->nullable();
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('permissions')) {
            Schema::create('permissions', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable()->comment('Yetki Adı');
                $table->string('display_name')->nullable()->comment('Yetki Görünen Adı');
                $table->string('description')->nullable()->comment('Yetki Açıklama ');
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('role_user')) {
            Schema::create('role_user', function (Blueprint $table) {
                $table->increments('id');
                $table->string('user_id')->nullable()->comment('Kullanıcı id');
                $table->string('role_id')->nullable()->comment('Rol id');
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('roles')) {
            Schema::create('roles', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable()->comment('Rol Adı');
                $table->string('display_name')->nullable()->comment('Rol Görünen Adı');
                $table->string('description')->nullable()->comment('Rol Açıklama');
                $table->timestamps();
            });
        }
       
        $this->userCreate('admin','admin','kodlooper@19');
        if (!Schema::hasTable('permission_role')) {
            Schema::create('permission_role', function (Blueprint $table) {
                $table->increments('id');
                $table->string('permission_id')->nullable()->comment('Permission id');
                $table->string('role_id')->nullable()->comment('Role id');
                $table->timestamps();
            });
        }*/
    }
}
