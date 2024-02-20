<template>
    <div>
        <div class="modal-content">
            <div class="modal-body">
                <div class="mb-3">
                    <label
                        for="exampleFormControlInput1"
                        class="form-label"
                        >Katılımcı Adı *</label
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
                        >Katılımcı Soyadı *</label
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
                        >Katılımcı Doğum Tarihi *</label
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
                        >Katılımcı Uyruğu *</label
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
                        >Katılımcı TC *</label
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
                        >Pasaport ya da Kimlik No *</label
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
                        >Katılımcı Cep No *</label
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
                        >Katılımcı E-Mail *</label
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
                            <multiselect v-model="data.db_ulke_secim" :options="ulkes"   :multiple="false" label="baslik" placeholder="Ülke Seçiniz"  @input="sehirGetir"></multiselect>
                        </div>
                    </div>
                </div>
                <div class="form-group" v-if="sehirs.length>0">
                    <div class="row ">
                        <div class="col-md-4 align-self-center">
                            <label for="exampleInputPassword">Şehir *</label>        
                        </div>
                        <div class="col-md-8">
                            <multiselect v-model="data.db_sehir_secim" :options="sehirs"   :multiple="false" label="baslik" placeholder="Şehir Seçiniz"   @input="ilceGetir"></multiselect>
                        </div>
                    </div>
                </div>
                <div class="form-group" v-if="ilces.length>0">
                    <div class="row ">
                        <div class="col-md-4 align-self-center">
                            <label for="exampleInputPassword">İlçe *</label>        
                        </div>
                        <div class="col-md-8">
                            <multiselect v-model="data.db_ilce_secim" :options="ilces"   :multiple="false" label="baslik" placeholder="İlçe Seçiniz"  @input="bitis"></multiselect>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label
                        for="exampleFormControlInput1"
                        class="form-label"
                        >Katılımcı Adresi *</label
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
                <div class="mb-3">
                    <h3>Eğitimler / Programlar</h3>
                    <div class="row">
                        <div class="col-md-3"><span class="btn btn-success " style="font-size:14px;cursor:pointer" @click="katilimciEgitimOlustur">+ Eğitim/Program Ekle</span></div>
                    </div>
                    <br><br><br>
                    <div v-for="(sertifika ,key) in data.sertifikas">
                        <div class="row">
                            <div class="col-md-12" >
                                <div class="row d-flex align-items-center" style="border-bottom:1px solid #e1dddd;padding:10px">
                                    <div class="col-md-1 col-xs-1">    
                                        <img width="48" style="cursor:pointer" @click="katilimciEgitimCikart(key)" height="48" src="https://img.icons8.com/color/48/delete-forever.png" alt="delete-forever"/>
                                    </div>
                                    <div class="col-md-9 col-xs-9">    
                                        <multiselect v-model="sertifika.egitim" :options="dataEgitims" track-by="db_adi" label="db_adi"  placeholder="Eğitim/Program seç ya da ara..."></multiselect>
                                    </div>
                                    <div class="col-md-2 col-xs-2"> {{  sertifika.egitim?sertifika.egitim.db_bayi_alis_fiyati:0 }} ₺</div>

                                    <div class="col-md-10 col-xs-10" style="padding-left:40%;padding-top:10px">    
                                        <multiselect v-model="sertifika.varyant" :options="dataVaryants" track-by="id"  :multiple="true" label="db_adi" placeholder="Ek hizmet seç ya da ara..."></multiselect>
                                    </div>

                                    <div class="col-md-2 col-xs-2">    
                                      {{  sertifika.varyant.length>0?varyantToplam(sertifika.varyant):0 }} ₺
                                    </div> 

                                    <div class="col-md-10 col-xs-10">    
                                    
                                    </div> 

                                    <div class="col-md-2 col-xs-2" style="padding-top:10px">    
                                        Toplam:  {{  parseInt(sertifika.egitim?sertifika.egitim.db_bayi_alis_fiyati:0 ) + parseInt(sertifika.varyant.length>0?varyantToplam(sertifika.varyant):0) }} ₺
                                    </div> 

                                </div>
                            </div >
                        </div>     
                    </div><br>
                    <div class="row" v-if="data.sertifikas.length > 0">
                        <div class="col-md-9"></div>
                        <div class="col-md-3">
                           GENEL TOPLAM: {{ genelToplam(data.sertifikas) }} ₺
                        </div>
                    </div>
                    

                </div>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Kapat
                </button>
                <button
                    type="button"
                    @click="dataStore"
                    class="btn btn-primary"
                    data-bs-dismiss="modal"
                >
                    Kaydet
                </button>
            </div>
        </div>
    </div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<script>
export default {
    data() {
        return {
            sertifikas:[
            ],
            value: null,
            value2: null,
            options: ['list', 'of', 'options'],
            ulkes:[],
            ilces:[],
            sehirs:[],
            data:{

                db_adi:this.$developer?"beytullah":"",
                db_soyadi:this.$developer?"kahraman":"",
                db_dogum_tarihi:this.$developer?"1995-12-10":"",
                db_tc_pasaport:this.$developer?"10148444512":"",
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
                db_adres:this.$developer?"Vatan Mah. 4235 Sok. A blok daire 2 Yazlık Serdivan Sakarya":"",
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
        this.dataEgitimGet();
        this.dataVaryantGet();
    },
    methods: {
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
                .post("/bayi/katilimci/getEgitim")
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
                    this.data.db_ulke_secim =
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
                .post( "/registerSehir",{"ulke_id":this.data.db_ulke_secim.id})
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
                .post( "/registerIlce",{"sehir_id":this.data.db_sehir_secim.id})
                .then((response) => {
                    this.ilces = response.data;
                    //this.dataGet();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        bitis(){
            console.log(this.data.db_ilce)

        },
        katilimciEgitimOlustur(){
            this.data.sertifikas.push({
                egitimAdi:"a",
                varyant:[]
            })
        },
        katilimciEgitimCikart(key){
            this.data.sertifikas.splice(key,1)
        },
        dataStore() {

            
            this.data.db_ulke=this.data.db_ulke_secim.id
            this.data.db_sehir=this.data.db_sehir_secim.id
            this.data.db_ilce=this.data.db_ilce_secim.id
            this.data.db_ulke_obj=JSON.stringify(this.data.db_ulke_secim)
            this.data.db_sehir_obj=JSON.stringify(this.data.db_sehir_secim)
            this.data.db_ilce_obj=JSON.stringify(this.data.db_ilce_secim)

            if(this.data.db_adi == ''||this.data.db_soyadi == ''||this.data.db_soyadi == ''|| this.data.db_dogum_tarihi == ""|| this.data.db_tc_pasaport == '' || this.data.db_cep_no == '' || this.data.db_uyruk == '' ||this.data.db_ulke_secim == ''||this.data.db_sehir_secim  == ''||this.data.db_ilce_secim == ''||this.data.db_adres == '')
            {
                this.$toasted.error("Lütfen katılımcı bilgilerini boş bırakmayınız")
                return
            }
            if(this.data.sertifikas.length == 0)
            {
                this.$toasted.error("Lütfen en az 1 eğitim seçiniz")
                return
            }
            axios
                .post("/bayi/katilimci/create" , this.data)
                .then((response) => {
                    if(response.data.status != 'false'){
                        this.$toasted.success(response.data.message)
                        location.href="/bayi/katilimci"
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
