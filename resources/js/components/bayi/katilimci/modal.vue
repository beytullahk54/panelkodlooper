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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
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
                        >X</button>
                    </div>
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
                                    <multiselect v-model="data.db_ulke" :options="ulkes"   :multiple="false" label="baslik" placeholder="Ülke Seçiniz"  @input="sehirGetir"></multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" v-if="sehirs.length>0">
                            <div class="row ">
                                <div class="col-md-4 align-self-center">
                                    <label for="exampleInputPassword">Şehir *</label>        
                                </div>
                                <div class="col-md-8">
                                    <multiselect v-model="data.db_sehir" :options="sehirs"   :multiple="false" label="baslik" placeholder="Şehir Seçiniz"   @input="ilceGetir"></multiselect>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" v-if="ilces.length>0">
                            <div class="row ">
                                <div class="col-md-4 align-self-center">
                                    <label for="exampleInputPassword">İlçe *</label>        
                                </div>
                                <div class="col-md-8">
                                    <multiselect v-model="data.db_ilce" :options="ilces"   :multiple="false" label="baslik" placeholder="İlçe Seçiniz"  @input="bitis"></multiselect>
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
                        <div class="mb-3">
                            <h3>Eğitimler / Programlar</h3>
                            <div class="row">
                                <div class="col-md-3"><span class="btn btn-success " style="font-size:14px;cursor:pointer" @click="katilimciEgitimOlustur">+ Eğitim/Program Ekle</span></div>
                            </div>
                            <br><br><br>
                            <div class="row align-items-center">
                                <div class="col-md-12 " >
                                    <table style="width: 100%; text-align: center;">
                                        <tr v-for="sertifika in data.sertifikas">
                                            <td>
                                                <multiselect v-model="sertifika.egitim" :options="dataEgitims" track-by="db_adi" label="db_adi"  placeholder="Ürün Seçiniz"></multiselect>
                                            </td>
                                            <td>
                                                <multiselect v-model="sertifika.varyant" :options="dataVaryants"   :multiple="true" label="db_adi" placeholder="Ek Hizmet Seçiniz"></multiselect>
                                            </td>
                                            <td >
                                                <div style="display: flex; flex-direction: column; align-items: center;">
                                                    Eğitim :{{ sertifika.egitim?.db_bayi_alis_fiyati }}<br>
                                                    Varyant :
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
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
                            @click="kaydetClicked"
                            class="btn btn-primary"
                            data-bs-dismiss="modal"
                        >
                            Kaydet
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<script>
export default {
    data() {
        return {
            sertifikas:[],
            value: null,
            value2: null,
            options: ['list', 'of', 'options'],
            ulkes:[],
            ilces:[],
            sehirs:[],
        };
    },
    mounted(){
        this.ulkeGetir()
    },
    props: {
        data: Object,
        dataEgitims: Array,
        dataVaryants: Array,
        modal: Object,
    },
    methods: {


        ulkeGetir(){
            axios
                .post( "/registerUlke",
                { headers: {
                    "Content-Type": "multipart/form-data"
                }})
                .then((response) => {
                    this.ulkes=response.data
                    this.data.db_ulke =
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
                .post( "/registerSehir",{"ulke_id":this.data.db_ulke.id})
                .then((response) => {
                    this.data.db_sehir=[]
                    this.data.db_ilce=[]
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
                .post( "/registerIlce",{"sehir_id":this.data.db_sehir.id})
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
                egitimAdi:"a"
            })
        },
        kaydetClicked() {
            // Modal içinde "Kaydet" butonuna tıklandığında bu metod çalışacak
            this.$emit("kaydet", { data: this.data });
        },
    },
};
</script>
