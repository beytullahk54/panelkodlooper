<template>
    <div>
        <universite-modal
            @kaydet="dataStore"
            :data="formData"
            :modal="modalData"
        ></universite-modal>
        <div class="row">
            <div class="col-md-4">
                <button
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModal"
                    @click="dataCreate"
                    type="button"
                    class="btn btn-primary"
                >
                    Yeni Kurum Ekle
                </button>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="input-group mb-3">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Ara"
                        v-model="query"
                        aria-label="Ara"
                        aria-describedby="basic-addon2"
                        @keyup.enter="dataGet()"
                    />
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">
                            <i
                                style="cursor:pointer"
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
                                                            data-sort="budget"
                                                        >
                                                            Kurum
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            Durum
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            e-Devlet Onayı
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            Ulusal Geçerlilik
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            Uluslararası Geçerlilik
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            Düzenle
                                                        </th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list">
                                                    <tr
                                                        v-for="data in datas.data"
                                                    >
                                                        <td>
                                                            {{ data.db_adi }}
                                                        </td>
                                                        <td>
                                                            <span class="alert alert-success btn-block" style="cursor: pointer;" @click="dataOnayla(data,'db_durum','pasif')" v-if="data.db_durum=='aktif'">Aktif</span>
                                                            <span class="alert btn-block" style="background: #b9b9b9;color: white;cursor: pointer;" @click="dataOnayla(data,'db_durum','aktif')" v-if="data.db_durum=='pasif'">Yakında</span>
                                                        </td>
                                                        <td>
                                                            <span class="alert alert-success btn-block" style="cursor: pointer;" @click="dataOnayla(data,'db_edevlet','pasif')" v-if="data.db_edevlet=='aktif'">e-Devlet</span>
                                                            <span class="alert btn-block" style="background: #b9b9b9;color: white;cursor: pointer;" @click="dataOnayla(data,'db_edevlet','aktif')" v-if="data.db_edevlet=='pasif'">e-Devlet</span>
                                                        </td>
                                                        <td>
                                                            <span class="alert  alert-success btn-block" style="cursor:pointer;" @click="dataOnayla(data,'db_ulusal_gecerlilik','pasif')"  v-if="data.db_ulusal_gecerlilik=='aktif'">Ulusal</span>
                                                            <span class="alert btn-block"  style="background: #b9b9b9;color: white;cursor:pointer;" @click="dataOnayla(data,'db_ulusal_gecerlilik','aktif')" v-if="data.db_ulusal_gecerlilik=='pasif'">Ulusal</span>
                                                        </td>
                                                        <td>
                                                            <span class="alert alert-success btn-block" style="cursor:pointer;" @click="dataOnayla(data,'db_uluslararasi_gecerlilik','pasif')" v-if="data.db_uluslararasi_gecerlilik=='aktif'">Uluslararası</span>
                                                            <span class="alert btn-block"  style="background: #b9b9b9;color: white;cursor:pointer;" @click="dataOnayla(data,'db_uluslararasi_gecerlilik','aktif')" v-if="data.db_uluslararasi_gecerlilik=='pasif'">Uluslararası</span>
                                                        </td>
                                                        <td class="text-right">
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
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#exampleModal"
                                                                        @click="
                                                                            showUpdateDrawer(
                                                                                data
                                                                            )
                                                                        "
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
            query: "",
            modalData: {
                butonBaslik: "", // butonBaslik'u burada tanımlayın
            },
            datas: []
        };
    },
    props: { pageTitle: String, pageUrl: String },
    mounted() {
        this.dataGet();
    },
    methods: {
        dataGet(page = 1) {
            axios
                .post(this.pageUrl + "/get?page=" + page,{query:this.query})
                .then((response) => {
                    this.datas = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        dataOnayla(data,key,value){
            var dataList={};
            dataList.id=data.id
            dataList.key=key
            dataList.value=value
            axios
                .post(this.pageUrl + "/onayla" ,{dataList:dataList})
                .then((response) => {
                    this.$toasted.success(response.data.message)
                    this.dataGet()
                })
                .catch((error) => {
                    console.log(error);
                }); 
        },
        dataCreate() {
            this.formData = {};
            this.modalData.islem = "/create";
            this.modalData.butonBaslik = "Yeni Kayıt";
            this.modalData.type = "create";
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
