<template>
    <div>
        <duyuru-modal
            @kaydet="dataStore"
            :data="formData"
            :modal="modalData"
            :bayis="bayis"
            @bayiUpdate="bayiUpdate"
        ></duyuru-modal>
        <div class="row">
            <div class="col-md-4">
                <button
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModal"
                    type="button"
                    class="btn btn-primary"
                    @click="dataCreate()"
                >
                    Yeni Duyuru Ekle
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
                                                            data-sort="budget"
                                                        >
                                                            Duyuru Tarihi
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            Duyuru Başlığı
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            Duyuru Tipi
                                                        </th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list">
                                                    <tr
                                                        v-for="data in datas.data"
                                                    >
                                                        <td>
                                                            {{ data.created_at | dateConverter }}
                                                        </td>
                                                        <td>
                                                            {{ data.db_adi }}
                                                        </td>
                                                        <td>
                                                            <span class="btn btn-success btn-block" v-if=" data.db_tip=='ozel'">
                                                                {{ data.db_tip=="ozel"?"Bayi":"" }} ({{  data.db_hedef_firma_id?JSON.parse(data.db_hedef_firma_id).firma_adi:"" }})
                                                            </span >
                                                            <span v-if=" data.db_tip=='herkes'" class="btn btn-primary btn-block">
                                                                {{ data.db_tip=="herkes"?"Herkes":"" }}
                                                            </span>
                                                            
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
            formData: {
                db_tip:"ozel"
            },
            baglanti_adi: "",
            baglanti_update_adi: "",
            query: "",
            bayis: [],
            modalData: {
                butonBaslik: "", // butonBaslik'u burada tanımlayın
            },
            datas: []
        };
    },
    props: { pageTitle: String, pageUrl: String },
    mounted() {
        this.dataGet();
        this.bayiGet();
    },
    methods: {
        dataGet(page = 1) {
            axios
                .post(this.pageUrl + "/get?page=" + page,{queryData:this.query})
                .then((response) => {
                    this.datas = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        bayiGet() {
            axios
                .post(this.pageUrl + "/bayiGet")
                .then((response) => {
                    this.bayis = response.data.data;
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
            this.formData = {

                db_tip:"herkes"
            };
            this.modalData.islem = "/create";
            this.modalData.butonBaslik = "Yeni Kayıt";
            this.modalData.type = "create";
        },
        showUpdateDrawer(data) {
            this.modalData.islem = "/update";
            this.updateVisible = true;
            
           // data.db_hedef_firma_id=JSON.parse(data.db_hedef_firma_id)
           this.formData = data;
           this.formData.db_hedef_firma = JSON.parse(this.formData.db_hedef_firma_id);
            
            console.log(this.formData)
            this.baglanti_update_adi = data.baglanti_adi;
            this.modalData.butonBaslik = "Güncelle";
            this.modalData.type = "update";
        },
        bayiUpdate(data) {
            //console.log(data.data.db_hedef_firma)
            this.formData.db_hedef_firma = data.data.db_hedef_firma
            console.log(this.formData)
        },
        dataStore(data) {
            if(data.data.db_hedef_firma){
                data.data.db_hedef_firma_id = JSON.stringify(data.data.db_hedef_firma)
            }
            console.log(data)
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
