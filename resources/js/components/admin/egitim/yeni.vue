<template>
    <div>
        <br /><br />
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">{{ pageTitle }}</h3>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Görsel Yükle</label>
                                        <vue-upload-multiple-image
                                            accept="file"
                                            @upload-success="uploadImageSuccess"
                                            @before-remove="beforeRemove"
                                            @edit-image="editImage"
                                            :data-images="formData.image"
                                            :multiple="false"
                                            dragText="Resmi Sürükleyiniz"
                                            browseText="Resim Seçiniz"
                                            primaryText="Yüklendi"
                                        ></vue-upload-multiple-image>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Eğitim/Program Adı</label>
                                        <input v-model="formData.db_adi" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Eğitim/Program İngilizce Adı</label>
                                        <input v-model="formData.db_ingilizce_adi" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group" v-if="!bayi">
                                        <label for="exampleSelect">Başvuru Durumu</label>
                                        <select v-model="formData.db_basvuru_durumu" class="form-control" id="exampleSelect">
                                            <option value="">Seçiniz</option>
                                            <option value="acik">Açık</option>
                                            <option value="kapali">Kapalı</option>
                                            <option value="yakinda">Yakında</option>
                                        </select>
                                    </div>
                                    <div class="form-group"  v-if="!bayi">
                                        <label for="exampleInputPassword">Kategori Adı</label>
                                        <input v-model="formData.db_egitim_kodu" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group"  v-if="!bayi">
                                        <label for="exampleSelect">Kategori Sınıfı</label>
                                        <multiselect v-model="formData.kategori" :options="kategoriler" track-by="db_adi" label="db_adi"  placeholder="Kategori Seçiniz"></multiselect>
                                    </div>
                                    <div class="form-group"  v-if="!bayi">
                                        <label for="exampleSelect">Kurum</label>
                                        <multiselect v-model="formData.universite" :options="universiteler" track-by="db_adi" label="db_adi"  multiple placeholder="Kurum Seçiniz"></multiselect>
                                    </div>
                                    <div class="form-group"  v-if="!bayi">
                                        <label for="exampleInputPassword">Bayi Alış Fiyatı</label>
                                        <input v-model="formData.db_bayi_alis_fiyati" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Tavsiye Satış Fiyatı</label>
                                        <input v-model="formData.db_min_tavsiye_satis_fiyati" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Liste Satış Fiyatı</label>
                                        <input v-model="formData.db_liste_satis_fiyati" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group"  v-if="!bayi">
                                        <label for="exampleSelect">e-Devlet Onayı</label>
                                        <select v-model="formData.db_edevlet_onayi" class="form-control" id="exampleSelect">
                                            <option value="">Seçiniz</option>
                                            <option value="var">Var</option>
                                            <option value="yok">Yok</option>
                                            <option value="belirtilmedi">Belirtilmedi</option>
                                        </select>
                                    </div>
                                    <div class="form-group"  v-if="!bayi">
                                        <label for="exampleSelect">Uluslararası Onayı</label>
                                        <select v-model="formData.db_uluslararasi_onayi" class="form-control" id="exampleSelect">
                                            <option value="">Seçiniz</option>
                                            <option value="var">Var</option>
                                            <option value="yok">Yok</option>
                                            <option value="belirtilmedi">Belirtilmedi</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelect">Sertifika Türü</label>
                                        <select v-model="formData.db_sertifika_turu"  class="form-control" id="exampleSelect">
                                            <option value="">Seçiniz</option>
                                            <option value="egitim">Eğitim Sertifikası</option>
                                            <option value="katilim">Katılım Sertifikası</option>
                                            <option value="seminer">Seminer Sertifikası</option>
                                            <option value="kurs_bitirme_belgesi">Kurs Bitirme Belgesi </option>
                                            <option value="uluslararasi_onayli_sertifika">Uluslararası Onaylı Sertifika</option>
                                            <option value="uzmanlik_sertifika">Uzmanlık Sertifikası</option>
                                            <option value="egitmenlik_sertifika">Eğitmenlik Sertifikası</option>
                                            <option value="egiticinin_egitimi_sertifikasi">Eğiticinin Eğitimi Sertifikası</option>
                                            <option value="kalfalik_sertifika">Kalfalık Sertifikası</option>
                                            <option value="ustalik_sertifikasi">Ustalık Sertifikası</option>
                                            <option value="usta_ogreticilik_sertifikasi">Usta Öğreticilik Sertifikası</option>
                                            <option value="temel_egitim_sertifikasi">Temel Eğitim Sertifikası</option>
                                            <option value="kisisel_gelisim_sertifikasi">Kişisel Gelişim Sertifikası</option>
                                            <option value="sertifikasiz">Sertifikasız</option>
                                            <option value="diger">Diğer</option>
                                            <option value="belirtilmedi">Belirtilmedi</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Sertifika Saati</label>
                                        <input v-model="formData.db_sertifika_saati" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group"  v-if="!bayi">
                                        <label for="exampleInputPassword" >Eğitim/Program Süresi</label>
                                        <input v-model="formData.db_egitim_suresi" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelect">Eğitim/Program Dili</label>
                                        <select  v-model="formData.db_egitim_dili"  class="form-control" id="exampleSelect">
                                            <option value="">Seçiniz</option>
                                            <option value="turkce">Türkçe</option>
                                            <option value="ingilizce">İngilizce</option>
                                            <option value="turkce_ingilizce_karma">Türkçe ve İngilizce Karma</option>
                                            <option value="turkce_ingilizce_secmeli">Türkçe ve İngilizce Seçmeli</option>
                                            <option value="karma">Karma</option>
                                            <option value="diger">Diğer</option>
                                            <option value="belirtilmedi">Belirtilmedi</option>
                                        </select>
                                    </div>
                                    <div class="form-group"  v-if="!bayi">
                                        <label for="exampleSelect">Eğitim/Program Yöntemi</label>
                                        <select v-model="formData.db_egitim_yontemi" class="form-control" id="exampleSelect">
                                            <option value="">Seçiniz</option>
                                            <option value="online_video">Online (video)</option>
                                            <option value="online_canli">Online (canlı)</option>
                                            <option value="online_karma">Online (karma)</option>
                                            <option value="orgun">Örgün</option>
                                            <option value="interaktif">İnteraktif</option>
                                            <option value="hibrit">Hibrit</option>
                                            <option value="dokuman">Doküman</option>
                                            <option value="belirtilmedi">Belirtilmedi</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Eğitim/Program Yeri ve Tarihi</label>
                                        <input v-model="formData.db_egitim_yeri" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelect">İçerik Türü</label>
                                        <select v-model="formData.db_icerik_turu" class="form-control" id="exampleSelect">
                                            <option value="">Seçiniz</option>
                                            <option value="video_ders">Video Ders</option>
                                            <option value="video_ders_sertifika">Video Ders + Sertifika</option>
                                            <option value="video_ders_sinav_sertifika">Video Ders + Sınav + Sertifika</option>
                                            <option value="video_ders_pdf_sertifika">Video Ders + PDF + Sertifika</option>
                                            <option value="video_ders_pdf_sinav_sertifika">Video Ders + PDF + Sınav + Sertifika</option>
                                            <option value="canli_ders">Canlı Ders</option>
                                            <option value="canli_ders_sertifika">Canlı Ders + Sertifika</option>
                                            <option value="canli_ders_sinav_sertifika">Canlı Ders + Sınav + Sertifika</option>
                                            <option value="canli_ders_pdfsertifika">Canlı Ders + PDF + Sertifika</option>
                                            <option value="canli_ders_pdf_sinav_sertifika">Canlı Ders + PDF + Sınav + Sertifika</option>
                                            <option value="orgun_ders">Örgün Ders</option>
                                            <option value="orgun_ders_sertifika">Örgün Ders + Sertifika</option>
                                            <option value="orgun_ders_sinav_sertifika">Örgün Ders + Sınav + Sertifika</option>
                                            <option value="orgun_ders_pdf_sertifika">Örgün Ders + PDF + Sertifika</option>
                                            <option value="orgun_ders_pdf_sinav_sertifika">Örgün Ders + PDF + Sınav + Sertifika</option>
                                            <option value="interaktif_ders">İnteraktif Ders</option>
                                            <option value="interaktif_ders_sertifika">İnteraktif Ders + Sertifika</option>
                                            <option value="interaktif_ders_sinav_sertifika">İnteraktif Ders + Sınav + Sertifika</option>
                                            <option value="interaktif_ders_pdf_sertifika">İnteraktif Ders + PDF + Sertifika</option>
                                            <option value="interaktif_ders_pdf_sinav_sertifika">İnteraktif Ders + PDF + Sınav + Sertifika</option>
                                            <option value="hibrit_ders">Hibrit Ders</option>
                                            <option value="hibrit_ders_sertifika">Hibrit Ders + Sertifika</option>
                                            <option value="hibrit_ders_sinav_sertifika">Hibrit Ders + Sınav + Sertifika</option>
                                            <option value="hibrit_ders_pdfsertifika">Hibrit Ders + PDF + Sertifika</option>
                                            <option value="hibrit_ders_pdf_sinav_sertifika">Hibrit Ders + PDF + Sınav + Sertifika</option>
                                            <option value="ozel_ders">Özel Ders</option>
                                            <option value="ozel_ders_sertifika">Özel Ders + Sertifika</option>
                                            <option value="ozel_ders_sinav_sertifika">Özel Ders + Sınav + Sertifika</option>
                                            <option value="ozel_ders_pdfsertifika">Özel Ders + PDF + Sertifika</option>
                                            <option value="ozel_ders_pdf_sinav_sertifika">Özel Ders + PDF + Sınav + Sertifika</option>
                                            <option value="ders_notu">Ders Notu</option>
                                            <option value="ders_notu_sertifika">Ders Notu + Sertifika</option>
                                            <option value="ders_notu_sinav_sertifika">Ders Notu + Sınav + Sertifika</option>
                                            <option value="belirtilmedi">Belirtilmedi</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Video Ders Sayısı</label>
                                        <input v-model="formData.db_video_sayisi" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Canlı Ders Sayısı</label>
                                        <input v-model="formData.db_canli_ders_sayisi" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Örgün Ders Sayısı</label>
                                        <input v-model="formData.db_orgun_ders_sayisi" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">İnteraktif Ders Sayısı</label>
                                        <input v-model="formData.db_interaktif_ders_sayisi" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Hibrit Ders Sayısı</label>
                                        <input v-model="formData.db_hibrit_ders_sayisi" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Özel Ders Sayısı</label>
                                        <input v-model="formData.db_ozel_ders_sayisi" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Ders Notu Sayısı</label>
                                        <input v-model="formData.db_ders_notu_sayisi" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Ders Notu Toplam Sayfa Sayısı</label>
                                        <input v-model="formData.db_ders_notu_toplam_sayfa_sayisi" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Sınav Sayısı</label>
                                        <input v-model="formData.db_sinav_sayisi" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Ödev Sayısı</label>
                                        <input v-model="formData.db_odev_sayisi" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Proje Sayısı</label>
                                        <input v-model="formData.db_proje_sayisi" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Sözlü Sayısı</label>
                                        <input v-model="formData.db_sozlu_sayisi" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Uygulama Sayısı</label>
                                        <input v-model="formData.db_uygulama_sayisi" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Sertifika Sayısı</label>
                                        <input v-model="formData.db_sertifika_sayisi" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Kontenjan Sayısı</label>
                                        <input v-model="formData.db_kontenjan_sayisi" type="text" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Eğitim/Program Hakkında</label>
                                        <editor  api-key="wsuxoph1s8qivel18r8hn6t0dnliik8883sz5nqy2gf07vgi"  v-model="formData.db_egitim_hakkinda" class="form-control"  rows="8" cols="50"></editor>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Eğitim/Program İçeriği</label>
                                        <editor  api-key="wsuxoph1s8qivel18r8hn6t0dnliik8883sz5nqy2gf07vgi"  v-model="formData.db_egitim_icerigi" class="form-control"  rows="8" cols="50"></editor>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Açıklamalar</label>
                                        <editor  api-key="wsuxoph1s8qivel18r8hn6t0dnliik8883sz5nqy2gf07vgi"  v-model="formData.db_aciklamalar" class="form-control"  rows="8" cols="50"></editor>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">içerik Üretici(leri)</label>
                                        <editor  api-key="wsuxoph1s8qivel18r8hn6t0dnliik8883sz5nqy2gf07vgi"  v-model="formData.db_icerik_ureticileri" class="form-control"  rows="8" cols="50"></editor>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Eğitmenler</label>
                                        <editor  api-key="wsuxoph1s8qivel18r8hn6t0dnliik8883sz5nqy2gf07vgi"  v-model="formData.db_egitmenler" class="form-control"  rows="8" cols="50"></editor>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Eğitmen Özgeçmiş(leri)</label>

                                        <vue-upload-multiple-image
                                            accept="file"
                                            idUpload="2"
                                            @upload-success="uploadEgitmenOzgecmisSuccess"
                                            @before-remove="beforeRemove"
                                            @edit-image="editImage"
                                            :data-images="formData.image2"
                                            :multiple="false"
                                            dragText="Dosya Sürükleyiniz"
                                            browseText="Dosya Seçiniz"
                                            primaryText="Yüklendi"
                                        ></vue-upload-multiple-image>

                                     
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword">Eğitmen Sözleşme(leri)</label>
                                        <vue-upload-multiple-image
                                            accept="file"
                                            idUpload="1"
                                            @upload-success="uploadEgitmenSozlesmeSuccess"
                                            @before-remove="beforeRemove"
                                            @edit-image="editImage"
                                            :data-images="formData.image3"
                                            :multiple="false"
                                            dragText="Dosya Sürükleyiniz"
                                            browseText="Dosya Seçiniz"
                                            primaryText="Yüklendi"
                                        ></vue-upload-multiple-image>
                                    </div>
                                    <div class="form-group">
                                        <button @click="dataStore()" class="btn btn-primary btn-block">Eğitim/Program Oluştur</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VueUploadMultipleImage from 'vue-upload-multiple-image'

