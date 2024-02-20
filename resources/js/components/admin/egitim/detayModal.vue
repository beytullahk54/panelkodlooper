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
                            <tr><td>Görsel</td><td><img :src="'/'+data.db_gorsel" style="width:100%" alt=""></td></tr>
                            <tr><td>Eğitim/Program Adı :</td><td>{{ data.db_adi }}</td></tr>
                            <tr><td>İngilizce Eğitim/Program Adı :</td><td>{{ data.db_ingilizce_adi }}</td></tr>
                            <tr><td>Başvuru Durumu :</td><td>{{ data.db_basvuru_durumu }}</td></tr>
                            <tr><td>Eğitim/Program Program Kodu :</td><td>{{ data.db_egitim_kodu }}</td></tr>
                            <tr><td>Kategori :</td><td>{{ data.db_kategori?data.db_kategori.db_adi:"" }}</td></tr>
                            <tr><td>Kurum :</td>
                                <td>
                                    <span v-for="kurum in JSON.parse(data.db_universite)">{{kurum.db_adi}}</span>
                                </td>
                            </tr>
                            <tr><td>Ulusal Geçerlilik :</td><td>{{ data.db_ulusal_gecerlilik }}</td></tr>
                            <tr><td>Bayi Alış Fiyatı :</td><td>{{ data.db_bayi_alis_fiyati }}</td></tr>
                            <tr><td>Minimum Tavsiye Satış Fiyatı :{{ data.db_min_tavsiye_satis_fiyati }}}</td></tr>
                            <tr><td>Liste Satış Fiyatı :</td><td>{{ data.db_liste_satis_fiyati }}</td></tr>
                            <tr><td>E-devlet Onayı :</td><td>{{ data.db_edevlet_onayi }}</td></tr>
                            <tr><td>Uluslararası Onayı :</td><td>{{ data.db_uluslararasi_onayi }}</td></tr>
                            <tr><td>Sertifika Türü :</td><td>{{ data.db_sertifika_turu }}</td></tr>
                            <tr><td>Sertifika Saati :</td><td>{{ data.db_sertifika_saati }}</td></tr>
                            <tr><td>Eğitim/Program Süresi :</td><td>{{ data.db_egitim_suresi }}</td></tr>
                            <tr><td>Eğitim/Program Dili :</td><td>{{ data.db_egitim_dili }}</td></tr>
                            <tr><td>Eğitim/Program Yöntemi :</td><td>{{ data.db_egitim_yonetemi }}</td></tr>
                            <tr><td>Eğitim/Program Yeri ve Tarihi :</td><td>{{ data.db_egitim_yeri }}</td></tr>
                            <tr><td>İçerik Türü :</td><td>{{ data.db_icerik_turu }}</td></tr>
                            <tr><td>Video Ders Sayısı :</td><td>{{ data.db_video_sayisi }}</td></tr>
                            <tr><td>Canlı Ders Sayısı :</td><td>{{ data.db_canli_ders_sayisi }}</td></tr>
                            <tr><td>Örgün Ders Sayısı :</td><td>{{ data.db_orgun_ders_sayisi }}</td></tr>
                            <tr><td>İnteraktif Ders Sayısı :</td><td>{{ data.db_interaktif_ders_sayisi }}</td></tr>
                            <tr><td>Hibrit Ders Sayısı :</td><td>{{ data.db_hibrit_ders_sayisi }}</td></tr>
                            <tr><td>Özel Ders Sayısı :</td><td>{{ data.db_ozel_ders_sayisi }}</td></tr>
                            <tr><td>Ders Notu Sayısı :</td><td>{{ data.db_ders_notu_sayisi }}</td></tr>
                            <tr><td>Ders Notu Toplam Sayfa Sayısı :</td><td>{{ data.db_ders_notu_toplam_sayfa_sayisi }}</td></tr>
                            <tr><td>Sınav Sayısı :</td><td>{{ data.db_sinav_sayisi }}</td></tr>
                            <tr><td>Ödev Sayısı :</td><td>{{ data.db_odev_sayisi }}</td></tr>
                            <tr><td>Proje Sayısı :</td><td>{{ data.db_proje_sayisi }}</td></tr>
                            <tr><td>Sözlü Sayısı :</td><td>{{ data.db_sozlu_sayisi }}</td></tr>
                            <tr><td>Uygulama Sayısı :</td><td>{{ data.db_uygulama_sayisi }}</td></tr>
                            <tr><td>Uygulama Sayısı :</td><td>{{ data.db_sertifika_sayisi }}</td></tr>
                            <tr><td>Kontenjan Sayısı :</td><td>{{ data.db_kontenjan_sayisi }}</td></tr>
                            <tr><td>Eğitim/Program Hakkında :<span v-html="data.db_egitim_hakkinda"/></td></tr>
                            <tr><td>Eğitim/Program İçeriği :</td><td><span v-html="data.db_egitim_icerigi"/></td></tr>
                            <tr><td>Açıklamalar :</td><td><span v-html="data.db_aciklamalar"/></td></tr>
                            <tr><td>İçerik Üreticileri :</td><td><span v-html="data.db_icerik_ureticileri"/></td></tr>
                            <tr><td>Eğitmenler :</td><td><span v-html="data.db_egitmenler"/></td></tr>
                            <tr><td>Eğitmen Öz Geçmişi :</td><td><a download="" :href="'/'+data.db_egitmen_ozgecmis" >İndir</a></td></tr>
                            <tr><td>Eğitmen Sözleşmeleri :</td><td><a download="" :href="'/'+data.db_egitmen_sozlesme" >İndir</a></td></tr>
                            

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
