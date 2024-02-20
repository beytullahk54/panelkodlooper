<template>
    <div>
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
                                                            Başlık / Açıklama
                                                        </th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list">
                                                    <tr
                                                        v-for="data in datas.data"
                                                    >
                                                        <td>
                                                            <h3 style="font-weight: 900;text-decoration: underline;">{{ data.db_aciklama }}</h3><br><br>
                                                           
                                                            <editor v-if="data.db_type=='editor'" api-key="wsuxoph1s8qivel18r8hn6t0dnliik8883sz5nqy2gf07vgi"  v-model="data.db_value" class="form-control"  rows="28" cols="50"></editor>
                                                            <input v-if="data.db_type=='number'" class="form form-control" type="number" v-model="data.db_value"/> <br>
                                                            <template v-if="data.db_type=='multiselect'">
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <input type="text" v-model="data.multiData" class="form-control">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        
                                                                        <input type="button" value="Oluştur" @click="multiOlustur(data)" class="btn btn-block btn-success">
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <table >
                                                                        <tr   v-for="(db ,key)  in data.db_value">
                                                                            <td> {{ db.db_adi }} - <button class="btn btn-danger" @click="multiSil(data,key)">Sil</button></td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </template><br>
                                                            
                                                            <button class="btn btn-primary btn-block" @click="dataStore(data)">Kaydet</button>
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
            inputData:"",
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
        multiOlustur(data){
            console.log(data)
            let id=0;
            
            if (data.db_value == null || data.db_value.length === 0) {
                id = 1;
                data.db_value=[]
            }else{
                id = data.db_value[data.db_value.length - 1].id + 1;
                
            }
            data.db_value.push({
                db_adi:data.multiData,
                id:id
            })
            console.log(data)
        },
        multiSil(data,key){
            data.db_value.splice(key,1)
        },
        dataGet(page = 1) {
            axios
                .post(this.pageUrl + "/get?page=" + page)
                .then((response) => {
                    console.log(response.data);
                    response.data.data.data.map(element=>  {
                        if(element.db_type=="multiselect")
                        {
                            element.db_value=JSON.parse(element.db_value)
                        }
                    });
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
                .post(this.pageUrl + "/update", data)
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
                    this.dataGet();
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
