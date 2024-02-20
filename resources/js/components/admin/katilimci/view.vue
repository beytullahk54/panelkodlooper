<template>
    <div>
        <div class="modal-content">
            <div class="modal-body">
                <div class="mb-3">
                    <label
                        for="exampleFormControlInput1"
                        class="form-label"
                        >Katılımcı Adı</label
                    >
                    <input
                        v-model="data.db_adi"
                        type="text"
                        value="beytullah"
                        class="form-control"
                        id="exampleFormControlInput1"
                    />
                </div>
                <div class="mb-3">
                    <label
                        for="exampleFormControlInput1"
                        class="form-label"
                        >Katılımcı Soyadı</label
                    >
                    <input
                        v-model="data.db_soyadi"
                        type="text"
                        value="kahraman"
                        class="form-control"
                        id="exampleFormControlInput1"
                    />
                </div>
                <div class="mb-3">
                    <label
                        for="exampleFormControlInput1"
                        class="form-label"
                        >Katılımcı Doğum Tarihi</label
                    >
                    <input
                        v-model="data.db_dogum_tarihi"
                        value="10.12.1995"
                        type="date"
                        class="form-control"
                        id="exampleFormControlInput1"
                    />
                </div>
                <div class="mb-3">
                    <label
                        for="exampleFormControlInput1"
                        class="form-label"
                        >Katılımcı Uyruğu</label
                    >
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="tc_vatandasi" v-model="data.db_uyruk">
                        <label class="form-check-label" style="font-size:18px;" for="exampleRadios1">
                            TC vatandaşı

                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="tc_vatandasi_degil" v-model="data.db_uyruk">
                        <label class="form-check-label" style="font-size:18px;" for="exampleRadios2">
                            TC vatandaşı değil
                        </label>
                    </div>
                </div>
                <div class="mb-3" v-if="data.db_uyruk == 'tc_vatandasi'">
                    <label
                        for="exampleFormControlInput1"
                        class="form-label"
                        >Katılımcı TC </label
                    >
                    <input
                        v-model="data.db_tc_pasaport"
                        value="10148444512"
                        type="number"
                        class="form-control"
                        id="exampleFormControlInput1"
                    />
                </div>
                <div class="mb-3" v-if="data.db_uyruk == 'tc_vatandasi_degil'">
                    <label
                        for="exampleFormControlInput1"
                        class="form-label"
                        >Pasaport ya da Kimlik No</label
                    >
                    <input
                        v-model="data.db_tc_pasaport"
                        value="555444333"
                        type="number"
                        class="form-control"
                        id="exampleFormControlInput1"
                    />
                </div>
                <div class="mb-3">
                    <label
                        for="exampleFormControlInput1"
                        class="form-label"
                        >Katılımcı Cep No</label
                    >
                    <input
                        v-model="data.db_cep_no"
                        value="5322400257"
                        type="text"
                        class="form-control"
                        id="exampleFormControlInput1"
                    />
                </div>
                <div class="mb-3">
                    <label
                        for="exampleFormControlInput1"
                        class="form-label"
                        >Katılımcı E-Mail</label
                    >
                    <input
                        v-model="data.db_email"
                        type="email"
                        class="form-control"
                        id="exampleFormControlInput1"
                    />
                </div>
                <div class="form-group">
                    <div class="row ">
                        <div class="col-md-4 align-self-center">
                            <label for="exampleInputPassword">Ülke *</label>        
                        </div>
                        <div class="col-md-8">
                            <multiselect v-model="data.db_ulke_obj" :options="ulkes"   :multiple="false" label="baslik" placeholder="Ülke Seçiniz"  @input="sehirGetir"></multiselect>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row ">
                        <div class="col-md-4 align-self-center">
                            <label for="exampleInputPassword">Şehir *</label>        
                        </div>
                        <div class="col-md-8">
                            <multiselect v-model="data.db_sehir_obj" :options="sehirs"   :multiple="false" label="baslik" placeholder="Şehir Seçiniz"   @input="ilceGetir"></multiselect>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row ">
                        <div class="col-md-4 align-self-center">
                            <label for="exampleInputPassword">İlçe *</label>        
                        </div>
                        <div class="col-md-8">
                            <multiselect v-model="data.db_ilce_obj" :options="ilces"   :multiple="false" label="baslik" placeholder="İlçe Seçiniz"  ></multiselect>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label
                        for="exampleFormControlInput1"
                        class="form-label"
                        >Katılımcı Adresi</label
                    >
                    <input
                        v-model="data.db_adres"
                        value="Vatan Mah. 4235 Sok. A blok daire 2 Yazlık Serdivan Sakarya"
                        type="text"
                        class="form-control"
                        id="exampleFormControlInput1"
                    />
                </div>
                <div class="mb-3">
                    <label
                        for="exampleFormControlInput1"
                        class="form-label"
                        >Sipariş Notu (Varsa)</label
                    >
                    <textarea
                        v-model="data.db_siparis_not"
                        value="23455543"
                        type="text"
                        class="form-control"
                        id="exampleFormControlInput1"
                    />
                </div>
                <div class="mb-3">

                    <div class="form-group">
                        <div class="form-check align-self-center">
                            <input class="form-check-input align-self-center"   v-model="data.db_tarih_araligi" style="width: 25px;height: 25px; font-size: 25px;"  type="checkbox" name="exampleRadios">
                            <label class="form-check-label align-self-center" for="option2" style="padding-left:10px">
                                Tarih Aralığı Eklemek istiyorum.
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mb-3" v-if="data.db_tarih_araligi">
                    <label
                        for="exampleFormControlInput1"
                        class="form-label"
                        >Eğitim Başlama Tarihi</label
                    >
                    <input
                        v-model="data.db_baslama_tarihi"
                        value="10.12.1995"
                        type="date"
                        class="form-control"
                        id="exampleFormControlInput1"
                    />
                </div>
                <div class="mb-3"  v-if="data.db_tarih_araligi">
                    <label
                        for="exampleFormControlInput1"
                        class="form-label"
                        >Eğitim Bitiş Tarihi</label
                    >
                    <input
                        v-model="data.db_bitis_tarihi"
                        value="10.12.1995"
                        type="date"
                        class="form-control"
                        id="exampleFormControlInput1"
                    />
                </div>
               
                <div class="form-group">
                    <div class="row ">
                        <div class="col-md-4 align-self-center">
                            <label for="exampleInputPassword">Eğitim *</label>        
                        </div>
                        <div class="col-md-8">
                            <multiselect v-model="data.db_program_obj" :options="dataEgitims" track_by="id" :multiple="false" label="db_adi" placeholder="Eğitim Seçiniz"  ></multiselect>
                        </div>
                    </div>
                </div>

               
                <div class="form-group">
                    <div class="row ">
                        <div class="col-md-4 align-self-center">
                            <label for="exampleInputPassword">Varyant *</label>        
                        </div>
                        <div class="col-md-8">
                            <multiselect v-model="data.db_varyant" :options="dataVaryants" track_by="id" track-by="id" :multiple="true" label="db_adi" placeholder="Varyant Seçiniz"  ></multiselect>
                        </div>
                    </div>
                </div>

               
                <div class="form-group">
                    <div class="row ">
                        <div class="col-md-4 align-self-center">
                            <label for="exampleInputPassword">Üniversite *</label>        
                        </div>
                        <div class="col-md-8">
                            <multiselect v-model="data.db_universite" :options="dataUniversite" track_by="id" :multiple="false" label="db_adi" placeholder="Eğitim Seçiniz"  ></multiselect>
                        </div>
                    </div>
                </div>
                
                
                
                
                <div class="form-group">
                    <div class="row ">
                        <div class="col-md-4 align-self-center">
                            <label for="exampleInputPassword">Yüklenmiş Dosyalar </label>        
                        </div>
                        <div class="col-md-8">
                            
                            <a :href="img.path" target="_blank" v-if="katilimciDosya" v-for="img in katilimciDosya" ><img src="https://img.icons8.com/matisse/100/pdf.png" style="width: 50px;height: 50px;margin:5px;padding:1px;"></a>
                            <a :href="img.path" target="_blank" v-if="katilimciDosya2" v-for="img in katilimciDosya2" ><img src="https://img.icons8.com/matisse/100/pdf.png" style="width: 50px;height: 50px;margin:5px;padding:1px;"></a>
                        </div>
                    </div>
                </div>
               
               <div class="form-group">
                   <div class="row ">
                       <div class="col-md-4 align-self-center">
                           <label for="exampleInputPassword">Satış Sitesi Giriniz *</label>        
                       </div>
                       <div class="col-md-8">
                           <multiselect v-model="data.db_satis_sitesi" :options="dataSatisSitesi" track_by="id" :multiple="false" label="db_adi" placeholder="Satış Sitenizi Seçiniz"  ></multiselect>
                       </div>
                   </div>
               </div>
               
               <div class="form-group">
                   <div class="row ">
                       <div class="col-md-4 align-self-center">
                           <label for="exampleInputPassword">Ödeme Türü *</label>        
                       </div>
                       <div class="col-md-8">
                           <multiselect v-model="data.db_site_odeme_turu" :options="dataOdemeTuru" track_by="id" :multiple="false" label="db_adi" placeholder="Site Ödeme Türünü Seçiniz"  ></multiselect>
                       </div>
                   </div>
               </div>

                <div class="form-group">
                    <div class="row ">
                        <div class="col-md-4 align-self-center">
                            <label for="exampleInputPassword">Dosyalar </label>        
                        </div>
                        <div class="col-md-8">
                            
                            <vue-upload-multiple-image
                                accept="file"
                                @upload-success="uploadImageSuccess"
                                @before-remove="beforeRemove"
                                @edit-image="editImage"
                                :data-images="katilimciDosya"
                                :multiple="true"
                                dragText="Dosya Sürükleyiniz"
                                browseText="Dosya Seçiniz"
                                primaryText="Yüklendi"
                                idUpload="myIdUpload"
                            ></vue-upload-multiple-image>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row ">
                        <div class="col-md-4 align-self-center">
                            <label for="exampleInputPassword">Dosyalar 2</label>        
                        </div>
                        <div class="col-md-8">
                            
                            <vue-upload-multiple-image
                                accept="file"
                                @upload-success="uploadImageSuccess2"
                                @before-remove="beforeRemove2"
                                @edit-image="editImage2"
                                :data-images="katilimciDosya2"
                                :multiple="true"
                                dragText="Dosya Sürükleyiniz"
                                browseText="Dosya Seçiniz"
                                primaryText="Yüklendi"
                                idUpload="myIdUpload2"
                            ></vue-upload-multiple-image>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row ">
                        <div class="col-md-4 align-self-center">
                            <label for="exampleInputPassword">Durum </label>        
                        </div>
                        <div class="col-md-8">
                            <multiselect v-model="katilimciDurum" :options="katilimciDurums" :multiple="true" track-by="id" label="db_adi"  placeholder="Tamamlanan Durumları Seçiniz"></multiselect>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row ">
                        <div class="col-md-4 align-self-center">
                            <label for="exampleInputPassword">Bitiş Tarihi </label>        
                        </div>
                        <div class="col-md-8">
                            <input type="date" class="form-control" v-model="data.db_bitis_tarihi">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label
                        for="exampleFormControlInput1"
                        class="form-label"
                        >Bayi Notu </label
                    >
                    <textarea
                        v-model="data.db_bayi_not"
                        value="23455543"
                        type="text"
                        class="form-control"
                        id="exampleFormControlInput1"
                    />
                </div>
            </div>

               
            <div class="modal-footer">
                <button
                    type="button"
                    @click="dataStore"
                    class="btn btn-primary"
                >
                    Güncelle
                </button>
            </div>
        </div>
    </div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<script>
