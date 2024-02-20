<template>
    <div>
        <egitim-detay-modal
            @kaydet="dataStore"
            :data="formData"
            :modal="modalData"
        ></egitim-detay-modal>
        <div class="row">
            <div class="col-md-4">
                <a
                    :href="this.bayi=='true'?'/bayi/egitimlerim/yeni':'/admin/egitim/yeni'"
                    type="button"
                    class="btn btn-primary"
                >
                    Yeni Eğitim Ekle
                </a>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="input-group mb-3">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Ara"
                        v-model="query"
                        @keyup.enter="dataGet()"
                        aria-label="Ara"
                        aria-describedby="basic-addon2"
                    />
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">
                            <i
                                class="fa fa-search"
                                @click="dataGet()"
                                aria-hidden="true"
                            ></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row align-items-center">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="startDate">Başvuru Durum</label>
                    <multiselect @input="dataGet" :options="dataDurums" v-model="durumSelect" track_by="id" :multiple="false" label="db_adi" placeholder="Başvuru Seçiniz"  ></multiselect>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="endDate">Kategori</label>
                    <multiselect  @input="dataGet"  :options="dataKategoris" v-model="kategoriSelect" track_by="id" :multiple="false" label="db_adi" placeholder="Kategori Seçiniz"  ></multiselect>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="endDate">Kurum</label>
                    <multiselect  @input="dataGet"  :options="dataUniversite" v-model="universiteSelect" track_by="id" :multiple="false" label="db_adi" placeholder="Kurum Seçiniz"  ></multiselect>
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
                                            <table
                                                class="table align-items-center "
                                            >
                                                <thead >
                                                    <tr>
                                                        <th
                                                        >
                                                            Görsel
                                                        </th>
                                                        <th
                                                           style="max-width: 100px!important;"
                                                        >
                                                            Eğitim Adı
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                           Eğitim Onay Durumu
                                                        </th>
                                                        <th
                                                            v-if="!bayi"
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            Başvuru Durumu
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            Alış Fiyatı
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            Kurum
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            Kategori Adı
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            Kategori Sınıfı
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            Kategori Sınıf Kodu
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            İncele
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                            v-if="!bayi"
                                                        >
                                                            Düzenle
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list">
                                                    <tr
                                                        v-for="data in datas.data"
                                                    >
                                                        <td>
                                                            <a target="_blank" data-toggle="tooltip" data-placement="top" class="btn btn-tooltip" title="Düzenle" data-container="body" data-animation="true" :href="'/admin/egitim/guncelle/'+data.id"  v-if="!bayi">
                                                                <img width="30" height="30" src="https://img.icons8.com/external-tanah-basah-glyph-tanah-basah/48/external-edit-social-media-ui-tanah-basah-glyph-tanah-basah.png" alt="external-edit-social-media-ui-tanah-basah-glyph-tanah-basah"/>
                                                            </a>
                                                            <img :src="'/'+data.db_gorsel" alt="" style="max-width:75px">
                                                        </td>
                                                        <td >
                                                            <span >{{ data.db_adi }}</span>
                                                            
                                                        </td>
                                                        <td>

                                                            <template  v-if="bayi=='true'">
                                                                <span  v-if="data.db_bayi_onay_durumu=='kapali'"  class="btn btn-danger btn-block">ONAY BEKLİYOR</span>
                                                                <span  v-if="data.db_bayi_onay_durumu=='acik'"  class="btn btn-success btn-block">ONAYLANDI</span>
                                                            </template>
                                                            <template  v-if="!bayi">
                                                                
                                                                <span @click="islemGuncelle(data,'db_bayi_onay_durumu','acik')" v-if="data.db_bayi_onay_durumu=='kapali'" style="cursor:pointer" class="btn btn-danger btn-block">
                                                                    ONAY BEKLİYOR<br>
                                                                    {{ data.firma?"("+data.firma.firma_adi+")":"" }}
                                                                </span>
                                                                <span @click="islemGuncelle(data,'db_bayi_onay_durumu','kapali')" v-if="data.db_bayi_onay_durumu=='acik'" style="cursor:pointer" class="btn btn-success btn-block">
                                                                    ONAYLANDI<br>
                                                                    {{ data.firma?"("+data.firma.firma_adi+")":"" }}
                                                                </span>
                                                            </template>
                                                            
                                                        </td>
                                                        <td v-if="!bayi">
                                                            <span @click="islemGuncelle(data,'db_basvuru_durumu','kapali')" v-if="data.db_basvuru_durumu=='acik'" style="cursor:pointer" class="btn btn-success btn-block">AÇIK</span>
                                                            <span @click="islemGuncelle(data,'db_basvuru_durumu','acik')" v-if="data.db_basvuru_durumu=='kapali'" style="cursor:pointer" class="btn btn-danger btn-block">KAPALI</span>
                                                        
                                                        </td>
                                                        <td>
                                                            <span style="background-color: #7030A0;" class="btn btn-primary btn-block" v-if="bayi=='true'">
                                                                {{data.db_bayi_alis_fiyati}} ₺
                                                            </span>
                                                            <span style="background-color: #7030A0;" class="btn btn-primary btn-block" v-else>
                                                                <input type="text"  style="color: white;background: transparent;text-align:center" v-on:change="fiyatGuncelle(data)" v-model="data.db_bayi_alis_fiyati" > ₺
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span style="background-color: #53b29d;" v-if="data.db_universite!='[]'" class="btn btn-primary btn-block">{{ data.db_universite?JSON.parse(data.db_universite)[0].db_adi:""}}</span>
                                                        </td>
                                                        <td>
                                                            <span style="background-color: #535eb2;" class="btn btn-primary btn-block">{{ data.db_egitim_kodu}}</span>                     
                                                        </td>
                                                        <td>

                                                            <span v-if="data.db_kategori !='[]' &&  data.db_kategori!='null'" style="background-color: #01B0F0;" class="btn btn-primary btn-block">{{ data.db_kategori?JSON.parse(data.db_kategori).db_adi:""}}</span>
                                                        </td>
                                                        <td>
                                                            <span style="background-color: #535eb2;" v-if="data.db_kategori !='[]' &&  data.db_kategori!='null'" class="btn btn-primary btn-block">{{ data.db_kategori?JSON.parse(data.db_kategori).id:""}}</span>
                                                        </td>
                                                        <td>
                                                            <a :href="'/admin/egitim/detayPage/'+data.id" class="btn btn-block btn-primary"
                                                            > DETAY</a>
                                                        </td>
                                                        <td class="text-right"   v-if="!bayi">
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
                                                                        target="_blank"
                                                                        :href="'/admin/egitim/guncelle/'+data.id" 
                                                                        >Düzenle</a
                                                                    >
                                                                    <a
                                                                        class="dropdown-item"
                                                                        href="#"
                                                                        @click="
                                                                            dataDelete(
                                                                                data
                                                                            )
                                                                        "
                                                                        >Sil</a
                                                                    >
                                                                    <a
                                                                        class="dropdown-item"
                                                                        href="#"
                                                                        @click="
                                                                            dataKopyala(
                                                                                data
                                                                            )
                                                                        "
                                                                        >Kopyala</a>
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
                                        <li
                                            class="page-item"
                                            v-if="datas.current_page > 1"
                                        >
                                            <a
                                                class="page-link"
                                                @click="
                                                    dataGet(
                                                        datas.current_page - 1
                                                    )
                                                "
                                            >
                                                <i
                                                    class="fas fa-chevron-left"
                                                ></i>
                                            </a>
                                        </li>

                                        <li
                                            class="page-item"
                                            v-for="page in datas.last_page"
                                            :key="page"
                                            :class="{
                                                active:
                                                    page === datas.current_page,
                                            }"
                                        >
                                            <a
                                                class="page-link"
                                                @click="dataGet(page)"
                                            >
                                                {{ page }}
                                            </a>
                                        </li>

                                        <li
                                            class="page-item"
                                            v-if="
                                                datas.current_page <
                                                datas.last_page
                                            "
                                        >
                                            <a
                                                class="page-link"
                                                @click="
                                                    dataGet(
                                                        datas.current_page + 1
                                                    )
                                                "
                                            >
                                                <i
                                                    class="fas fa-chevron-right"
                                                ></i>
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
            rezervasyonBaglantisi: false,
            hizmetler: {},
            visible: false,
            updateVisible: false,
            formData: {},
            baglanti_adi: "",
            baglanti_update_adi: "",
            durumSelect:"",
            kategoriSelect:"",
            universiteSelect:"",
            query: "",
            dataDurums:[{"db_adi":"Açık",db_code:"acik"},{"db_adi":"Kapalı",db_code:"kapali"},],
            dataUniversite:[],
            dataKategoris:[],
            modalData: {
                butonBaslik: "", // butonBaslik'u burada tanımlayın
            },
            datas: []
        };
    },
    props: { pageTitle: String, pageUrl: String,bayi:String },
    mounted() {
        this.dataGet();
        this.dataGetKategori();
        this.dataGetUniversite();
        console.log(this.bayi)
    },
    methods: {
        dataGet(page = 1) {
            if(this.bayi=="true")
            {
                axios
                .post(this.pageUrl + "/get?page=" + page,{queryData:this.query,durumSelect:this.durumSelect?.db_code,kategoriSelect:this.kategoriSelect?.id,universiteSelect:this.universiteSelect?.id})
                .then((response) => {
                    this.datas = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });    
            }else{
                axios
                .post(this.pageUrl + "/get?page=" + page,{queryData:this.query,durumSelect:this.durumSelect?.db_code,kategoriSelect:this.kategoriSelect?.id,universiteSelect:this.universiteSelect?.id})
                    .then((response) => {
                        this.datas = response.data.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
        dataGetKategori(){
            let axiosUrl="";
            axiosUrl = "/admin/"+this.pageUrl + "/getKategori"
            
            axios
                .post(axiosUrl)
                .then((response) => {
                    console.log(response.data);
                    this.dataKategoris = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        dataGetUniversite(){

            let axiosUrl="";
            axiosUrl ="/admin/"+this.pageUrl + "/getUniversite"
            axios
                .post(axiosUrl)
                .then((response) => {
                    console.log(response.data);
                    this.dataUniversite = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        dataGetFiltrele(page=1)
        {
         
        },
        fiyatGuncelle(data){
            console.log(data)
            this.modalData.islem = "/fiyatGuncelle";
            this.dataStore(data)
        },
        islemGuncelle(data,key,value){
            var keyData    = {}
            keyData.id     = data.id
            keyData.key    = key
            keyData.value  = value
            this.modalData.islem = "/islemGuncelle";
            this.dataStore(keyData)
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
        dataStore(data) {
            axios
                .post(this.pageUrl + this.modalData.islem, data)
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
        dataKopyala(data){
            axios
                .post(this.pageUrl + "/kopyala", { data: data })
                .then((response) => {
                    this.$toasted.success(response.data.message)
                    this.dataGet();
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    },
};
</script>
