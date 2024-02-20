<template>
    <div>
        <bakiye-islemleri-modal @kaydet="dataStore" :bayi="bayis" :data="formData" :modal="modalData"></bakiye-islemleri-modal>
        <div class="row">
            <div class="col-md-4">
                <button data-bs-toggle="modal" data-bs-target="#exampleModal" @click="dataCreate" type="button"
                    class="btn btn-primary btn-block">
                    Bakiye Yükle
                </button>
            </div>
            <div class="col-md-4">
                <download-excel 
                        :data="datas.data"
                        :fields="json_fields"
                        name="kampuslms.xls"
                        style="cursor:pointer;"
                    >
                        <img width="48" height="48"  src="https://img.icons8.com/color/48/export-excel.png" alt="export-excel"/>
                    </download-excel> 
            </div>
            <div class="col-md-4">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" 
                        @keyup.enter="dataGet()"
                        placeholder="Ara" v-model="query" aria-label="Ara"
                        aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">
                            <i class="fa fa-search" 
                                @click="dataGet()"
                                aria-hidden="true"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="startDate">Başlangıç Tarihi:</label>
                    <input
                        type="date"
                        v-model="baslangicTarihi"
                        @input="dataGet"
                        class="form-control"
                        id="startDate"
                        name="startDate"
                    />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="endDate">Bitiş Tarihi:</label>
                    <input
                        type="date"
                        @input="dataGet"
                        v-model="bitisTarihi"
                        class="form-control"
                        id="endDate"
                        name="endDate"
                    />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">                    
                    <label for="startDate">Bayi</label>
                    <multiselect 
                        @input="dataGet"
                        :options="bayis"
                        v-model="firmaSelect" 
                        :multiple="false"  
                        placeholder="Bayi Seçiniz"   
                        track-by="firma_adi" 
                        label="firma_adi"  >
                    </multiselect>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">                    
                    <label for="startDate">Ödeme Durumu</label>
                    <multiselect 
                        @input="dataGet"
                        :options="odemeDurumus"
                        v-model="odemeDurumuSelect" 
                        :multiple="false"  
                        placeholder="Ödeme Türü Seçiniz"   
                        track-by="db_code" 
                        label="db_adi"  >
                    </multiselect>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">                    
                    <label for="startDate">İşlem Durumu</label>
                    <multiselect 
                        @input="dataGet"
                        :options="islemDurumus"
                        v-model="islemDurumuSelect" 
                        :multiple="false"  
                        placeholder="Ödeme Türü Seçiniz"   
                        track-by="db_code" 
                        label="db_adi"  >
                    </multiselect>
                </div>
            </div>

        </div>
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
                            <div class="card mb-4">
                                <div class="card-body px-0 pt-0 pb-2">
                                    <div>
                                        <!-- Light table -->
                                        <div class="table-responsive">
                                            <table class="table align-items-center table-flush">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col" class="sort" data-sort="name">
                                                            ÖDEME ID
                                                        </th>
                                                        <th scope="col" class="sort" data-sort="budget">
                                                            İşlem Tarihi
                                                        </th>
                                                        <th scope="col" class="sort" data-sort="budget">
                                                            Ödeme
                                                        </th>
                                                        <th scope="col" class="sort" data-sort="budget">
                                                            Ödeme Türü
                                                        </th>
                                                        <th scope="col" class="sort" data-sort="budget">
                                                            Firma
                                                        </th>
                                                        <th scope="col" class="sort" data-sort="budget">
                                                            İşlem Durumu
                                                        </th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list">
                                                    <tr v-for="data in datas.data">
                                                        <td>
                                                            {{ data.id }}
                                                        </td>
                                                        <td>
                                                            {{
                                                                data.created_at | dateConverter
                                                            }}
                                                        </td>
                                                        <td>
                                                            {{
                                                                data.db_odeme_miktari
                                                            }} ₺
                                                        </td>
                                                        <td>
                                                            <span class="alert alert-success btn-block" v-if="data.db_odeme_turu=='kredi_karti'">Kredi Kartı</span>
                                                            <span class="alert alert-success btn-block" v-if="data.db_odeme_turu=='banka'">Havale / EFT</span>
                                                            <span class="alert alert-success btn-block" v-if="data.db_odeme_turu=='yonetici'">Yönetici</span>
                                                        </td>
                                                        <td>
                                                            {{
                                                                data.firma?.firma_adi
                                                            }}
                                                        </td>
                                                        <td>
                                                            <span class="alert alert-success btn-block" v-if="data.db_odeme_durumu=='odeme_onaylandi'">Ödeme Onaylandı</span>
                                                            <span class="alert alert-primary btn-block" v-if="data.db_odeme_durumu=='onay_bekliyor'">Onay Bekliyor</span>
                                                            <span class="alert alert-success btn-block" v-if="data.db_odeme_durumu=='odeme_basarisiz'">Ödeme Başarısız</span>
                                                            <span class="alert alert-danger btn-block" v-if="data.db_odeme_durumu=='islem_iptal_edildi'">İşlem İptal Edildi</span>
                                                            <span class="btn btn-danger btn-block" v-if="data.db_odeme_durumu=='bayi_islem_iptal'">Bayi İptal Etti</span>
                                                            <span class="alert alert-success btn-block" v-if="data.db_odeme_durumu=='iade_edildi'">İade Edildi</span>
                                                            <span class="alert alert-success btn-block" v-if="data.db_odeme_durumu=='kredi_karti_onaylandi'">Kredi Kartı Onaylandı</span>
                                                            <span class="alert alert-danger btn-block" v-if="data.db_odeme_durumu=='kredi_karti_reddedildi'">Kredi Kartı Başarısız</span>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="dropdown">
                                                                <a class="btn btn-sm btn-icon-only text-light" href="#"
                                                                    role="button" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                </a>
                                                                <div
                                                                    class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                                    <a class="dropdown-item" v-if="data.db_odeme_durumu == 'onay_bekliyor'" href="#" 
                                                                        @click="
                                                                            islemYap(
                                                                                data,'odeme_onaylandi'
                                                                            )
                                                                        ">
                                                                        Ödemeyi Onayla
                                                                    </a>
                                                                    <a class="dropdown-item" v-if="data.db_odeme_durumu == 'onay_bekliyor'" href="#" 
                                                                        @click="
                                                                            islemYap(
                                                                                data,
                                                                                'islem_iptal_edildi'
                                                                            )
                                                                        ">
                                                                        İptal / İade
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sayfalama öğesi -->
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end">
                                        <li class="page-item" v-if="datas.current_page > 1">
                                            <a class="page-link" @click="
                                                dataGet(
                                                    datas.current_page - 1
                                                )
                                                ">
                                                <i class="fas fa-chevron-left"></i>
                                            </a>
                                        </li>

                                        <li class="page-item" v-for="page in datas.last_page" :key="page" :class="{
                                            active:
                                                page === datas.current_page,
                                        }">
                                            <a class="page-link" @click="dataGet(page)">
                                                {{ page }}
                                            </a>
                                        </li>

                                        <li class="page-item" v-if="datas.current_page <
                                            datas.last_page
                                            ">
                                            <a class="page-link" @click="
                                                dataGet(
                                                    datas.current_page + 1
                                                )
                                                ">
                                                <i class="fas fa-chevron-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            firmaSelect:"",
            odemeDurumuSelect:"",
            islemDurumuSelect:"",
            json_fields: {
                "ÖDEME ID":"id",                       
                "İşlem Tarihi":"created_at",                     
                "Ödeme":"db_odeme_miktari",       
                "Ödeme Türü": {
                    field: "db_odeme_turu",
                    callback: (value) => {
                        return value=="banka"?"Banka":value=="kredi_karti"?"Kredi Kartı":"Yönetici";
                    },
                },  
                "Firma": {
                    field: "firma",
                    callback: (value) => {
                    return value?.firma_adi;
                    },
                },          
                "İşlem Durumu": {
                    field: "db_odeme_durumu",
                    callback: (value) => {
                        return value=="odeme_onaylandi"?"Ödeme Onaylandı"
                        :value=="onay_bekliyor"?"Onay Bekliyor"
                        :value=="odeme_basarisiz"?"Ödeme Başarısız"
                        :value=="islem_iptal_edildi"?"İşlem İptal Edildi"
                        :value=="bayi_islem_iptal"?"Bayi İptal Etti"
                        :value=="iade_edildi"?"İade Edildi"
                        :value=="kredi_karti_onaylandi"?"Kredi Kartı Onaylandı"
                        :"";
                    },
                },                           
            },
            islemDurumus:[
                {id:1,db_adi:"Ödeme Onaylandı",db_code:"odeme_onaylandi"},
                {id:2,db_adi:"Onay Bekliyor",db_code:"onay_bekliyor"},
                {id:2,db_adi:"Ödeme Başarısız",db_code:"odeme_basarisiz"},
                {id:3,db_adi:"İşlem İptal Edildi",db_code:"islem_iptal_edildi"},
                {id:4,db_adi:"Bayi İptal Etti",db_code:"bayi_islem_iptal"},
                {id:5,db_adi:"İade Edildi",db_code:"iade_edildi"},
                {id:6,db_adi:"Kredi Kartı Onaylandı",db_code:"kredi_karti_onaylandi"},
            ],
            odemeDurumus:[
                {id:1,db_adi:"Kredi Kartı",db_code:"kredi_karti"},
                {id:1,db_adi:"Havale / EFT",db_code:"banka"},
                {id:1,db_adi:"Yönetici",db_code:"yonetici"},

            ],
            baslangicTarihi:null,
            bitisTarihi:null,
            hizmetler: {},
            visible: false,
            updateVisible: false,
            formData: {},
            bayis:{},
            baglanti_adi: "",
            baglanti_update_adi: "",
            query: "",
            modalData: {
                butonBaslik: "", // butonBaslik'u burada tanımlayın
            },
            datas: [],
            firma: [],
        };
    },
    props: { pageTitle: String, pageUrl: String },
    mounted() {
        this.dataGet();
    },
    methods: {
        dataGet(page = 1) {
            axios
                .post(this.pageUrl + "/get?page=" + page,{queryData:this.query,baslangicTarihi:this.baslangicTarihi,bitisTarihi:this.bitisTarihi,firmaSelect:this.firmaSelect?.id,odemeDurumuSelect:this.odemeDurumuSelect?.db_code,islemDurumuSelect:this.islemDurumuSelect?.db_code})
                .then((response) => {
                    this.datas = response.data;
                    this.bayis = response.data.bayi;
                    this.firma = response.data.firma;
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
        dateConverter(dateF){

            // Date nesnesini oluştur
            const date = new Date(dateF);

            // Yılın son iki rakamını al
            const year = date.getFullYear().toString().slice(-2);

            // Ayı al ve gerekirse başına sıfır ekle
            const month = (date.getMonth() + 1).toString().padStart(2, '0');

            // Günü al ve gerekirse başına sıfır ekle
            const day = date.getDate().toString().padStart(2, '0');

            // Yeni formatı oluştur
            return `${day}.${month}.${year}`;
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
        islemYap(data,islem){
            console.log(data)
            console.log(islem)
            var islemList = {}
            islemList.data=data
            islemList.islem=islem
            axios
                .post(this.pageUrl + "/islemYap", {islemList:islemList})
                .then((response) => {
                    this.$toasted.success(response.data.message)
                    this.dataGet();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        dataStore(data) {
            axios
                .post(this.pageUrl + this.modalData.islem, data.data)
                .then((response) => {
                    this.$toasted.success(response.data.message)
                    this.dataGet();
                })
                .catch((error) => {
                    console.log(error);
                });
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