import VueUploadMultipleImage from 'vue-upload-multiple-image'
export default {

    components: {
        VueUploadMultipleImage,
    },
    props:{
        id:String
    },
    data() {
        return {
            sertifikas:[],
            value: null,
            value2: null,
            options: ['list', 'of', 'options'],
            ulkes:[],
            ilces:[],
            sehirs:[],
            katilimciDosya:[],
            katilimciDosya2:[],
            katilimciDurum:{},
            katilimciDurums:[
                {id:1,db_adi:"Onay bekliyor"},
                {id:2,db_adi:"Onaylandı"},
                {id:3,db_adi:"Üniversiteye onaya gönderildi"},
                {id:4,db_adi:"E-Devlete işlendi"},
                {id:5,db_adi:"Kargolandı"},
                {id:6,db_adi:"Süresinde tamamlamadı"},
                {id:7,db_adi:"İptal edildi"},
                {id:8,db_adi:"İade edildi"},
                {id:9,db_adi:"Kaydı silindi"},
                {id:10,db_adi:"Eğitim/program değiştirildi"},
                {id:11,db_adi:"Sertifika kargolandı"},
                {id:12,db_adi:"Yabancı dil sertifika kargolandı"},
                {id:13,db_adi:"Transkript kargolandı"},
                {id:14,db_adi:"Sertifika yurt dışına kargolandı"},
                {id:15,db_adi:"Transkript yurt dışına kargolandı"},
                {id:16,db_adi:"Dijital yabancı dil sertifika oluşturuldu"},
                {id:17,db_adi:"Dijital transkript oluşturuldu"},
                {id:18,db_adi:"Uluslararası onaylı sertifika oluşturuldu"},
                {id:19,db_adi:"1 ay ek erişim tanımlandı"},
                {id:20,db_adi:"3 ay ek erişim tanımlandı"},
                {id:21,db_adi:"6 ay ek erişim tanımlandı"},
                {id:22,db_adi:"12 ay ek erişim tanımlandı"}
            ],
            dataUniversite:[],
            dataSatisSitesi:[
            ],
            dataOdemeTuru:[
            ],
            data:{
                db_uyruk:"tc_vatandasi",
                db_katilimci_dosya:[],
                //db_adi:this.$developer?"beytullah":"",
                //db_soyadi:this.$developer?"kahraman":"",
                //db_dogum_tarihi:this.$developer?"1995-12-10":"",
                /*db_tc_pasaport:this.$developer?"10148444512":"",
                db_cep_no:this.$developer?"5332400257":"",
                db_email:this.$developer?"info@kodlooper.com":"",
                db_uyruk:this.$developer?"tc_vatandasi":"",
                db_ulke_secim:{},
                db_ulke:"",
                db_sehir:{},
                db_sehir_secim:{},
                db_ilce:{},
                db_ilce_secim:{},
                db_siparis_not:this.$developer?"aaa":"",
                db_adres:this.$developer?"Vatan Mah. 4235 Sok. A blok daire 2 Yazlık Serdivan Sakarya":"",*/
                sertifikas:[]
            },
            data_varyant:[],
            dataEgitims:[],
            dataVaryants:[],
            modal:{}
        };
    },
    mounted(){
        this.dataGet()
        this.ulkeGetir()
        this.dataEgitimGet();
        this.dataVaryantGet();
        this.dataGetUniversite();
    },
    methods: {
        dataGet(){
            axios
                .post("/admin/katilimci/view/get",{"id":this.id})
                .then((response) => {
                    console.log(response.data.data)
                    response.data.data.db_varyant=JSON.parse(response.data.data.db_varyant)
                    response.data.data.db_ulke_obj=JSON.parse(response.data.data.db_ulke_obj)
                    response.data.data.db_sehir_obj=JSON.parse(response.data.data.db_sehir_obj)
                    response.data.data.db_ilce_obj=JSON.parse(response.data.data.db_ilce_obj)
                    response.data.data.db_program_obj=JSON.parse(response.data.data.db_program_obj)
                    response.data.data.db_universite=JSON.parse(response.data.data.db_universite)
                    response.data.data.db_satis_sitesi=JSON.parse(response.data.data.db_satis_sitesi)
                    response.data.data.db_site_odeme_turu=JSON.parse(response.data.data.db_site_odeme_turu)
                    this.dataSatisSitesi=JSON.parse(response.data.db_satis_sitesi)
                    this.dataOdemeTuru=JSON.parse(response.data.db_odeme_turu)
                    
                    
                    this.katilimciDurum = JSON.parse(response.data.data.db_katilimci_durum)
                    this.katilimciDosya = response.data.data.db_katilimci_dosya ?JSON.parse(response.data.data.db_katilimci_dosya):[];
                    this.katilimciDosya2 = response.data.data.db_katilimci_dosya2 ?JSON.parse(response.data.data.db_katilimci_dosya2):[];
                    this.data = response.data.data

                })
                .catch((error) => {
                    console.log(error);
                });
        },
        dataGetUniversite(){

            axios
                .post("/admin/katilimci/getUniversite")
                .then((response) => {
                    console.log(response.data);
                    this.dataUniversite = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        varyantToplam(varyant) {
            let dbToplam=0
            varyant.forEach(item => {
                dbToplam = parseInt(dbToplam) + parseInt(item.db_fiyati)
                // Diğer işlemleri burada gerçekleştirin
            });
            return dbToplam
        },
        genelToplam(data){
            let dbToplam=0
            data.forEach(item => {
                let varyantTp = item.varyant?this.varyantToplam(item.varyant):0;
                let egitimTp = parseInt(item.egitim?item.egitim.db_bayi_alis_fiyati:0)
                dbToplam = parseInt(dbToplam) + egitimTp + varyantTp 
                // Diğer işlemleri burada gerçekleştirin
            });
            return dbToplam
        },
        dataEgitimGet(){
            axios
                .post("/admin/katilimci/getEgitim")
                .then((response) => {
                    console.log(response.data);
                    this.dataEgitims = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });

        },
        dataVaryantGet(){
            axios
                .post("/bayi/katilimci/getVaryant")
                .then((response) => {
                    console.log(response.data);
                    this.dataVaryants = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });

        },
        ulkeGetir(){
            axios
                .post( "/registerUlke",
                { headers: {
                    "Content-Type": "multipart/form-data"
                }})
                .then((response) => {
                    this.ulkes=response.data
                    this.data.db_ulke_obj =
                    {
                        "id": 223,
                        "rewrite": "TR",
                        "baslik": "Türkiye",
                        "alankodu": "90"
                    }
                    this.sehirGetir()

                })
                .catch((error) => {
                    console.log(error);
                });
        },
        sehirGetir(){
            axios
                .post( "/registerSehir",{"ulke_id":this.data.db_ulke_obj.id})
                .then((response) => {
                    this.data.db_sehir_secim=[]
                    this.data.db_ilce_secim=[]
                    this.ilces=[]
                    this.sehirs = response.data;
                    //this.dataGet();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        ilceGetir(){
            axios
                .post( "/registerIlce",{"sehir_id":this.data.db_sehir_obj.id})
                .then((response) => {
                    this.ilces = response.data;
                    //this.dataGet();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        uploadImageSuccess(formData, index, fileList) {
            //console.log('data', formData, index, fileList)
            
            let axiosUrl="";
            axiosUrl = "/gorselCokluUpload/katilimciDosya"
            
            axios
                .post(axiosUrl, formData,
                { headers: {
                    "Content-Type": "multipart/form-data"
                }})
                .then((response) => {
                   // console.log(response)
                    //this.formData.db_gorsel = response.data.url;

                    this.katilimciDosya.push({"path": "/"+response.data.url});
                    console.log(this.katilimciDosya)
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
                this.katilimciDosya.splice(index, 1);

                done()
            } else {
            }
        },
        editImage (formData, index, fileList) {
            console.log('edit data', formData, index, fileList)
        },
        uploadImageSuccess2(formData, index, fileList) {
            //console.log('data', formData, index, fileList)
            
            let axiosUrl="";
            axiosUrl = "/gorselCokluUpload/katilimciDosya2"
            
            axios
                .post(axiosUrl, formData,
                { headers: {
                    "Content-Type": "multipart/form-data"
                }})
                .then((response) => {
                   // console.log(response)
                    //this.formData.db_gorsel = response.data.url;

                    this.katilimciDosya2.push({"path": "/"+response.data.url});
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

        beforeRemove2 (index, done, fileList) {
            console.log('index', index, fileList)
            var r = confirm("remove image")
            if (r == true) {
                this.katilimciDosya2.splice(index, 1);

                done()
            } else {
            }
        },
        editImage2 (formData, index, fileList) {
            console.log('edit data', formData, index, fileList)
        },
        katilimciEgitimOlustur(){
            this.data.sertifikas.push({
                egitimAdi:"a",
                varyant:""
            })
        },
        dataStore() {

            
            /*this.data.db_ulke=this.data.db_ulke_secim.id
            this.data.db_sehir=this.data.db_sehir_secim.id
            this.data.db_ilce=this.data.db_ilce_secim.id*/
            this.data.db_katilimci_dosya = JSON.stringify(this.katilimciDosya)
            this.data.db_katilimci_dosya2 = JSON.stringify(this.katilimciDosya2)
            this.data.db_katilimci_durum = JSON.stringify(this.katilimciDurum )
            
            if(this.data.db_adi == ''||this.data.db_soyadi == ''||this.data.db_soyadi == ''|| this.data.db_dogum_tarihi == ""|| this.data.db_tc_pasaport == '' || this.data.db_cep_no == '' || this.data.db_uyruk == '' || this.data.db_adres == '')
            {
                this.$toasted.error("Lütfen katılımcı bilgilerini boş bırakmayınız")
                return
            }
            axios
                .post("/admin/katilimci/update" , this.data)
                .then((response) => {
                    if(response.data.status != 'false'){
                        this.$toasted.success(response.data.message)
                    }else{
                        this.$toasted.error(response.data.message)
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
