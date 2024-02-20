<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_egitim extends Model
{
    use HasFactory;

    protected $fillable = [
        "db_gorsel",
        'db_adi',
        'db_ingilizce_adi',
        'db_egitmenler',
        'db_basvuru_durumu',
        'db_kategori',
        'db_universite',
        'db_bayi_alis_fiyati',
        'db_min_tavsiye_satis_fiyati',
        'db_liste_satis_fiyati',
        'db_edevlet_onayi',
        'db_sertifika_turu',
        'db_sertifika_saati',
        'db_egitim_suresi',
        'db_egitim_dili',
        'db_transkript',
        'db_yabanci_dil_sertifika',
        'db_egitim_yonetimi',
        'db_icerik_turu',
        'db_video_sayisi',
        'db_pdf_kitap_sayisi',
        'db_pdf_sayfa_sayisi',
        'db_interaktif_ders_sayisi',
        'db_sinav_sayisi',
        'db_egitim_hakkinda',
        'db_egitim_icerigi',
        'db_aciklamalar',
        'db_egitim_yeri',
        'db_egitim_kodu',
        'db_canli_ders_sayisi',
        'db_orgun_ders_sayisi',
        'db_hibrit_ders_sayisi',
        'db_ozel_ders_sayisi',
        'db_ders_notu_toplam_sayfa_sayisi',
        'db_odev_sayisi',
        'db_proje_sayisi',
        'db_sozlu_sayisi',
        'db_uygulama_sayisi',
        'db_kontenjan_sayisi',
        'db_icerik_ureticileri',
        'db_uluslararasi_onayi',
        'db_egitmenler',
        'db_egitmen_ozgecmis',
        'db_egitmen_sozlesme',
        'db_sertifika_sayisi',
        'db_ders_notu_sayisi',
        'db_firma_id',
        "db_bayi_onay_durumu"
    ];



    public function firma()
    {
		  return $this->hasOne(\App\Models\tbl_firma::class, 'id','db_firma_id');
    }
}
