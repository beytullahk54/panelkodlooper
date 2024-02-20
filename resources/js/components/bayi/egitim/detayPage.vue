<template>
    <div>
        <div class="modal-content" 
    style="width: 100%;">
            <div class="modal-header">
                <h1
                    class="modal-title fs-5"
                    id="exampleModalLabel"
                ></h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Kapat"
                ></button>
            </div>
            <div class="modal-body">
                <a class="btn btn-primary" href="/bayi/egitim">Geri Dön</a><br><br><br>
                <!--{{ data }}-->
                <table>
                    
                <thead>
                    <tr>
                        <th scope="col" style="width: 270px;">BAŞLIK</th>
                        <th scope="col">AÇIKLAMALAR</th>
                    </tr>
                </thead>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr v-if="data.db_gorsel"><td><b>GÖRSEL </b></td><td >: <img  :src="'/'+data.db_gorsel" style="width:150px" alt=""><a :href="'/'+data.db_gorsel" class="pl-5" download=""><img width="48" style="" height="48" src="https://img.icons8.com/fluency/48/download.png" alt="download"/></a>
                                    
                                </td></tr><br>
                    <tr v-if="data.db_gorsel"><td><b>EĞİTİM/PROGRAM ADI </b></td><td>: {{ data.db_adi }}</td></tr>
                    <tr  v-if="data.db_ingilizce_adi"><td><b>EĞİTİM/PROGRAM İNGİLİZCE ADI </b></td><td>: {{ data.db_ingilizce_adi }}</td></tr>
                    <tr  v-if="data.db_egitim_kodu"><td><b>KATEGORİ ADI </b></td><td>: {{ data.db_egitim_kodu }}</td></tr>
                    <tr  v-if="data.db_kategori"><td><b>KATEGORİ SINIFI </b></td><td>: {{ data.db_kategori?JSON.parse(data.db_kategori).db_adi:"" }}</td></tr>
                    <tr  v-if="data.db_kategori"><td><b>KATEGORİ KODU </b></td><td>: {{ data.db_kategori?JSON.parse(data.db_kategori).id:"" }}</td></tr>
                    <tr  v-if="data.db_universite"><td><b>KURUM </b></td>
                        <td> : 
                             <span v-for="kurum in JSON.parse(data.db_universite)">{{kurum.db_adi}}</span>
                        </td>
                    </tr>
                    <tr  v-if="data.db_edevlet_onayi"><td><b>E-DEVLET ONAYI </b></td><td>: {{ data.db_edevlet_onayi=="var"?"Var":"Yok" }}</td></tr>
                    <tr  v-if="data.db_ulusal_gecerlilik"><td><b>ULUSAL GEÇERLİLİK </b></td><td>: {{ data.db_ulusal_gecerlilik=="var"?"Var":"Yok" }}</td></tr>
                    <tr  v-if="data.db_uluslararasi_onayi"><td><b>ULUSLARARASI GEÇERLİLİK </b></td><td>: {{ data.db_uluslararasi_onayi=="var"?"Var":"Yok" }}</td></tr>

                    <tr  v-if="data.db_bayi_alis_fiyati"><td><b>BAYİ ALIŞ FİYATI </b></td><td>: {{ data.db_bayi_alis_fiyati }} ₺</td></tr>
                    <tr  v-if="data.db_min_tavsiye_satis_fiyati"><td><b>BAYİ TAVSİYE SATIŞ FİYATI </b></td><td>: {{ data.db_min_tavsiye_satis_fiyati }} ₺</td></tr>
                    <tr  v-if="data.db_liste_satis_fiyati"><td><b>BAYİ LİSTE SATIŞ FİYATI </b></td><td>: {{ data.db_liste_satis_fiyati }} ₺</td></tr>
                    <tr  v-if="data.db_sertifika_turu"><td><b>SERTİFİKA TÜRÜ </b></td>
                        <td>: 
                            <span v-if="data.db_sertifika_turu=='egitim'">Eğitim Sertifikası</span>
                            <span v-if="data.db_sertifika_turu=='katilim'">Katılım Sertifikası</span>
                            <span v-if="data.db_sertifika_turu=='seminer'">Seminer Sertifikası</span>
                            <span v-if="data.db_sertifika_turu=='kurs_bitirme_belgesi'">Kurs Bitirme Belgesi </span>
                            <span v-if="data.db_sertifika_turu=='uluslararasi_onayli_sertifika'">Uluslararası Onaylı Sertifika</span>
                            <span v-if="data.db_sertifika_turu=='uzmanlik_sertifika'">Uzmanlık Sertifikası</span>
                            <span v-if="data.db_sertifika_turu=='egitmenlik_sertifika'">Eğitmenlik Sertifikası</span>
                            <span v-if="data.db_sertifika_turu=='egiticinin_egitimi_sertifikasi'">Eğiticinin Eğitimi Sertifikası</span>
                            <span v-if="data.db_sertifika_turu=='kalfalik_sertifika'">Kalfalık Sertifikası</span>
                            <span v-if="data.db_sertifika_turu=='ustalik_sertifikasi'">Ustalık Sertifikası</span>
                            <span v-if="data.db_sertifika_turu=='usta_ogreticilik_sertifikasi'">Usta Öğreticilik Sertifikası</span>
                            <span v-if="data.db_sertifika_turu=='temel_egitim_sertifikasi'">Temel Eğitim Sertifikası</span>
                            <span v-if="data.db_sertifika_turu=='kisisel_gelisim_sertifikasi'">Kişisel Gelişim Sertifikası</span>
                            <span v-if="data.db_sertifika_turu=='sertifikasiz'">Sertifikasız</span>
                            <span v-if="data.db_sertifika_turu=='diger'">Diğer</span>
                            <span v-if="data.db_sertifika_turu=='belirtilmedi'">Belirtilmedi</span>
                        </td>
                    </tr>
                    <tr  v-if="data.db_sertifika_saati"><td><b>SERTİFİKA SAATİ </b></td><td>: {{ data.db_sertifika_saati }}</td></tr>
                    <tr  v-if="data.db_egitim_suresi"><td><b>EĞİTİM/PROGRAM SÜRESİ </b></td><td>: {{ data.db_egitim_suresi }} Gün</td></tr>
                    <tr  v-if="data.db_egitim_dili"><td><b>EĞİTİM/PROGRAM DİLİ </b></td>
                        <td>:
                            <span v-if="data.db_egitim_dili=='turkce'">Türkçe</span>
                            <span v-if="data.db_egitim_dili=='ingilizce'">İngilizce</span>
                            <span v-if="data.db_egitim_dili=='turkce_ingilizce_karma'">Türkçe ve İngilizce Karma</span>
                            <span v-if="data.db_egitim_dili=='turkce_ingilizce_secmeli'">Türkçe ve İngilizce Seçmeli</span>
                            <span v-if="data.db_egitim_dili=='karma'">Karma</span>
                            <span v-if="data.db_egitim_dili=='diger'">Diğer</span>
                            <span v-if="data.db_egitim_dili=='belirtilmedi'">Belirtilmedi</span>
                        </td>
                    </tr>
                    <tr  v-if="data.db_egitim_yontemi"><td><b>EĞİTİM/PROGRAM YÖNTEMİ </b></td>
                        <td>: 

                            <span v-if="data.db_egitim_yontemi == 'online_video'">Online (video)</span>
                            <span v-if="data.db_egitim_yontemi == 'online_canli'">Online (canlı)</span>
                            <span v-if="data.db_egitim_yontemi == 'online_karma'">Online (karma)</span>
                            <span v-if="data.db_egitim_yontemi == 'orgun'">Örgün</span>
                            <span v-if="data.db_egitim_yontemi == 'interaktif'">İnteraktif</span>
                            <span v-if="data.db_egitim_yontemi == 'hibrit'">Hibrit</span>
                            <span v-if="data.db_egitim_yontemi == 'dokuman'">Doküman</span>
                            <span v-if="data.db_egitim_yontemi == 'belirtilmedi'">Belirtilmedi</span>
                            
                        </td>
                    </tr>
                    <tr  v-if="data.db_egitim_yeri"><td><b>EĞİTİM/PROGRAM Yeri ve Tarihi </b></td><td>: {{ data.db_egitim_yeri }}</td></tr>
                    <tr  v-if="data.db_icerik_turu"><td><b>İÇERİK TÜRÜ </b></td><td>: 

                        <span v-if="data.db_icerik_turu=='video_ders'">Video Ders</span>
                        <span v-if="data.db_icerik_turu=='video_ders_sertifika'">Video Ders + Sertifika</span>
                        <span v-if="data.db_icerik_turu=='video_ders_sinav_sertifika'">Video Ders + Sınav + Sertifika</span>
                        <span v-if="data.db_icerik_turu=='video_ders_pdf_sertifika'">Video Ders + PDF + Sertifika</span>
                        <span v-if="data.db_icerik_turu=='video_ders_pdf_sinav_sertifika'">Video Ders + PDF + Sınav + Sertifika</span>
                        <span v-if="data.db_icerik_turu=='canli_ders'">Canlı Ders</span>
                        <span v-if="data.db_icerik_turu=='canli_ders_sertifika'">Canlı Ders + Sertifika</span>
                        <span v-if="data.db_icerik_turu=='canli_ders_sinav_sertifika'">Canlı Ders + Sınav + Sertifika</span>
                        <span v-if="data.db_icerik_turu=='canli_ders_pdfsertifika'">Canlı Ders + PDF + Sertifika</span>
                        <span v-if="data.db_icerik_turu=='canli_ders_pdf_sinav_sertifika'">Canlı Ders + PDF + Sınav + Sertifika</span>
                        <span v-if="data.db_icerik_turu=='orgun_ders'">Örgün Ders</span>
                        <span v-if="data.db_icerik_turu=='orgun_ders_sertifika'">Örgün Ders + Sertifika</span>
                        <span v-if="data.db_icerik_turu=='orgun_ders_sinav_sertifika'">Örgün Ders + Sınav + Sertifika</span>
                        <span v-if="data.db_icerik_turu=='orgun_ders_pdf_sertifika'">Örgün Ders + PDF + Sertifika</span>
                        <span v-if="data.db_icerik_turu=='orgun_ders_pdf_sinav_sertifika'">Örgün Ders + PDF + Sınav + Sertifika</span>
                        <span v-if="data.db_icerik_turu=='interaktif_ders'">İnteraktif Ders</span>
                        <span v-if="data.db_icerik_turu=='interaktif_ders_sertifika'">İnteraktif Ders + Sertifika</span>
                        <span v-if="data.db_icerik_turu=='interaktif_ders_sinav_sertifika'">İnteraktif Ders + Sınav + Sertifika</span>
                        <span v-if="data.db_icerik_turu=='interaktif_ders_pdf_sertifika'">İnteraktif Ders + PDF + Sertifika</span>
                        <span v-if="data.db_icerik_turu=='interaktif_ders_pdf_sinav_sertifika'">İnteraktif Ders + PDF + Sınav + Sertifika</span>
                        <span v-if="data.db_icerik_turu=='hibrit_ders'">Hibrit Ders</span>
                        <span v-if="data.db_icerik_turu=='hibrit_ders_sertifika'">Hibrit Ders + Sertifika</span>
                        <span v-if="data.db_icerik_turu=='hibrit_ders_sinav_sertifika'">Hibrit Ders + Sınav + Sertifika</span>
                        <span v-if="data.db_icerik_turu=='hibrit_ders_pdfsertifika'">Hibrit Ders + PDF + Sertifika</span>
                        <span v-if="data.db_icerik_turu=='hibrit_ders_pdf_sinav_sertifika'">Hibrit Ders + PDF + Sınav + Sertifika</span>
                        <span v-if="data.db_icerik_turu=='ozel_ders'">Özel Ders</span>
                        <span v-if="data.db_icerik_turu=='ozel_ders_sertifika'">Özel Ders + Sertifika</span>
                        <span v-if="data.db_icerik_turu=='ozel_ders_sinav_sertifika'">Özel Ders + Sınav + Sertifika</span>
                        <span v-if="data.db_icerik_turu=='ozel_ders_pdfsertifika'">Özel Ders + PDF + Sertifika</span>
                        <span v-if="data.db_icerik_turu=='ozel_ders_pdf_sinav_sertifika'">Özel Ders + PDF + Sınav + Sertifika</span>
                        <span v-if="data.db_icerik_turu=='ders_notu'">Ders Notu</span>
                        <span v-if="data.db_icerik_turu=='ders_notu_sertifika'">Ders Notu + Sertifika</span>
                        <span v-if="data.db_icerik_turu=='ders_notu_sinav_sertifika'">Ders Notu + Sınav + Sertifika</span>
                        <span v-if="data.db_icerik_turu=='belirtilmedi'">Belirtilmedi</span>
                    </td></tr>
                    <tr  v-if="data.db_video_sayisi"><td><b>VİDEO DERS SAYISI </b></td><td>: {{ data.db_video_sayisi }}</td></tr>
                    <tr  v-if="data.db_canli_ders_sayisi"><td><b>CANLI DERS SAYISI </b></td><td>: {{ data.db_canli_ders_sayisi }}</td></tr>
                    <tr  v-if="data.db_orgun_ders_sayisi"><td><b>ÖRGÜN DERS SAYISI </b></td><td>: {{ data.db_orgun_ders_sayisi }}</td></tr>
                    <tr  v-if="data.db_interaktif_ders_sayisi"><td><b>İNTERAKTİF Ders SAYISI </b></td><td>: {{ data.db_interaktif_ders_sayisi }}</td></tr>
                    <tr  v-if="data.db_hibrit_ders_sayisi"><td><b>HİBRİT DERS SAYISI </b></td><td>: {{ data.db_hibrit_ders_sayisi }}</td></tr>
                    <tr  v-if="data.db_ozel_ders_sayisi"><td><b>ÖZEL Ders SAYISI </b></td><td>: {{ data.db_ozel_ders_sayisi }}</td></tr>
                    <tr  v-if="data.db_ders_notu_sayisi"><td><b>DERS NOTU SAYISI </b></td><td>: {{ data.db_ders_notu_sayisi }}</td></tr>
                    <tr  v-if="data.db_ders_notu_toplam_sayfa_sayisi"><td><b>DERS NOTU Toplam Sayfa SAYISI </b></td><td>: {{ data.db_ders_notu_toplam_sayfa_sayisi }}</td></tr>
                    <tr  v-if="data.db_sinav_sayisi"><td><b>SINAV SAYISI </b></td><td>: {{ data.db_sinav_sayisi }}</td></tr>
                    <tr  v-if="data.db_odev_sayisi"><td><b>ÖDEV SAYISI </b></td><td>: {{ data.db_odev_sayisi }}</td></tr>
                    <tr  v-if="data.db_proje_sayisi"><td><b>PROJE SAYISI </b></td><td>: {{ data.db_proje_sayisi }}</td></tr>
                    <tr  v-if="data.db_sozlu_sayisi"><td><b>SÖZLÜ SAYISI </b></td><td>: {{ data.db_sozlu_sayisi }}</td></tr>
                    <tr  v-if="data.db_uygulama_sayisi"><td><b>UYGULAMA SAYISI </b></td><td>: {{ data.db_uygulama_sayisi }}</td></tr>
                    <tr  v-if="data.db_sertifika_sayisi"><td><b>SERTİFİKA SAYISI </b></td><td>: {{ data.db_sertifika_sayisi }}</td></tr>
                    <tr  v-if="data.db_kontenjan_sayisi"><td><b>KONTENJAN SAYISI </b></td><td>: {{ data.db_kontenjan_sayisi }}</td></tr><br>
                    <tr  v-if="data.db_egitim_hakkinda"><td colspan="2"><b>EĞİTİM/PROGRAM HAKKINDA :</b><br> <span v-html="''+data.db_egitim_hakkinda"/></td></tr>
                    <tr  v-if="data.db_egitim_icerigi"><td colspan="2"><b>EĞİTİM/PROGRAM İÇERİĞİ :</b><br> <span v-html="data.db_egitim_icerigi"/></td></tr>
                    <tr  v-if="data.db_aciklamalar"><td colspan="2"><b>AÇIKLAMALAR </b>:<br> <span v-html="data.db_aciklamalar"/></td></tr>
                    

                </table>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            data:{}
        };
    },
    props: {
        id:String,
        modal: Object,
    },
    mounted(){
        this.getData()
    },
    methods: {
        getData(){
            axios.post("/admin/egitim/getData",{id:this.id}).then(response=>{
                this.data = response.data.data
            })
        },
        kaydetClicked() {
            // Modal içinde "Kaydet" butonuna tıklandığında bu metod çalışacak
            this.$emit("kaydet", { data: this.data });
        },
    },
};
</script>
