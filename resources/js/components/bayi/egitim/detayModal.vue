<template>
    <div>
        <!-- Modal -->
        <div
            class="modal fade"
            id="exampleModal"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog  modal-xl" >
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
                        <!--{{ data }}-->
                        <table>
                            
                        <caption>Detaylar</caption>
                        <thead>
                            <tr>
                            <th scope="col">Başlık</th>
                            <th scope="col">Açıklama</th>
                            </tr>
                        </thead>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr v-if="data.db_gorsel"><td><b>GÖRSEL </b></td><td >: <img  :src="'/'+data.db_gorsel" style="width:300px" alt=""></td></tr>
                            <tr><td><b>EĞİTİM/PROGRAM ADI </b></td><td>: {{ data.db_adi }}</td></tr>
                            <tr><td><b>İNGİLİZCE EĞİTİM/PROGRAM ADI </b></td><td>: {{ data.db_ingilizce_adi }}</td></tr>
                            <tr><td><b>KATEGORİ ADI </b></td><td>: {{ data.db_egitim_kodu }}</td></tr>
                            <tr><td><b>KATEGORİ SINIFI </b></td><td>: {{ data.db_kategori?JSON.parse(data.db_kategori).db_adi:"" }}</td></tr>
                            <tr><td><b>KATEGORİ KODU </b></td><td>: {{ data.db_kategori?JSON.parse(data.db_kategori).id:"" }}</td></tr>
                            <tr><td><b>KURUM </b></td>
                                <td>
                                    <span v-for="kurum in JSON.parse(data.db_universite)">{{kurum.db_adi}}</span>
                                </td>
                            </tr>
                            <tr><td><b>E-DEVLET ONAYI </b></td><td>: {{ data.db_edevlet_onayi }}</td></tr>
                            <tr><td><b>ULUSAL GEÇERLİLİK </b></td><td>: {{ data.db_ulusal_gecerlilik }}</td></tr>
                            <tr><td><b>ULUSLARARASI GEÇERLİLİK </b></td><td>: {{ data.db_uluslararasi_onayi }}</td></tr>

                            <tr><td><b>BAYİ ALIŞ FİYATI </b></td><td>: {{ data.db_bayi_alis_fiyati }}</td></tr>
                            <tr><td><b>BAYİ TAVSİYE SATIŞ FİYATI </b></td><td>: {{ data.db_min_tavsiye_satis_fiyati }}</td></tr>
                            <tr><td><b>BAYİ LİSTE SATIŞ FİYATI </b></td><td>: {{ data.db_liste_satis_fiyati }}</td></tr>
                            <tr><td><b>SERTİFİKA TÜRÜ </b></td><td>: {{ data.db_sertifika_turu }}</td></tr>
                            <tr><td><b>SERTİFİKA SAATİ </b></td><td>: {{ data.db_sertifika_saati }}</td></tr>
                            <tr><td><b>EĞİTİM/PROGRAM SÜRESİ </b></td><td>: {{ data.db_egitim_suresi }} Gün</td></tr>
                            <tr><td><b>EĞİTİM/PROGRAM DİLİ </b></td><td>: {{ data.db_egitim_dili }}</td></tr>
                            <tr><td><b>EĞİTİM/PROGRAM YÖNTEMİ </b></td><td>: {{ data.db_egitim_yonetemi }}</td></tr>
                            <tr><td><b>EĞİTİM/PROGRAM Yeri ve Tarihi </b></td><td>: {{ data.db_egitim_yeri }}</td></tr>
                            <tr><td><b>İÇERİK TÜRÜ </b></td><td>: {{ data.db_icerik_turu }}</td></tr>
                            <tr><td><b>VİDEO DERS SAYISI </b></td><td>: {{ data.db_video_sayisi }}</td></tr>
                            <tr><td><b>CANLI DERS SAYISI </b></td><td>: {{ data.db_canli_ders_sayisi }}</td></tr>
                            <tr><td><b>ÖRGÜN DERS SAYISI </b></td><td>: {{ data.db_orgun_ders_sayisi }}</td></tr>
                            <tr><td><b>İNTERAKTİF Ders SAYISI </b></td><td>: {{ data.db_interaktif_ders_sayisi }}</td></tr>
                            <tr><td><b>HİBRİT DERS SAYISI </b></td><td>: {{ data.db_hibrit_ders_sayisi }}</td></tr>
                            <tr><td><b>ÖZEL Ders SAYISI </b></td><td>: {{ data.db_ozel_ders_sayisi }}</td></tr>
                            <tr><td><b>DERS NOTU SAYISI </b></td><td>: {{ data.db_ders_notu_sayisi }}</td></tr>
                            <tr><td><b>DERS NOTU Toplam Sayfa SAYISI </b></td><td>: {{ data.db_ders_notu_toplam_sayfa_sayisi }}</td></tr>
                            <tr><td><b>SINAV SAYISI </b></td><td>: {{ data.db_sinav_sayisi }}</td></tr>
                            <tr><td><b>ÖDEV SAYISI </b></td><td>: {{ data.db_odev_sayisi }}</td></tr>
                            <tr><td><b>PROJE SAYISI </b></td><td>: {{ data.db_proje_sayisi }}</td></tr>
                            <tr><td><b>SÖZLÜ SAYISI </b></td><td>: {{ data.db_sozlu_sayisi }}</td></tr>
                            <tr><td><b>UYGULAMA SAYISI </b></td><td>: {{ data.db_uygulama_sayisi }}</td></tr>
                            <tr><td><b>SERTİFİKA SAYISI </b></td><td>: {{ data.db_sertifika_sayisi }}</td></tr>
                            <tr><td><b>KONTENJAN SAYISI </b></td><td>: {{ data.db_kontenjan_sayisi }}</td></tr>
                            <tr><td col="2"><b>EĞİTİM/PROGRAM HAKKINDA :</b><br> <span v-html="''+data.db_egitim_hakkinda"/></td></tr>
                            <tr><td col="2"><b>EĞİTİM/PROGRAM İÇERİĞİ :</b><br> <span v-html="data.db_egitim_icerigi"/></td></tr>
                            <tr><td col="2"><b>AÇIKLAMALAR </b>:<br> <span v-html="data.db_aciklamalar"/></td></tr>
                            <tr><td col="2"><b>İÇERİK ÜRETİCİ(LERİ) </b> :<br><span v-html="data.db_icerik_ureticileri"/></td></tr>
                            <tr><td col="2"><b>EĞİTMEN(LER) </b>:<br> <span v-html="data.db_egitmenler"/></td></tr>
                            <tr><td><b>EĞİTMEN ÖZGEÇMİŞ(LERİ) </b></td><td >: <a download="" :href="'/'+data.db_egitmen_ozgecmis" >İndir</a></td></tr>
                            <tr><td><b>EĞİTMEN SÖZLEŞME(LERİ) </b></td><td>: <a download="" :href="'/'+data.db_egitmen_sozlesme" >İndir</a></td></tr>
                            

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {};
    },
    props: {
        data: Object,
        modal: Object,
    },
    methods: {
        kaydetClicked() {
            // Modal içinde "Kaydet" butonuna tıklandığında bu metod çalışacak
            this.$emit("kaydet", { data: this.data });
        },
    },
};
</script>
