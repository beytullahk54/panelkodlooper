<template>
    <div>
        <egitim-detay-modal
            @kaydet="dataStore"
            :data="formData"
            :modal="modalData"
        ></egitim-detay-modal>
        <div class="row">
            <div class="col-md-4"></div>
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
                                                class="table align-items-center table-flush"
                                            >
                                                <thead class="thead-light">
                                                   
                                                    <tr>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="name"
                                                        >
                                                            GÖRSEL
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget" 
                                                        >
                                                            EĞİTİM ADI
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            BAŞVURU DURUMU
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            ALIŞ FİYATI
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            KURUM
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            KATEGORİ ADI
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            KATEGORİ SINIFI
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            KATEGORİ SINIF KODU
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            İNCELE
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list">
                                                    <tr
                                                        v-for="data in datas.data"
                                                    >
                                                        <td>
                                                            <img :src="'/'+data.db_gorsel" alt="" style="max-width:75px">
                                                        </td>
                                                        <td style="white-space: normal; word-wrap: break-word;">
                                                            {{ data.db_adi }}
                                                        </td>
                                                        <td>
                                                            <span  v-if="data.db_basvuru_durumu=='acik'" style="cursor:pointer" class="btn btn-success btn-block">AÇIK</span>
                                                            <span v-if="data.db_basvuru_durumu=='kapali'" style="cursor:pointer" class="btn btn-danger btn-block">KAPALI</span>
                                                        </td>  
                                                        <td>
                                                            <span style="background-color: #7030A0;color:white" class="btn  btn-block">
                                                                {{ data.db_bayi_alis_fiyati }} ₺
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
                                                            <span style="background-color: #535eb2;" v-if="data.db_kategori!='[]'" class="btn btn-primary btn-block">{{ data.db_kategori?JSON.parse(data.db_kategori).id:""}}</span>                     
                                                        </td>
                                                      
                                                        <td>
                                                            <a :href="'/bayi/egitim/detayPage/'+data.id" class="btn btn-block btn-primary"
                                                            > DETAY</a>
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
            rezervasyonBaglantisi: false,
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
            columns,
        };
    },
    props: { pageTitle: String, pageUrl: String },
    mounted() {
        this.dataGet();
    },
    methods: {
        dataGet(page = 1) {
            axios
                .post(this.pageUrl + "/get?page=" + page,{queryData:this.query})
                .then((response) => {
                    console.log(response.data);
                    this.datas = response.data.data;
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
        dataStore(data) {
            console.log(data);
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
