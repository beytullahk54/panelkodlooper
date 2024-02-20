<template>
    <div>
        <div class="modal fade" id="aciklamaModal" tabindex="-1" role="dialog" aria-labelledby="aciklamaModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="aciklamaModalLabel">Açıklama</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{aciklamaModal}}
                    </div>
                </div>
            </div>
        </div>
        <katilimci-modal
            @kaydet="dataStore"
            :data="formData"
            :modal="modalData"
        ></katilimci-modal>
        <div class="row">
            <div class="col-md-2">
                <a
                    href="/admin/katilimci/yeni"
                    type="button"
                    class="btn btn-primary btn-block"
                >
                    Yeni Katılımcı Ekle
                </a>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <download-excel 
                        :data="datas.data"
                        :fields="json_fields"
                        name="kampuslms.xls"
                        style="cursor:pointer;"
                    >
                        <img width="48" height="48"  src="https://img.icons8.com/color/48/export-excel.png" alt="export-excel"/>
                    </download-excel>       
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group mb-3">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Ara"
                        v-model="query"
                        aria-label="Ara"
                        @keyup.enter="dataGet()"
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
            <div class="col-md-6">
                <div class="form-group">
                    <label for="startDate">Başlangıç Tarihi:</label>
                    <input
                        type="date"
                        @input="dataGet"
                        v-model="baslangicTarihi"
                        class="form-control"
                        id="startDate"
                        name="startDate"
                    />
                </div>
            </div>
            <div class="col-md-6">
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


        </div>
        <div class="row align-items-center">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="startDate">Eğitim</label>
                    <multiselect @input="dataGet" :options="dataEgitims" v-model="selectEgitim" track_by="id" :multiple="false" label="db_adi" placeholder="Eğitim Seçiniz"  ></multiselect>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="endDate">Varyant</label>
                    <multiselect  @input="dataGet"  :options="dataVaryants" v-model="selectVaryant" track_by="id" track-by="id" :multiple="false" label="db_adi" placeholder="Varyant Seçiniz"  ></multiselect>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="endDate">Kurum</label>
                    <multiselect  @input="dataGet" :options="dataUniversite" v-model="selectUniversite" track_by="id" :multiple="false" label="db_adi" placeholder="Kurum Seçiniz"  ></multiselect>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="endDate">Durum</label>
                    <multiselect  @input="dataGet" :options="dataDurums" v-model="selectDurum" track_by="id" :multiple="false" label="db_adi" placeholder="Kurum Seçiniz"  ></multiselect>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="endDate">Bayi</label>
                    <multiselect  @input="dataGet" :options="dataBayis" v-model="selectBayi" track_by="id" :multiple="false" label="db_sirket_unvani" placeholder="Bayi Seçiniz"  ></multiselect>
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
                                                            Bitiş Tarihi
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            Adı Soyadı
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            Program
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
                                                            Toplam Ücret
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
                                                            Açıklama
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            Belge Görüntüle
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list">
                                                    <tr
                                                        v-for="data in datas.data"
                                                    >
                                                       
                                                        <td>

                                                            <a :href="'/admin/katilimci/view/'+data.id"  data-toggle="tooltip" data-placement="top" class="btn btn-tooltip" title="Düzenle" data-container="body" data-animation="true">
                                                                <img width="30" height="30" src="https://img.icons8.com/external-tanah-basah-glyph-tanah-basah/48/external-edit-social-media-ui-tanah-basah-glyph-tanah-basah.png" alt="external-edit-social-media-ui-tanah-basah-glyph-tanah-basah"/>
                                                            </a>
                                                            {{ data.id }}
                                                        </td>
                                                        <td>
                                                            {{
                                                                data.created_at | dateConverter
                                                            }}
                                                        </td>
                                                        <td>
                                                            {{ 
                                                                data.db_bitis_tarihi  | dateConverterSaatsiz
                                                            }}
                                                        </td>
                                                        <td>
                                                            {{ data.db_adi }}
                                                            {{ data.db_soyadi }}<br>
                                                            <img width="18" height="18" src="https://img.icons8.com/sf-regular-filled/48/briefcase.png" alt="briefcase"/> {{ data.firma?data.firma.db_sirket_unvani:"Yönetici" }}
                                                        </td>
                                                        <td>
                                                            {{ data.db_program_adi }}<br>
                                                            <span  v-if="data.db_varyant" v-for="durum in data.db_varyant?JSON.parse(data.db_varyant):''" ><img width="18" height="18" src="https://img.icons8.com/glyph-neue/64/plus-2-math.png" alt="check-mark-emoji"/>  {{ durum.db_adi }}<br></span>

                                                        </td>
                                                        <td>
                                                            {{ data.db_universite!="{}"?JSON.parse(data.db_universite).db_adi:"" }}
                                                        </td>
                                                        <td>
                                                            {{ data.db_genel_toplam }} ₺
                                                        </td>
                                                        <td>
                                                            <!--<span class="badge badge-warning" v-if="data.firma_durum=='onay_bekliyor'">Onay Bekliyor</span>-->
                                                            {{/* data.firma_durum */}}
                                                            <span  v-if="data.db_katilimci_durum" v-for="durum in data.db_katilimci_durum?JSON.parse(data.db_katilimci_durum):''" ><img width="18" height="18" src="https://img.icons8.com/emoji/48/check-mark-emoji.png" alt="check-mark-emoji"/> {{ durum.db_adi }}<br></span>

                                                        </td>
                                                        <td >
                                                            <a data-toggle="modal" @click="modalGoster(data.db_bayi_not)" v-if="data.db_bayi_not?data.db_bayi_not.length>50?data.db_bayi_not.substr(0,50):'':'' " style="cursor: pointer;" data-target="#aciklamaModal">
                                                                {{ data.db_bayi_not?data.db_bayi_not.length>50?data.db_bayi_not.substr(0,50)+".... (+devamını oku)":data.db_bayi_not:"" }}
                                                            </a>
                                                            <span v-else> {{ data.db_bayi_not }}</span>
                                                            
                                                        </td>

                                                        <td>
                                                            <a :href="img.path" target="_blank" v-if="data.db_katilimci_dosya" v-for="img in data.db_katilimci_dosya?JSON.parse(data.db_katilimci_dosya):''" ><img src="https://img.icons8.com/matisse/100/pdf.png" style="width: 50px;height: 50px;margin:5px;padding:1px;"></a>
                                                            <a :href="img.path" target="_blank" v-if="data.db_katilimci_dosya2" v-for="img in data.db_katilimci_dosya2?JSON.parse(data.db_katilimci_dosya2):''" ><img src="https://img.icons8.com/matisse/100/pdf.png" style="width: 50px;height: 50px;margin:5px;padding:1px;"></a>
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
            json_fields: {
                "Kayıt Tarihi": "created_at",
                "Bitiş Tarihi": "db_bitis_tarihi",
                "Adı":"db_adi",
                "Soyadı":"db_soyadi",
                "Program":"db_program_adi",
                "Kurum": {
                    field: "db_universite",
                    callback: (value) => {
                    return value!="{}"?JSON.parse(value).db_adi:"" ;
                    },
                },
                "Toplam Ücret":"db_genel_toplam",
                "Durum": "dbKatBaslik",
                "Açıklama":"db_bayi_not",
            },
            baslangicTarihi:null,
            bitisTarihi:null,
            rezervasyonBaglantisi: false,
            hizmetler: {},
            visible: false,
            updateVisible: false,
            formData: {},
            baglanti_adi: "",
            baglanti_update_adi: "",
            query: "",
            dataUniversite:[],
            dataEgitims:[],
            dataVaryants:[],
            selectEgitim:"",
            selectBayi:"",
            selectVaryant:"",
            selectUniversite:"",
            selectDurum:"",
            selectKategori:"",
            modalData: {
                butonBaslik: "", // butonBaslik'u burada tanımlayın
            },
            dataKategori:[],
            
            dataDurums:[
                {id:1,db_adi:"Onay bekliyor"},
                {id:2,db_adi:"Onaylandı"},
                {id:3,db_adi:"Üniversiteye onaya gönderildi"},
                {id:4,db_adi:"E-Devlete işlendi"},
                {id:5,db_adi:"Kargolandı"},
                {id:6,db_adi:"Süresinde tamamlamadı"},
                {id:7,db_adi:"İptal edildi"},
                {id:8,db_adi:"İade edildi"},
                {id:9,db_adi:"Kaydı silindi"},
                {id:10,db_adi:"Eğitim/program değiştirildi"},
                {id:11,db_adi:"Sertifika kargolandı"},
                {id:12,db_adi:"Yabancı dil sertifika kargolandı"},
                {id:13,db_adi:"Transkript kargolandı"},
                {id:14,db_adi:"Sertifika yurt dışına kargolandı"},
                {id:15,db_adi:"Transkript yurt dışına kargolandı"},
                {id:16,db_adi:"Dijital yabancı dil sertifika oluşturuldu"},
                {id:17,db_adi:"Dijital transkript oluşturuldu"},
                {id:18,db_adi:"Uluslararası onaylı sertifika oluşturuldu"},
                {id:19,db_adi:"1 ay ek erişim tanımlandı"},
                {id:20,db_adi:"3 ay ek erişim tanımlandı"},
                {id:21,db_adi:"6 ay ek erişim tanımlandı"},
                {id:22,db_adi:"12 ay ek erişim tanımlandı"}
            ],
            dataBayis:[],
            datas: [],
            aciklamaModal:""
        };
    },
    props: { pageTitle: String, pageUrl: String },
    mounted() {
        this.dataGet();
        this.dataEgitimGet();
        this.dataVaryantGet();
        this.dataGetUniversite();
    },
    methods: {
        dataGet(page = 1) {
            axios
                .post(this.pageUrl + "/get?page=" + page,{queryData:this.query,baslangicTarihi:this.baslangicTarihi,bitisTarihi:this.bitisTarihi,selectEgitim:this.selectEgitim?.id,selectUniversite:this.selectUniversite?.id,selectVaryant:this.selectVaryant?.id,selectDurum:this.selectDurum?.id,selectBayi:this.selectBayi?.id})
                .then((response) => {
                    response.data.data.data.map((element) => {
                        let dbKatDur=[];
                        let dbKatBaslik="";
                        dbKatDur=element.db_katilimci_durum!="[]"?JSON.parse(element.db_katilimci_durum):"";
                        dbKatDur.forEach(el=>{
                            if(dbKatBaslik==""){
                                dbKatBaslik = el.db_adi
                            }else{
                                dbKatBaslik = el.db_adi+","+dbKatBaslik
                            }
                        })
                        element.dbKatBaslik = dbKatBaslik
                    });
                    console.log(response.data.data)
                    this.datas = response.data.data;
                    this.dataBayis = response.data.bayis;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        dataEgitimGet(){
            axios
                .post("/admin/katilimci/getEgitim")
                .then((response) => {
                    console.log(response.data);
                    this.dataEgitims = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });

        },
        dataVaryantGet(){
            axios
                .post("/admin/katilimci/getVaryant")
                .then((response) => {
                    console.log(response.data);
                    this.dataVaryants = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });

        },
        dataGetUniversite(){

            axios
                .post("/admin/katilimci/getUniversite")
                .then((response) => {
                    console.log(response.data);
                    this.dataUniversite = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    
        modalGoster(data){
            this.aciklamaModal = data
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
