<template>
    <div>
        <div class="modal-content">
            <div class="modal-body">
                <div class="mb-3">
                    <label
                        for="exampleFormControlInput1"
                        class="form-label"
                        >Bayi Türü</label
                    >
                    <div class="form-check">
                        <input class="form-check-input" type="radio"  id="exampleRadios12" value="kurumsal" v-model="data.sirket_kurumsal_sahis">
                        <label class="form-check-label" style="font-size:18px;" for="exampleRadios12">
                            Kurumsal

                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio"  id="exampleRadios23" value="bireysel" v-model="data.sirket_kurumsal_sahis">
                        <label class="form-check-label" style="font-size:18px;" for="exampleRadios23">
                            Bireysel
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label
                        for="exampleFormControlInput1"
                        class="form-label"
                        >E-Postanız</label
                    >
                    <input
                        v-model="data.db_yetkili_email"
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
                        >Şifre</label
                    >
                    <input
                        v-model="data.db_sifre"
                        type="password"
                        value="kahraman"
                        class="form-control"
                        id="exampleFormControlInput1"
                    />
                </div>
                <div class="mb-3">
                    <label
                        for="exampleFormControlInput1"
                        class="form-label"
                        >Yetkili Adı</label
                    >
                    <input
                        v-model="user.name"
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
                        >Yetkili Soyadı</label
                    >
                    <input
                        v-model="user.surname"
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
                        >Yetkili Doğum Tarihi</label
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
                        >Yetkili Uyruğu</label
                    >
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="tc" v-model="data.db_yetkili_uyrugu">
                        <label class="form-check-label" style="font-size:18px;" for="exampleRadios1">
                            TC vatandaşı

                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="tc_degilim" v-model="data.db_yetkili_uyrugu">
                        <label class="form-check-label" style="font-size:18px;" for="exampleRadios2">
                            TC vatandaşı değil
                        </label>
                    </div>
                </div>
                <div class="mb-3" v-if="data.db_yetkili_uyrugu == 'tc'">
                    <label
                        for="exampleFormControlInput1"
                        class="form-label"
                        >T.C. Kimlik Numarası </label
                    >
                    <input
                        v-model="data.db_tc_pasaport"
                        value="10148444512"
                        type="number"
                        class="form-control"
                        id="exampleFormControlInput1"
                    />
                </div>
                <div class="mb-3" v-if="data.db_uyruk == 'tc_degilim'">
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
                        >Cep Telefon No</label
                    >
                    <input
                        v-model="data.db_cep_no"
                        value="5322400257"
                        type="text"
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
                            <multiselect v-model="db_ulke_obj" :options="ulkes"   :multiple="false" label="baslik" placeholder="Ülke Seçiniz"  @input="sehirGetir"></multiselect>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row ">
                        <div class="col-md-4 align-self-center">
                            <label for="exampleInputPassword">Şehir *</label>        
                        </div>
                        <div class="col-md-8">
                            <multiselect v-model="db_sehir_obj" :options="sehirs"   :multiple="false" label="baslik" placeholder="Şehir Seçiniz"   @input="ilceGetir"></multiselect>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row ">
                        <div class="col-md-4 align-self-center">
                            <label for="exampleInputPassword">İlçe *</label>        
                        </div>
                        <div class="col-md-8">
                            <multiselect v-model="db_ilce_obj" :options="ilces"   :multiple="false" label="baslik" placeholder="İlçe Seçiniz"  ></multiselect>
                        </div>
                    </div>
                </div>
                <div class="form-group"  v-if="data.sirket_kurumsal_sahis=='kurumsal'">
                    <div class="row ">
                        <div class="col-md-4 align-self-center">
                            <label for="exampleSelect">Şirket Türü *</label>        
                        </div>
                        <div class="col-md-8">    
                            <select v-model="data.db_sirket_turu" class="form-control" id="exampleSelect">
                                <option value="">Seçiniz</option>
                                <option value="sahis">Şahıs Şirketi</option>
                                <option value="limited">Limited Şirketi</option>
                                <option value="anonim">Anonim Şirketi</option>
                                <option value="sivil-toplum-kurulusu">Sivil Toplum Kuruluşu</option>
                                <option value="kurum">Kamu Kurumu / Üniversite</option>
                                <option value="yurt-disi-sirketi">Yurt Dışı Şirketi</option>
                                <option value="diger">Diğer</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label
                        for="exampleFormControlInput1"
                        class="form-label"
                        >Şirket Ünvanı</label
                    >
                    <input
                        v-model="data.db_sirket_unvani"
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
                        >Şirket Adresi</label
                    >
                    <input
                        v-model="data.db_sirket_adresi"
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
                        >Şirket Vergi No</label
                    >
                    <input
                        v-model="data.db_sirket_vergi_no"
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
                        >Şirket Vergi Dairesi</label
                    >
                    <input
                        v-model="data.db_sirket_dairesi"
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
                        >Şirket Web Adresi</label
                    >
                    <input
                        v-model="data.db_sirket_web_adresi"
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
                        >Şirket Sosyal Medya</label
                    >
                    <input
                        v-model="data.db_sosyal_medya_hesabi"
                        type="text"
                        value="beytullah"
                        class="form-control"
                        id="exampleFormControlInput1"
                    />
                </div>
                <div class="form-group">
                    <div class="row ">
                        <div class="col-md-4 align-self-center">
                            <label for="exampleInputPassword"  v-if="data.sirket_kurumsal_sahis=='bireysel'">Kimlik Ön Yüzü *</label>        
                            <label for="exampleInputPassword"  v-if="data.sirket_kurumsal_sahis=='kurumsal'">Yetkili Kimlik Ön Yüzü *</label>        
                        </div>
                        <div class="col-md-8">
                            <vue-upload-multiple-image
                            accept="file"
                                style="width:100%"
                                idUpload="2"
                                @upload-success="uploadYetkiliKimlik"
                                @before-remove="beforeRemove"
                                @edit-image="editImage"
                                :data-images="data.image2"
                                :multiple="false"
                                dragText="Dosya Sürükle / Ekle"
                                browseText="Dosya Seçiniz"
                                primaryText="Yüklendi"
                            ></vue-upload-multiple-image>
                        </div>
                    </div>
                </div>
        
                <div class="form-group">
                    <div class="row ">
                        <div class="col-md-4 align-self-center">
                            <label for="exampleInputPassword"  v-if="data.sirket_kurumsal_sahis=='bireysel'">İkametgah Belgesi *</label>        
                            <label for="exampleInputPassword"  v-if="data.sirket_kurumsal_sahis=='kurumsal'">Yetkili İkametgah Belgesi *</label>        
                        </div>
                        <div class="col-md-8">        
                            <vue-upload-multiple-image
                                accept="file"
                                style="width:100%"
                                idUpload="1"
                                @upload-success="uploadIkametgah"
                                @before-remove="beforeRemove"
                                @edit-image="editImage"
                                :data-images="data.image3"
                                :multiple="false"
                                dragText="Dosya Sürükle / Ekle"
                                browseText="Dosya Seçiniz"
                                primaryText="Yüklendi"
                            ></vue-upload-multiple-image>
                            
                        </div>
                    </div>
                </div>
        
                <div class="form-group" >
                    <div class="row ">
                        <div class="col-md-4 align-self-center">
                            <label for="exampleInputPassword">Vergi Levhası *</label>        
                        </div>
                        <div class="col-md-8">         
                            <vue-upload-multiple-image
                                accept="file"
                                @upload-success="uploadVergiLevhasi"
                                @before-remove="beforeRemove"
                                @edit-image="editImage"
                                :data-images="data.image"
                                :multiple="false"
                                dragText="Dosya Sürükle / Ekle"
                                browseText="Dosya Seçiniz"
                                primaryText="Yüklendi"
                            ></vue-upload-multiple-image>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row ">
                        <div class="col-md-4 align-self-center">
                            <label for="exampleInputPassword">Yüklenmiş Dosyalar </label>        
                        </div>
                        <div class="col-md-8">
                            
                            <a :href="'/'+data.db_kimlik_on_yuzu" target="_blank" >
                                <img src="https://img.icons8.com/matisse/100/pdf.png" style="width: 50px;height: 50px;margin:5px;padding:1px;">  Kimlik Ön Yüzü<br>
                            </a>
                            <a :href="'/'+data.db_ikametgah" target="_blank" >
                                <img src="https://img.icons8.com/matisse/100/pdf.png" style="width: 50px;height: 50px;margin:5px;padding:1px;">
                                İkametgah <br> 
                            </a>
                            <a :href="'/'+data.db_vergi_levhasi" v-if="data.db_vergi_levhasi" target="_blank" >
                                <img src="https://img.icons8.com/matisse/100/pdf.png" style="width: 50px;height: 50px;margin:5px;padding:1px;">
                                Vergi Levhası <br> 
                            </a>

                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label
                        for="exampleFormControlInput1"
                        class="form-label"
                        >Minimum Bakiye</label
                    >
                    <input
                        v-model="data.db_min_bakiye"
                        value="5322400257"
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
            user:{},
            katilimciDosya:[],
            katilimciDosya2:[],
            dataUniversite:[],
            db_ulke_obj:[],
            db_sehir_obj:{},
            db_ilce_obj:{},
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
        this.ulkeGetir()
        this.dataGet()
    },
    methods: {
        dataGet(){
            axios
                .post("/admin/bayi/view/get",{"id":this.id})
                .then((response) => {
                    console.log(response.data.data)  
                    this.user = response.data.user     
                    this.data = response.data.data
                    this.db_ulke_obj = JSON.parse(this.data.db_ulke_obj)
                    this.sehirGetir()
                    this.db_sehir_obj = JSON.parse(this.data.db_sehir_obj)
                    this.ilceGetir()
                    this.db_ilce_obj = JSON.parse(this.data.db_ilce_obj)


                    //gorsel_list
                    const fileNameArray = [this.data.db_vergi_levhasi];
                    const fileNameIkametgahArray = [this.data.db_ikametgah];
                    const fileNameKimlikOnYuzuArray = [this.data.db_kimlik_on_yuzu];

                    // Diziyi gorsel_list'e atama
                    this.data.image = fileNameArray.map(fileName => ({
                        path:  "/"+fileName
                    }));

                    this.data.image2 = fileNameKimlikOnYuzuArray.map(fileName => ({
                        path:  "/"+fileName
                    }));

                    this.data.image3 = fileNameIkametgahArray.map(fileName => ({
                        path:  "/"+fileName
                    }));


                    
                    // console.log(JSON.parse(response.data.data.db_ulke_obj))
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
        ulkeGetir(){
            axios
                .post( "/registerUlke",
                { headers: {
                    "Content-Type": "multipart/form-data"
                }})
                .then((response) => {
                    this.ulkes=response.data
                    //this.sehirGetir()

                })
                .catch((error) => {
                    console.log(error);
                });
        },
        sehirGetir(){
            axios
                .post( "/registerSehir",{"ulke_id":this.db_ulke_obj.id})
                .then((response) => {
                    this.sehirs = response.data;
                    //this.dataGet();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        ilceGetir(){
            axios
                .post( "/registerIlce",{"sehir_id":this.db_sehir_obj.id})
                .then((response) => {
                    this.ilces = response.data;
                    //this.dataGet();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        uploadVergiLevhasi(formData, index, fileList) {
            console.log('data', formData, index, fileList)
            
            
            axios
                .post( "/gorselUpload/vergiLevhasi", formData,
                { headers: {
                    "Content-Type": "multipart/form-data"
                }})
                .then((response) => {
                    this.data.db_vergi_levhasi = response.data.url;
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

        uploadYetkiliKimlik(formData, index, fileList) {
            axios
                .post( "/gorselUpload/yetkiliKimlik",formData,
                { headers: {
                    "Content-Type": "multipart/form-data"
                }})
                .then((response) => {
                    this.data.db_kimlik_on_yuzu = response.data.url;
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
        uploadIkametgah(formData, index, fileList) {
            
            console.log(formData.values())
            
            axios
                .post("/gorselUpload/ikametgah", formData,
                { headers: {
                    "Content-Type": "multipart/form-data"
                }})
                .then((response) => {
                    this.data.db_ikametgah = response.data.url;
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

        katilimciEgitimOlustur(){
            this.data.sertifikas.push({
                egitimAdi:"a",
                varyant:""
            })
        },
        dataStore() {

            
            this.data.db_ulke_obj=JSON.stringify(this.db_ulke_obj)
            this.data.db_sehir_obj=JSON.stringify(this.db_sehir_obj)
            this.data.db_ilce_obj=JSON.stringify(this.db_ilce_obj)
            /*this.data.db_katilimci_dosya = JSON.stringify(this.katilimciDosya)
            this.data.db_katilimci_dosya2 = JSON.stringify(this.katilimciDosya2)
            this.data.db_katilimci_durum = JSON.stringify(this.katilimciDurum )*/
            
            this.data.name = this.user.name
            this.data.surname = this.user.surname

            axios
                .post("/admin/bayi/update" , this.data)
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
