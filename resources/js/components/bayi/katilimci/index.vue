<template>
    <div>
        <!-- Modal -->
        <div class="modal fade" id="detayModal" tabindex="-1" role="dialog" aria-labelledby="aciklamaModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="aciklamaModalLabel">Açıklama</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <b>BİLGİLER</b><br><br>
                        <b>Katılımcı Adı:</b> {{ detayModalData.db_adi }} <br>
                        <b>Katılımcı Soyadı:</b> {{ detayModalData.db_soyadi }} <br>
                        <b>Katılımcı Doğum Tarihi:</b> {{ detayModalData.db_dogum_tarihi }} <br>
                        <b>Katılımcı Uyruğu:</b> {{ detayModalData.db_uyruk=="tc_vatandasi"?"Türkiye Cumhuriyeti Vatandaşı":"Yabancı" }} <br>
                        <b>Katılımcı Cep No:</b> {{ detayModalData.db_cep_no }} <br>
                        <b>Katılımcı Email:</b> {{ detayModalData.db_email }} <br>
                        <b>Ülke:</b> {{ detayModalData.db_ulke_obj?JSON.parse(detayModalData.db_ulke_obj).baslik:"" }} <br>
                        <b>Şehir:</b> {{ detayModalData.db_sehir_obj?JSON.parse(detayModalData.db_sehir_obj).baslik:"" }} <br>
                        <b>İlçe:</b>  {{ detayModalData.db_ilce_obj?JSON.parse(detayModalData.db_ilce_obj).baslik:"" }} <br>
                        <b>Adres:</b> {{ detayModalData.db_adres }} <br>
                        <b>Sipariş Notu:</b>  {{ detayModalData.db_siparis_not }} <br><br>
                        <b>Eğitim Bilgileri:</b><br>  {{ detayModalData.db_program_adi }} <br><br>
                        <b v-if="detayModalData.db_varyant != 'null'">Ek Hizmetler:</b><br>  
                        <span v-for="varyant in detayModalData.db_varyant?JSON.parse(detayModalData.db_varyant):''" v-if="detayModalData.db_varyant">{{ varyant.db_adi }}<br></span><br>
                        <b v-if="detayModalData.db_katilimci_durum != 'null'">Durum:</b><br>  
                        <span  v-if="detayModalData.db_katilimci_durum" v-for="durum in detayModalData.db_katilimci_durum?JSON.parse(detayModalData.db_katilimci_durum):''" ><img width="18" height="18" src="https://img.icons8.com/emoji/48/check-mark-emoji.png" alt="check-mark-emoji"/> {{ durum.db_adi }}<br></span><br>
                        <b v-if="detayModalData.db_bayi_not">Yönetici Notu:<br></b>
                        <span  v-if="detayModalData.db_bayi_not">{{ detayModalData.db_bayi_not }}<br><br></span>
                        <b v-if="detayModalData.db_katilimci_dosya != '[]' || detayModalData.db_katilimci_dosya2  != '[]'">Belgeler:</b><br>
                        <a :href="img.path" target="_blank" v-if="detayModalData.db_katilimci_dosya" v-for="img in detayModalData.db_katilimci_dosya?JSON.parse(detayModalData.db_katilimci_dosya):''" ><img src="https://img.icons8.com/matisse/100/pdf.png" style="width: 50px;height: 50px;margin:5px;padding:1px;"></a>
                        <a :href="img.path" target="_blank" v-if="detayModalData.db_katilimci_dosya2" v-for="img in detayModalData.db_katilimci_dosya2?JSON.parse(detayModalData.db_katilimci_dosya2):''" ><img src="https://img.icons8.com/matisse/100/pdf.png" style="width: 50px;height: 50px;margin:5px;padding:1px;"></a>
                    </div>
                </div>
            </div>
        </div>
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
        <katilimci-bayi-modal
            @kaydet="dataStore"
            :data="formData"
            :dataEgitims="dataEgitims"
            :dataVaryants="dataVaryants"
            :modal="modalData"
        ></katilimci-bayi-modal>
        <div class="row">
            <div class="col-lg-5 col-md-12 p-2">
                <a
                    :href="'/bayi/katilimci/yeni'"
                    class="btn btn-primary"
                >
                    Yeni Katılımcı Ekle
                </a>
                <span class="btn btn-success m-1">BAKİYENİZ: {{ firma.bakiye }} ₺</span>
            </div>
            <div class="col-lg-2 "></div>
            <div class="col-lg-5 col-md-12 p-2">
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
            <div class="col-md-4">
                <div class="form-group">
                    <label for="startDate">Başlangıç Tarihi:</label>
                    <input
                        type="date"
                        v-model="baslangicTarihi"
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
                        v-model="bitisTarihi"
                        class="form-control"
                        id="endDate"
                        name="endDate"
                    />
                </div>
            </div>

            <div class="col-md-4">
                <button
                    type="button"
                    class="btn btn-primary btn-block"
                    @click="dataGet"
                >
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
                                                            Kart
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
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list">
                                                    <tr
                                                        v-for="data in datas.data"
                                                    >
                                                        <td>
                                                           <a  data-target="#detayModal" data-toggle="modal"  @click="detayGoster(data)"  data-placement="top" class="btn btn-tooltip"> 
                                                                <img width="45" height="45"  src="https://img.icons8.com/ios-filled/50/identification-documents.png" alt="identification-documents"/>
                                                           </a>
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
                                                            {{ data.db_bitis_tarihi  | dateConverterSaatsiz}}
                                                        </td>
                                                        <td>
                                                            {{ data.db_adi }}
                                                            {{ data.db_soyadi }}
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
                                                            <a @click="modalGoster(data.db_bayi_not)" v-if="data.db_bayi_not?data.db_bayi_not.length>50?data.db_bayi_not.substr(0,50):'':'' " style="cursor: pointer;" data-target="#aciklamaModal" data-toggle="modal" >
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
            baslangicTarihi:null,
            bitisTarihi:null,
            rezervasyonBaglantisi: false,
            hizmetler: {},
            visible: false,
            updateVisible: false,
            formData: {},
            firma:{},
            baglanti_adi: "",
            baglanti_update_adi: "",
            query: "",
            modalData: {
                butonBaslik: "", // butonBaslik'u burada tanımlayın
            },
            datas: [],
            dataEgitims: [],
            dataVaryants: [],
            aciklamaModal:"",
            detayModalData:{}
        };
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
                    this.datas = response.data.data;
                    this.firma = response.data.firma
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        dataEgitimGet(){
            axios
                .post(this.pageUrl + "/getEgitim")
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
                .post(this.pageUrl + "/getVaryant")
                .then((response) => {
                    console.log(response.data);
                    this.dataVaryants = response.data.data;
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
        modalGoster(data){
            this.aciklamaModal = data
        },
        detayGoster(data){
            this.detayModalData = data
        },
        dataCreate() {
            this.formData = {
                db_adi:"beytullah",
                db_soyadi:"kahraman",
                db_dogum_tarihi:"1995-12-10",
                db_tc_pasaport:"10148444512",
                db_cep_no:"5332400257",
                db_email:"info@kodlooper.com",
                db_uyruk:"tc_vatandasi",
                db_siparis_not:"aaa",
                db_adres:"Vatan Mah. 4235 Sok. A blok daire 2 Yazlık Serdivan Sakarya",
                sertifikas:[]
            };
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
            console.log(data.data)
            data.data.db_ulke=data.data.db_ulke.id
            data.data.db_sehir=data.data.db_sehir.id
            data.data.db_ilce=data.data.db_ilce.id
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
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
