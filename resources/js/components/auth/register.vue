<template>
    <div>

        <!-- The Modal -->
        <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Sözleşme</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" v-html="sozlesme"/>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Okudum</button>
            </div>

            </div>
        </div>
        </div>
        <br /><br />
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0 text-center" style="font-size:20px">{{ pageTitle }}</h3>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card"  :style="backgroundStyle">
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button @click="degistir('kurumsal')"  v-if="formData.sirket_kurumsal_sahis=='kurumsal'" style="background: #353f92;color:white;    -webkit-box-shadow: 0 0 6px 4px #353f92;-moz-box-shadow: 0 0 6px 4px black;box-shadow: 0 0 6px 4px #353f92;"   class="btn  btn-block">
                                                    <span style="font-size:20px">Kurumsal</span><br>
                                                    <span>(Şirketim Var)</span>
                                                </button>
                                                <button @click="degistir('kurumsal')"  v-if="formData.sirket_kurumsal_sahis=='bireysel'" style="background: #353f92;color:white"  class="btn btn-block">
                                                    <span style="font-size:20px">Kurumsal</span><br>
                                                    <span>(Şirketim Var)</span>
                                                </button>
                                            </div>
                                            <div class="col-md-6">
                                                <button @click="degistir('bireysel')" v-if="formData.sirket_kurumsal_sahis=='bireysel'" style="background: #8F2395;color:white; -webkit-box-shadow: 0 0 6px 4px #902395;-moz-box-shadow: 0 0 6px 4px black;box-shadow: 0 0 6px 4px #902395;" class="btn  btn-block">
                                                    <span style="font-size:20px">Bireysel</span><br>
                                                    <span>(Şirketim Yok)</span>
                                                </button>
                                                <button @click="degistir('bireysel')" v-if="formData.sirket_kurumsal_sahis=='kurumsal'" style="background: #8F2395;color:white" class="btn btn-block">
                                                    <span style="font-size:20px">Bireysel</span><br>
                                                    <span>(Şirketim Yok)</span>
                                                </button>
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group" >
                                        <div class="row ">
                                            <div class="col-md-12  " style="text-align:center">
                                                * Yıldızlı alanların doldurulması zorunludur.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" >
                                        <div class="row ">
                                            <div class="col-md-4 align-self-center">
                                                <label for="exampleInputPassword">E-Postanız *</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input v-model="formData.email" v-on:change="mailKontrol" type="email" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-md-4 align-self-center">
                                                <label for="exampleInputPassword">Şifre Oluştur *</label>        
                                            </div>
                                            <div class="col-md-8">
                                                <input v-model="formData.password" type="password" class="form-control" >       
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-md-4 align-self-center">
                                                
                                                <label for="exampleSelect" v-if="formData.sirket_kurumsal_sahis=='bireysel'">Adınız *</label>  
                                                <label for="exampleSelect" v-if="formData.sirket_kurumsal_sahis=='kurumsal'">Yetkili Adı *</label>        
                                            </div>
                                            <div class="col-md-8">
                                                <input v-model="formData.name" type="text" class="form-control" >       
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-md-4 align-self-center">
                                                <label for="exampleInputPassword"  v-if="formData.sirket_kurumsal_sahis=='bireysel'">Soyadınız *</label>        
                                                <label for="exampleInputPassword"  v-if="formData.sirket_kurumsal_sahis=='kurumsal'">Yetkili Soyadı *</label>        
                                            </div>
                                            <div class="col-md-8">
                                                <input v-model="formData.surname" type="text" class="form-control" >       
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-md-4 align-self-center">
                                                <label for="exampleSelect" v-if="formData.sirket_kurumsal_sahis=='bireysel'">Doğum Tarihiniz* </label>        
                                                <label for="exampleSelect" v-if="formData.sirket_kurumsal_sahis=='kurumsal'">Yetkili Doğum Tarihi *</label>        
                                            </div>
                                            <div class="col-md-8">
                                                <input v-model="formData.db_dogum_tarihi" type="date" class="form-control" >       
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-md-4 align-self-center">
                                                <label for="exampleSelect"  v-if="formData.sirket_kurumsal_sahis=='bireysel'">Uyruğunuz *</label>        
                                                <label for="exampleSelect"  v-if="formData.sirket_kurumsal_sahis=='kurumsal'">Yetkili Uyruğu *</label>        
                                            </div>
                                            <div class="col-md-1"/>
                                            <div class="col-md-3">
                                                <input class="form-check-input" type="radio"  v-model="formData.db_yetkili_uyrugu" name="exampleRadios" id="option3" value="tc">
                                                <label class="form-check-label" for="option3">
                                                    T.C. Vatandaşıyım
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <input class="form-check-input" type="radio"  v-model="formData.db_yetkili_uyrugu" name="exampleRadios" id="option3" value="tc_degilim">
                                                <label class="form-check-label" for="option3">
                                                    T.C. Vatandaşı Değilim
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="form-group" v-if="formData.db_yetkili_uyrugu=='tc'">
                                        <div class="row ">
                                            <div class="col-md-4 align-self-center">
                                                <label for="exampleInputPassword"  >T.C. Kimlik Numarası *</label>        
                                            </div>
                                            <div class="col-md-8">
                                                <input v-model="formData.db_tc_pasaport_no"  @input="formatPhoneNumber" type="text" class="form-control" >       
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group"  v-if="formData.db_yetkili_uyrugu!='tc'">
                                        <div class="row ">
                                            <div class="col-md-4 align-self-center">
                                                <label for="exampleInputPassword"  >Pasaport ya da Kimlik No *</label>        
                                            </div>
                                            <div class="col-md-8">
                                                <input v-model="formData.db_tc_pasaport_no"  @input="formatPhoneNumber" type="text" class="form-control" >       
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-md-4 align-self-center">
                                                <label for="exampleInputPassword"  >Cep Telefon No *</label>        
                                            </div>
                                            <div class="col-md-8">
                                                <input v-model="formData.db_cep_no"  @input="formatPhoneNumber" type="text" class="form-control" >       
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-md-4 align-self-center">
                                                <label for="exampleInputPassword">Ülke *</label>        
                                            </div>
                                            <div class="col-md-8">
                                                <multiselect v-model="ulke_obj" :options="ulkes"   :multiple="false" label="baslik" placeholder="Ülke Seçiniz"  @input="sehirGetir"></multiselect>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" v-if="sehirs.length>0">
                                        <div class="row ">
                                            <div class="col-md-4 align-self-center">
                                                <label for="exampleInputPassword">Şehir *</label>        
                                            </div>
                                            <div class="col-md-8">
                                                <multiselect v-model="sehir_obj" :options="sehirs"   :multiple="false" label="baslik" placeholder="Şehir Seçiniz"   @input="ilceGetir"></multiselect>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" v-if="ilces.length>0">
                                        <div class="row ">
                                            <div class="col-md-4 align-self-center">
                                                <label for="exampleInputPassword">İlçe *</label>        
                                            </div>
                                            <div class="col-md-8">
                                                <multiselect v-model="ilce_obj" :options="ilces"   :multiple="false" label="baslik" placeholder="İlçe Seçiniz"></multiselect>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group"  v-if="formData.sirket_kurumsal_sahis=='kurumsal'">
                                        <div class="row ">
                                            <div class="col-md-4 align-self-center">
                                                <label for="exampleSelect">Şirket Türü *</label>        
                                            </div>
                                            <div class="col-md-8">    
                                                <select v-model="formData.db_sirket_turu" class="form-control" id="exampleSelect">
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
                                    <div class="form-group"  v-if="formData.sirket_kurumsal_sahis=='kurumsal'">
                                        <div class="row ">
                                            <div class="col-md-4 align-self-center">
                                                <label for="exampleSelect">Şirket Ünvanı *</label>        
                                            </div>
                                            <div class="col-md-8">
                                                <input v-model="formData.db_sirket_unvani" type="text" class="form-control" >       
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-md-4 align-self-center">
                                                <label for="exampleSelect" v-if="formData.sirket_kurumsal_sahis=='bireysel'">İletişim Adresiniz *</label>    
                                                <label for="exampleSelect" v-if="formData.sirket_kurumsal_sahis=='kurumsal'">Şirket Adresi *</label>        
                                            </div>
                                            <div class="col-md-8">
                                                <textarea v-model="formData.db_sirket_adresi" type="text" class="form-control" />       
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="form-group" v-if="formData.sirket_kurumsal_sahis=='kurumsal'">
                                        <div class="row ">
                                            <div class="col-md-4 align-self-center">
                                                <label for="exampleInputPassword"  >Şirket Vergi No *</label>        
                                            </div>
                                            <div class="col-md-8">
                                                <input v-model="formData.db_sirket_vergi_no" type="text" class="form-control" >       
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="form-group" v-if="formData.sirket_kurumsal_sahis=='kurumsal'">
                                        <div class="row ">
                                            <div class="col-md-4 align-self-center">
                                                <label for="exampleInputPassword">Şirket Vergi Dairesi *</label>        
                                            </div>
                                            <div class="col-md-8">
                                                <input v-model="formData.db_sirket_dairesi" type="text" class="form-control" >       
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-md-4 align-self-center">
                                                <label for="exampleInputPassword"  v-if="formData.sirket_kurumsal_sahis=='bireysel'">Web Adres(leri) (Varsa)</label>        
                                                <label for="exampleInputPassword"  v-if="formData.sirket_kurumsal_sahis=='kurumsal'">Şirket Web Adres(leri) (Varsa)</label>        
                                            </div>
                                            <div class="col-md-8">
                                                <textarea v-model="formData.db_sirket_web_adresi" type="text" class="form-control"  />       
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-md-4 align-self-center">
                                                <label for="exampleSelect"  v-if="formData.sirket_kurumsal_sahis=='bireysel'">Sosyal Medya Hesap(ları) (Varsa)</label>        
                                                <label for="exampleSelect"  v-if="formData.sirket_kurumsal_sahis=='kurumsal'">Şirket Sosyal Medya Hesap(ları) (Varsa)</label>        
                                            </div>
                                            <div class="col-md-8">
                                                <textarea v-model="formData.db_sosyal_medya_hesabi" type="text" class="form-control"  />  
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="form-group">
                                        <div class="row ">
                                            <div class="col-md-4 align-self-center">
                                                <label for="exampleInputPassword"  v-if="formData.sirket_kurumsal_sahis=='bireysel'">Kimlik Ön Yüzü *</label>        
                                                <label for="exampleInputPassword"  v-if="formData.sirket_kurumsal_sahis=='kurumsal'">Yetkili Kimlik Ön Yüzü *</label>        
                                            </div>
                                            <div class="col-md-8">
                                                <vue-upload-multiple-image
                                                accept="file"
                                                    style="width:100%"
                                                    idUpload="2"
                                                    @upload-success="uploadYetkiliKimlik"
                                                    @before-remove="beforeRemove"
                                                    @edit-image="editImage"
                                                    :data-images="formData.image2"
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
                                                <label for="exampleInputPassword"  v-if="formData.sirket_kurumsal_sahis=='bireysel'">İkametgah Belgesi *</label>        
                                                <label for="exampleInputPassword"  v-if="formData.sirket_kurumsal_sahis=='kurumsal'">Yetkili İkametgah Belgesi *</label>        
                                            </div>
                                            <div class="col-md-8">        
                                                <vue-upload-multiple-image
                                                    accept="file"
                                                    style="width:100%"
                                                    idUpload="1"
                                                    @upload-success="uploadIkametgah"
                                                    @before-remove="beforeRemove"
                                                    @edit-image="editImage"
                                                    :data-images="formData.image3"
                                                    :multiple="false"
                                                    dragText="Dosya Sürükle / Ekle"
                                                    browseText="Dosya Seçiniz"
                                                    primaryText="Yüklendi"
                                                ></vue-upload-multiple-image>
                                               
                                            </div>
                                        </div>
                                    </div>
                          
                                    <div class="form-group"  v-if="formData.sirket_kurumsal_sahis=='kurumsal'">
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
                                                    :data-images="formData.image"
                                                    :multiple="false"
                                                    dragText="Dosya Sürükle / Ekle"
                                                    browseText="Dosya Seçiniz"
                                                    primaryText="Yüklendi"
                                                ></vue-upload-multiple-image>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check align-self-center">
                                            <input class="form-check-input align-self-center"  @click="bayiSozlesmeOnay" style="width: 25px;height: 25px; font-size: 25px;"  type="checkbox" name="exampleRadios" v-model="formData.db_bayi_sozlesmesi">
                                            <label class="form-check-label align-self-center" @click="bayiSozlesmeOnay" for="option2" style="padding-left:10px">
                                                Bayilik <a data-toggle="modal" data-target="#myModal"><u>sözleşmesini</u> </a> okudum, onaylıyorum
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button @click="dataStore()" class="btn btn-success btn-block" style="font-size: 16px;color: #252f85;background: #7fff7f;">KAYIT OL</button>
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
    mounted(){
        this.$toasted.success("ss")

    },
    data() {
        return {
            backgroundStyle:"background:rgb(108 118 203);color:white",
            rezervasyonBaglantisi: false,
            hizmetler: {},
            universiteler: {},
            kategoriler: {},
            visible: false,
            updateVisible: false,
            phoneNumber:"",
            ulkes:[],
            sehirs:[],
            ilces:[],
            ulke_obj:{},
            sehir_obj:{},
            sozlesme:"",
            ilce_obj:{},
            formData: {
                sirket_kurumsal_sahis:"kurumsal",
                email:this.$developer?"asd":"",
                password:this.$developer?"1234":"",
                db_bayi_sozlesmesi:"",
                name:this.$developer?"Beytullah":"",
                surname:this.$developer?"Kahraman":"",
                db_tc_pasaport_no:this.$developer?"10148444512":"",
                db_dogum_tarihi:this.$developer?"1995-10-12":"",
                db_yetkili_uyrugu:this.$developer?"tc":"",
                db_cep_no:this.$developer?"5332400257":"",
                db_ulke:"",
                db_ilce:"",
                db_sehir:"",
                db_sirket_turu:this.$developer?"sahis":"",
                db_sirket_unvani:this.$developer?"Kodlooper":"",
                db_sirket_adresi:this.$developer?"Orta Mahalle, OFİSADA PLAZA, Kavaklar Cd. No: 15 D:103, 54040 Adapazarı/Sakarya":"",
                db_sirket_vergi_no:this.$developer?"4467543":"",
                db_sirket_dairesi:this.$developer?"Gümrük Önü Vergi Dairesi":"",
                db_sirket_web_adresi:this.$developer?"https://kodlooper.com":"",
                db_sosyal_medya_hesabi:this.$developer?"kodlooperyazilim":"",
                db_kimlik_on_yuzu:"",
                db_ikametgah:"",
                db_vergi_levhasi:""

            },
            baglanti_adi: "",
            baglanti_update_adi: "",
            query: "",
            modalData: {
                butonBaslik: "", // butonBaslik'u burada tanımlayın
            },
            datas: []
        };
    },
    props: { pageTitle: String, pageUrl: String },
    mounted() {
        this.ulkeGetir()
        this.sozlesmeCek()
    },
    methods: {
        mailKontrol(){
          axios.post("/registerMailBilgilendirmesi",{email:this.formData.email})  
        },
        ulkeGetir(){
            axios
                .post( "registerUlke",
                { headers: {
                    "Content-Type": "multipart/form-data"
                }})
                .then((response) => {
                    this.ulkes=response.data
                    this.ulke_obj =
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
                .post( "registerSehir",{"ulke_id":this.ulke_obj.id})
                .then((response) => {
                    this.sehir_obj=[]
                    this.ilce_obj=[]
                    this.ilces=[]
                    this.sehirs = response.data;
                    //this.dataGet();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        sozlesmeCek(){
            axios
                .post('registerSozlesmeCek')
                .then(response=>{
                    this.sozlesme = response.data.data
                })
        },
        ilceGetir(){
            axios
                .post( "registerIlce",{"sehir_id":this.sehir_obj.id})
                .then((response) => {
                    this.ilces = response.data;
                    //this.dataGet();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        bayiSozlesmeOnay(){
            this.formData.db_bayi_sozlesmesi="ok"
        },
        degistir(type){
            if(type=="bireysel"){
                this.backgroundStyle="background:rgb(192 87 198);color:white"
            }else{
                this.backgroundStyle="background:rgb(108 118 203);color:white"

            }
            this.formData.sirket_kurumsal_sahis = type
        },
        formatPhoneNumber() {
            // Telefon numarasını 555 555 55 55 formatına çevirme
            let formattedNumber = this.phoneNumber.replace(/\D/g, "");
            if (formattedNumber.length === 10) {
                this.phoneNumber = formattedNumber.replace(/(\d{3})(\d{3})(\d{2})(\d{2})/, "$1 $2 $3 $4");
            }
        },
        uploadVergiLevhasi(formData, index, fileList) {
            console.log('data', formData, index, fileList)
            
            
            axios
                .post( "/gorselUpload/vergiLevhasi", formData,
                { headers: {
                    "Content-Type": "multipart/form-data"
                }})
                .then((response) => {
                    this.formData.db_vergi_levhasi = response.data.url;
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
                    this.formData.db_kimlik_on_yuzu = response.data.url;
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
                    this.formData.db_ikametgah = response.data.url;
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
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
            if(emailRegex.test(this.formData.email) == false){
                this.$toasted.error("Lütfen E-Mail adresinizi doğru giriniz")
                return
            }
                console.log(this.formData)
            if(this.formData.sirket_kurumsal_sahis =='bireysel'){
                console.log("buradayız")
                if(this.formData.email === "" || this.formData.password === ""  ||  this.formData.name === "" ||  this.formData.surname === "" || this.formData.db_dogum_tarihi === "" || this.formData.db_yetkili_uyrugu  === "" || this.formData.db_tc_pasaport_no === "" || this.formData.db_cep_no === "" || this.ulke_obj.length == 0 || this.sehir_obj.length  == 0  || this.ilce_obj.length  == 0 ||  this.formData.db_sirket_adresi === "" || this.formData.db_kimlik_on_yuzu === "" || this.formData.db_ikametgah === ""){
                    //alert("Lütfen boş alan bırakmayınız")
                    this.$toasted.error("Lütfen boş alan bırakmayınız")
                    return
                }
            }else{
                if(this.formData.email === "" || this.formData.password === ""  ||  this.formData.name === "" ||  this.formData.surname === "" || this.formData.db_dogum_tarihi === "" || this.formData.db_yetkili_uyrugu  === "" || this.formData.db_tc_pasaport_no === "" || this.formData.db_cep_no === "" || this.ulke_obj.length == 0 || this.sehir_obj.length  == 0  || this.ilce_obj.length  == 0 || this.formData.db_sirket_turu === "" || this.formData.db_sirket_unvani === "" || this.formData.db_sirket_adresi === "" || this.formData.db_sirket_vergi_no === "" || this.formData.db_sirket_dairesi === "" || this.formData.db_vergi_levhasi === "" || this.formData.db_kimlik_on_yuzu === "" || this.formData.db_ikametgah === ""){
                    //alert("Lütfen boş alan bırakmayınız")
                    this.$toasted.error("Lütfen boş alan bırakmayınız")
                    return
                }
            }
            
            if(this.formData.db_bayi_sozlesmesi == ""){
                this.$toasted.error("Lütfen bayilik sözleşmesini onaylayınız.")

                return
            }

            this.$toasted.info("Verileriniz kaydediliyor. Lütfen bekleyiniz.")
            this.formData.db_ulke=this.ulke_obj.id
            this.formData.db_sehir=this.sehir_obj.id
            this.formData.db_ilce=this.ilce_obj.id
            this.formData.db_ulke_obj=JSON.stringify(this.ulke_obj)
            this.formData.db_sehir_obj=JSON.stringify(this.sehir_obj)
            this.formData.db_ilce_obj=JSON.stringify(this.ilce_obj)
            //this.formData.db_kategori=JSON.stringify(this.formData.kategori)
            //return
            axios
                .post(this.pageUrl + "/registerPost", this.formData)
                .then((response) => {
                    if(response.data.status){
                        this.$toasted.success(response.data.message)
                        setTimeout(function(){ 
                            window.location.href="/login"
                        }, 3000);

                    }else{
                        this.$toasted.error(response.data.message)
                        this.ulkeGetir()
                        this.formData.db_ulke={}
                        this.formData.db_ilce={}
                        this.formData.db_sehir={}
                    }
                    //this.dataGet();
                })
                .catch((error) => {
                    console.log(error);
                    this.$toasted.error(error.data.message)
                });
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
        },
        dataDelete(data2) {
            axios
                .post(this.pageUrl + "/delete", { data: data2 })
                .then((response) => {
                    this.$toasted.success(response.data.message)
                    this.dataGet();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style>
#my-strictly-unique-vue-upload-multiple-image {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>