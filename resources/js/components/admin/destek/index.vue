<template>
    <div>
        <destek-modal
            @kaydet="dataStore"
            :data="formData"
            :modal="modalData"
            :bayis="bayis"
            @bayiUpdate="bayiUpdate"
        ></destek-modal>

        <div class="row">
            <div class="col-md-4 m-2">

                <button
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModal"
                    @click="dataCreate"
                    type="button"
                    class="btn btn-primary btn-block"
                >
                    Yeni Talep Oluştur
                </button>
            </div>
            <div class="col-md-4 m-2">
                <button class="btn-primary btn-success btn btn-block" @click="durumDegistir('bekleyenler')">Açık / Cevaplandı</button>
            </div>
            <div class="col-md-4 m-2">
                <button class="btn-primary btn-danger btn btn-block" @click="durumDegistir('tamamlananlar')">Tamamlandı</button>
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
                                                            
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            Destek Konu
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="name"
                                                        >
                                                            Id
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            Kayıt Tarihi
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            Durum
                                                        </th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list">
                                                    <tr
                                                        v-for="data in datas.data"
                                                    >
                                                    <td class="text-center" style="width:100px">
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
                                                            <img src="https://img.icons8.com/cotton/64/menu.png" width="32" height="32" alt="">
                                                            </a>
                                                            <div
                                                                class="dropdown-menu dropdown-menu-right dropdown-menu-arrow"
                                                            >
                                                                <a
                                                                    class="dropdown-item"
                                                                    href="#"
                                                                    @click="
                                                                        dataGuncelle(
                                                                            data,'tamamlandi'
                                                                        )
                                                                    "
                                                                    >Tamamla</a
                                                                >
                                                                <a
                                                                    class="dropdown-item"
                                                                    href="#"
                                                                    @click="
                                                                        dataGuncelle(
                                                                            data,'acik'
                                                                        )
                                                                    "
                                                                    >Aktif Et</a
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
                                                        <a 

                                                            data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal"
                                                            @click="
                                                                showUpdateDrawer(
                                                                    data
                                                                )
                                                            "
                                                            style="cursor: pointer;"
                                                        >
                                                            <img src="https://img.icons8.com/external-tanah-basah-glyph-tanah-basah/30/external-edit-social-media-ui-tanah-basah-glyph-tanah-basah.png" alt="">
                                                        </a>
                                                        <a 

                                                            @click="
                                                                dataDelete(
                                                                    data
                                                                )
                                                            "
                                                            style="cursor: pointer;"
                                                        >
                                                            <img width="30" height="30" src="https://img.icons8.com/ios-filled/50/delete-forever.png" alt="delete-forever"/>                                                        </a>
                                                        </td>
                                                        <td>
                                                            {{
                                                                data.db_destek_konu
                                                            }}
                                                        </td>
                                                        <td>
                                                            {{ data.id }}
                                                        </td>
                                                        <td>
                                                            {{
                                                               data.created_at | dateConverter
                                                            }}
                                                        </td>
                                                        <td>
                                                            <span v-if="data.db_destek_durumu == 'acik'" style="font-size:10px" class="badge badge-primary "> Açık </span>
                                                            <span v-if="data.db_destek_durumu == 'cevaplandi'" style="font-size:10px" class="badge badge-success "> Cevaplandı </span>
                                                            <span v-if="data.db_destek_durumu == 'tamamlandi'" style="font-size:10px" class="badge badge-danger "> Tamamlandı </span>
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
            dataDurum:"bekleyenler",
            baglanti_adi: "",
            baglanti_update_adi: "",
            query: "",
            modalData: {
                butonBaslik: "", // butonBaslik'u burada tanımlayın
            },
            datas: [],
            bayis:[],
            seciliBayi:""
        };
    },
    props: { pageTitle: String, pageUrl: String },
    mounted() {
        this.dataGet();
        this.bayiGet();
    },
    methods: {
        durumDegistir(durum="bekleyenler"){
            this.dataDurum=durum
            this.dataGet();
        },
        dataGet(page = 1) {
            axios
                .post(this.pageUrl + "/get?page=" + page,{durum:this.dataDurum,seciliBayi:this.seciliBayi.id})
                .then((response) => {
                    console.log(response.data);
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
                    console.log(this.bayis)
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        bayiUpdate(data) {
            //console.log(data.data.db_hedef_firma)
            this.formData.db_firma_id = data.data.db_hedef_firma.id
            console.log(this.formData)
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
        dataGuncelle(data,islem) {
            axios
                .post(this.pageUrl + "/islemGuncelle", {"data":data,"islem":islem})
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
