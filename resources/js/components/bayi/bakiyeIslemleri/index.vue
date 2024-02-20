<template>
    <div>

        <bakiye-islemleri-modal-bayi @kaydet="dataStore" :data="formData" :modal="modalData" :paytrToken="paytrToken"  bayi="true"></bakiye-islemleri-modal-bayi>
        <div class="row">
            <div class="col-lg-5 col-md-12 p-2">
                <a href="/bayi/bakiye-islemleri/yeni"
                    class="btn btn-primary m-1">
                    Bakiye Yükle
                </a>
                <span class="btn btn-success m-1" >Bakiyeniz: {{ firma.bakiye }} ₺ </span>
            </div>
            <div class="col-lg-2 "></div>
            <div class="col-lg-5 col-md-12 p-2">
                <div class="input-group mb-3">
                    <input type="text" class="form-control"  @keyup.enter="dataGet()" placeholder="Ara" v-model="query" aria-label="Ara"
                        aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">
                            <i class="fa fa-search" 
                                @click="dataGet()" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="startDate">Başlangıç Tarihi:</label>
                    <input type="date" 
                        v-model="baslangicTarihi" class="form-control" id="startDate" name="startDate" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="endDate">Bitiş Tarihi:</label>
                    <input type="date" 
                        v-model="bitisTarihi" class="form-control" id="endDate" name="endDate" />
                </div>
            </div>

            <div class="col-md-4">
                <button type="button" class="btn btn-primary btn-block" 
                    @click="dataGet">
                    Filtrele
                </button>
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
                                                            Ödeme ID
                                                        </th>
                                                        <th scope="col" class="sort" data-sort="budget">
                                                            İşlem Tarihi
                                                        </th>
                                                        <th scope="col" class="sort" data-sort="budget">
                                                            Ödeme Tutarı
                                                        </th>
                                                        <th scope="col" class="sort" data-sort="budget">
                                                            Ödeme Türü
                                                        </th>
                                                        <th scope="col" class="sort" data-sort="budget">
                                                            İşlem Türü
                                                        </th>
                                                        <th scope="col" class="sort" data-sort="budget">
                                                        </th>
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
                                                            <span class="btn btn-success btn-block" v-if="data.db_odeme_turu=='kredi_karti'">Kredi Kartı</span>
                                                            <span class="btn btn-success btn-block" v-if="data.db_odeme_turu=='banka'">Havale / EFT</span>
                                                            <span class="btn btn-success btn-block" v-if="data.db_odeme_turu=='yonetici'">Yönetici</span>
                                                        </td>
                                                        <td>


                                                            <span class="btn btn-success btn-block" v-if="data.db_odeme_durumu=='kredi_karti_onaylandi'">Ödeme Onaylandı (Kredi Kartı)</span>
                                                            <span class="btn btn-success btn-block" v-if="data.db_odeme_durumu=='odeme_onaylandi'">Ödeme Onaylandı</span>
                                                            <span class="btn btn-primary btn-block" v-if="data.db_odeme_durumu=='onay_bekliyor'">Onay Bekliyor</span>
                                                            <span class="btn btn-success btn-block" v-if="data.db_odeme_durumu=='odeme_basarisiz'">Ödeme Başarısız</span>
                                                            <span class="btn btn-danger btn-block" v-if="data.db_odeme_durumu=='islem_iptal_edildi'">İşlem İptal Edildi</span>
                                                            <span class="btn btn-danger btn-block" v-if="data.db_odeme_durumu=='bayi_islem_iptal'">İşlem İptal Edildi</span>
                                                            <span class="btn btn-success btn-block" v-if="data.db_odeme_durumu=='iade_edildi'">İade Edildi</span>
                                                        </td>

                                                        <td class="text-right" v-if="data.db_odeme_durumu=='onay_bekliyor'">
                                                            <div
                                                                class="dropdown"
                                                            >
                                                                <a
                                                                    class="btn btn-sm btn-icon-only text-light"
                                                                    href="#"
                                                                    role="button"
                                                                    data-toggle="dropdown"
                                                                    aria-haspopup="true"
                                                                    aria-expanded="false"
                                                                >
                                                                    <i
                                                                        class="fas fa-ellipsis-v"
                                                                    ></i>
                                                                </a>
                                                                <div
                                                                    class="dropdown-menu dropdown-menu-right dropdown-menu-arrow"
                                                                >
                                                                    <a
                                                                        class="dropdown-item"
                                                                        href="#"
                                                                        @click="
                                                                            islemYap(
                                                                                data,'bayi_islem_iptal'
                                                                            )
                                                                        "
                                                                        >İptal Et</a
                                                                    >
                                                                   
                                                                </div>
                                                            </div>
                                                        </td>
                                                        
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--<div v-html="odemeForm" style="z-index:1000000000000000"></div>-->

    </div>
</template>

<script>
import Base64 from 'crypto-js/enc-base64';

import axios from 'axios';

const columns = [
    {
        title: "Bağlantı Adı",
        dataIndex: "baglanti_adi",
        key: "baglanti_adi",
        ellipsis: true,
    },
    {
        title: "Bağlantı Url",
        dataIndex: "baglanti_url",
        key: "baglanti_url",
    },
    {
        title: "İşlem",
        key: "action",
        fixed: "right",
        scopedSlots: { customRender: "action" },
    },
];

export default {
    data() {
        return {
            baslangicTarihi:null,
            bitisTarihi:null,
            hizmetler: {},
            visible: false,
            updateVisible: false,
            formData: {},
            baglanti_adi: "",
            baglanti_update_adi: "",
            query: "",
            modalData: {
                butonBaslik: "", // butonBaslik'u burada tanımlayın
            },
            datas: [],
            firma: [],
            columns,
            odemeForm:{},
            safHTML:{},
            paytrToken:"",
        };
    },
    watch: {
        
    },
    props: { pageTitle: String, pageUrl: String },
    mounted() {
        this.dataGet();
    },
    methods: {
        dataGet(page = 1) {
            axios
                .post(this.pageUrl + "/get?page=" + page,{queryData:this.query,baslangicTarihi:this.baslangicTarihi,bitisTarihi:this.bitisTarihi})
                .then((response) => {
                    console.log(response.data);
                    this.datas = response.data;
                    this.firma = response.data.firma;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        islemYap(data,islem){
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
        paytrGet(){
            axios.post('/kredi-karti-paytr-on-hazirlik').then(res=>{
                this.paytrToken = res.result
            })

        },
        dataStore(data) {

           
            //this.iyzicoGetir()
            //return
            //console.log(data);
            /*axios
                .post(this.pageUrl + this.modalData.islem, data.data)
                .then((response) => {
                    this.$toasted.success(response.data.message)
                    if(data.data.db_odeme_turu == 'kredi_karti')
                    {
                        console.log("a")
                        location.href='/kredi_karti_odeme/'+response.data.data.id
                    }
                    this.dataGet();
                })
                .catch((error) => {
                    console.log(error);
                });*/
        },
        iyzicoGetir(){
            axios.get('/kredi-karti-odeme-api').then(res=>{
                console.log(res.data.data)
                this.odemeForm = res.data.data 
                console.log(this.safHTML)
            })
        },

        guvenliHTML(html) {
        // HTML içeriğini güvenli bir şekilde işleyen fonksiyon
        // Örneğin, DOMPurify gibi bir kütüphane kullanılabilir
        // Güvenli bir kütüphane seçimi, XSS saldırılarına karşı koruma sağlar
        // Bu örnekte DOMPurify kütüphanesi kullanılmıştır.
            const DOMPurify = require('dompurify');
            return DOMPurify.sanitize(html);
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