export default {

    components: {
        VueUploadMultipleImage,
    },
    data() {
        return {
            rezervasyonBaglantisi: false,
            hizmetler: {},
            universiteler: {},
            kategoriler: {},
            visible: false,
            updateVisible: false,
            formData: {
                db_gorsel:"",
                db_adi:"",
                db_ingilizce_adi:"",
                db_egitmler:"",
                db_basvuru_durumu:"",
                kategori:[],
                universite:[] ,
                db_bayi_alis_fiyati:"",
                db_min_tavsiye_satis_fiyati:"",
                db_liste_satis_fiyati:"",
                db_edevlet_onayi:"",
                db_sertifika_turu:"",
                db_sertifika_saati:"",
                db_egitim_suresi:"",
                db_egitim_dili:"",
                db_egitim_yeri:"",
                db_egitim_kodu:"",
                db_transkript:"",
                db_yabanci_dil_sertifika:"",
                db_egitim_yonetimi:"",
                db_icerik_turu:"",
                db_video_sayisi:"",
                db_canli_ders_sayisi:"",
                db_orgun_ders_sayisi:"",
                db_hibrit_ders_sayisi:"",
                db_ozel_ders_sayisi:"",
                db_ders_notu_sayisi:"",
                db_ders_notu_toplam_sayfa_sayisi:"",
                db_odev_sayisi:"",
                db_proje_sayisi:"",
                db_sozlu_sayisi:"",
                db_uygulama_sayisi:"",
                db_kontenjan_sayisi:"",
                db_icerik_ureticileri:"",
                db_pdf_kitap_sayisi:"",
                db_pdf_sayfa_sayisi:"",
                db_interaktif_ders_sayisi:"",
                db_uluslararasi_onayi:"",
                db_sinav_sayisi:"",
                db_egitim_hakkinda:"",
                db_egitim_icerigi:"",
                db_aciklamalar:"",
                db_sertifika_sayisi:"",
                db_egitmenler:"",
                db_egitim_yontemi:"",
                db_egitmen_sozlesme:"",
                db_egitmen_ozgecmis:"",
            },
            firma:{},
            baglanti_adi: "",
            baglanti_update_adi: "",
            query: "",
            modalData: {
                butonBaslik: "", // butonBaslik'u burada tanımlayın
            },
            datas: []
        };
    },
    props: { pageTitle: String, pageUrl: String,bayi:String },
    mounted() {
        this.dataGetKategori();
        this.dataGetUniversite();
        if(this.bayi){
            this.firmaGetir()
        }
    },
    methods: {
        uploadImageSuccess(formData, index, fileList) {
            console.log('data', formData, index, fileList)
            
            let axiosUrl="";
            axiosUrl = "/gorselUpload/egitimGorsel"
            
            axios
                .post(axiosUrl, formData,
                { headers: {
                    "Content-Type": "multipart/form-data"
                }})
                .then((response) => {
                    this.formData.db_gorsel = response.data.url;
                    this.$toasted.success(response.data.message)
                    //this.dataGet();
                })
                .catch((error) => {
                    console.log(error);
                });
            // Upload image api
            // axios.post('http://your-url-upload', formData).then(response => {
            //   console.log(response)
            // })
        },

        uploadEgitmenOzgecmisSuccess(formData, index, fileList) {

            let axiosUrl="";
            axiosUrl ="/"+this.pageUrl + "/gorselUpload/egitmenOzgecmis"
            
            axios
                .post(axiosUrl,formData,
                { headers: {
                    "Content-Type": "multipart/form-data"
                }})
                .then((response) => {
                    this.formData.db_egitmen_ozgecmis = response.data.url;
                    this.$toasted.success(response.data.message)
                    //this.dataGet();
                })
                .catch((error) => {
                    console.log(error);
                });
            // Upload image api
            // axios.post('http://your-url-upload', formData).then(response => {
            //   console.log(response)
            // })
        },
        uploadEgitmenSozlesmeSuccess(formData, index, fileList) {
            
            console.log(formData.values())
            let axiosUrl="";
            axiosUrl ="/"+this.pageUrl + "/gorselUpload/egitmenSozlesme"

            axios
                .post(axiosUrl, formData,
                { headers: {
                    "Content-Type": "multipart/form-data"
                }})
                .then((response) => {
                    this.formData.db_egitmen_sozlesme = response.data.url;
                    this.$toasted.success(response.data.message)
                    //this.dataGet();
                })
                .catch((error) => {
                    console.log(error);
                });
            // Upload image api
            // axios.post('http://your-url-upload', formData).then(response => {
            //   console.log(response)
            // })
        },
        beforeRemove (index, done, fileList) {
            console.log('index', index, fileList)
            var r = confirm("remove image")
            if (r == true) {
                done()
            } else {
            }
        },
        editImage (formData, index, fileList) {
            console.log('edit data', formData, index, fileList)
        },
        dataGetKategori(){
            let axiosUrl="";
            if(this.bayi=='true')
            {
                axiosUrl ="/"+this.pageUrl + "/getKategori"

            }else{
                axiosUrl = "/admin/"+this.pageUrl + "/getKategori"
            }
            axios
                .post(axiosUrl)
                .then((response) => {
                    console.log(response.data);
                    this.kategoriler = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        dataGetUniversite(){

            let axiosUrl="";
            if(this.bayi=='true')
            {
                axiosUrl ="/"+this.pageUrl + "/getUniversite"

                console.log(axiosUrl)
            }else{
                axiosUrl ="/admin/"+this.pageUrl + "/getUniversite"
            }
            axios
                .post(axiosUrl)
                .then((response) => {
                    console.log(response.data);
                    this.universiteler = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        firmaGetir(){
            axios
                .post("/"+this.pageUrl + "/getFirma")
                .then((response) => {
                    this.firma = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        dataGetFiltrele() {
            console.log(this.query);
            /*axios
                .post(this.pageUrl + "/get?page=" + page)
                .then((response) => {
                    console.log(response.data);
                    this.datas = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });*/
        },
        photoStore(){
        },
        dataStore(){
            var locationUrl = ""
            this.formData.db_universite=JSON.stringify(this.formData.universite)
            this.formData.db_kategori=JSON.stringify(this.formData.kategori)
            if(this.bayi){
                this.formData.db_firma_id=this.firma.id
                this.formData.db_bayi_onay_durumu="kapali"
                locationUrl = "/bayi/egitimlerim"

            }else{
                locationUrl = "/admin/egitim"
            }
            if(this.bayi=='true'){
                axios
                .post( "/"+this.pageUrl + "/create", this.formData)
                .then((response) => {
                    this.$toasted.success(response.data.message)
                    
                    window.location.href=locationUrl
                    //this.dataGet();
                })
                .catch((error) => {
                    console.log(error);
                });
            }else{
                axios
                .post("/admin/"+this.pageUrl + "/create", this.formData)
                .then((response) => {
                    this.$toasted.success(response.data.message)
                    window.location.href="/admin/egitim"
                    this.dataGet();
                })
                .catch((error) => {
                    console.log(error);
                });
            }
            
        },
        dataCreate() {
            this.formData = {};
            this.modalData.islem = "/create";
            this.modalData.butonBaslik = "Yeni Kayıt";
            this.modalData.type = "create";
        },
        showUpdateDrawer(data) {
            this.modalData.islem = "/update";
            this.updateVisible = true;
            this.formData = data;
            this.baglanti_update_adi = data.baglanti_adi;
            this.modalData.butonBaslik = "Güncelle";
            this.modalData.type = "update";
        }
    },
};
</script>
