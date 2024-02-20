<template>
    <div>
        <div class="row">
            
            <div class="col-md-3">
                <button class="btn-success btn btn-block">Toplam Bayi Bakiyesi: {{ toplamBakiye }} ₺</button>
            </div>
            <div class="col-md-5"> 
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
            <div class="col-md-6">
                <div class="form-group">
                    <label for="startDate">Başvuru Durum</label>
                    <multiselect @input="dataGet" :options="dataDurums" v-model="durumSelect" track_by="id" :multiple="false" label="db_adi" placeholder="Başvuru Durumu Seçiniz"  ></multiselect>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="endDate">Bayi Tipi</label>
                    <multiselect  @input="dataGet"  :options="dataTips" track_by="id" v-model="tipSelect" track-by="id" :multiple="false" label="db_adi" placeholder="Bayi Tipi Seçiniz"  ></multiselect>
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
                                                            Başvuru Tarihi
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            Bayi
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            Bakiye
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            E-posta
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            Şirket Ünvanı
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="sort"
                                                            data-sort="budget"
                                                        >
                                                            Tüzel-Statü
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
                                                            Belge Görüntüle
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

                                                            <a :href="'/admin/bayi/view/'+data.id"  data-toggle="tooltip" data-placement="top" class="btn btn-tooltip" title="Düzenle" data-container="body" data-animation="true">
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
                                                                data.firma_yetkili
                                                            }}
                                                        </td>
                                                        <td>
                                                            {{
                                                                data.bakiye
                                                            }} ₺
                                                        </td>
                                                        <td>
                                                            <span class="btn btn-success btn-block">
                                                                {{
                                                                    data.db_yetkili_email
                                                                }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="btn btn-secondary btn-block">
                                                            {{
                                                                data.db_sirket_unvani
                                                            }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="btn btn-primary btn-block">
                                                                {{
                                                                    data.db_sirket_turu=="sahis"?"Şahıs Şirketi":""
                                                                }}
                                                                {{
                                                                    data.db_sirket_turu=="limited"?"Limited Şirketi":""
                                                                }}
                                                                {{
                                                                    data.db_sirket_turu=="anonim"?"Anonim Şirketi":""
                                                                }}
                                                                {{
                                                                    data.db_sirket_turu=="sivil-toplum-kurulusu"?"Sivil Toplum Kuruluşu":""
                                                                }}
                                                                {{
                                                                    data.db_sirket_turu=="kurum"?"Kamu Kurumu / Üniversite":""
                                                                }}
                                                                {{
                                                                    data.db_sirket_turu=="yurt-disi-sirketi"?"Yurt Dışı Şirketi":""
                                                                }}
                                                                {{
                                                                    data.db_sirket_turu=="bireysel"?"Bireysel":""
                                                                }}
                                                                {{
                                                                    data.db_sirket_turu=="diger"?"Diğer":""
                                                                }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span v-if="data.firma_durum=='onay_bekliyor'" class="btn btn-dark btn-block">
                                                                {{
                                                                    data.firma_durum=="onay_bekliyor"?"Onay Bekliyor":"Onaylandı"
                                                                }}
                                                            </span>
                                                            <span v-if="data.firma_durum=='onaylandi'" class="btn btn-success btn-block">
                                                                {{
                                                                    data.firma_durum=="onaylandi"?"Onaylandı":""
                                                                }}
                                                            </span>
                                                            <span v-if="data.firma_durum=='onaylanmadi'" class="btn btn-warning btn-block">
                                                                {{
                                                                    data.firma_durum=="onaylanmadi"?"Onaylanmadı":""
                                                                }}
                                                            </span>

                                                            <span v-if="data.firma_durum=='iptal_edildi'" class="btn btn-danger btn-block">
                                                                {{
                                                                    data.firma_durum=="iptal_edildi"?"İptal Edildi":""
                                                                }}
                                                            </span>
                                                        </td>
                                                        <td style="height: 150px;">

                                                            <a :href="'/'+data.db_kimlik_on_yuzu" v-if="data.db_kimlik_on_yuzu" @mouseover="showText('Kimlik Ön Yüzü',data.id)" @mouseout="hideText" target="_blank">
                                                                <img width="50" height="50" src="https://img.icons8.com/ios/50/id-verified.png" alt="id-verified"/>
                                                            </a>

                                                            <a :href="'/'+data.db_ikametgah" v-if="data.db_ikametgah" @mouseover="showText('İkametgah',data.id)" @mouseout="hideText" target="_blank">
                                                                <img width="50" height="50" src="https://img.icons8.com/ios/50/home-page.png" alt="home-page"/>
                                                            </a>

                                                            <a :href="'/'+data.db_vergi_levhasi" v-if="data.db_vergi_levhasi"  @mouseover="showText('Vergi Levhası',data.id,data)" @mouseout="hideText" target="_blank" alt="Vergi Levhası">
                                                                <img width="50" height="50" src="https://img.icons8.com/ios/50/document--v1.png" alt="document--v1"/>
                                                            </a>
                                                            <div style="position: relative;" v-if="hoverId==data.id">
                                                                <span  style="position: absolute;" >{{ hoverText }}</span>
                                                            </div>
                                                            
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
                                                                        @click="
                                                                            dataOnayla(data,'onaylandi')
                                                                        "
                                                                        >Onayla
                                                                    </a>
                                                                    <a
                                                                        class="dropdown-item"
                                                                        href="#"
                                                                        @click="
                                                                            dataOnayla(data,'iptal_edildi')
                                                                        "
                                                                        >İptal Et
                                                                    </a>
                                                                    <a
                                                                        class="dropdown-item"
                                                                        href="#"
                                                                        @click="
                                                                            dataOnayla(data,'onaylanmadi')
                                                                        "
                                                                        >Onaylanmadı
                                                                    </a>
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


let date = new Date();
let today = date.getFullYear() + '' + date.getMonth() + '' + date.getDate();

export default {
    data() {
        return {
            json_fields: {
                "Id":"id",
                "Başvuru Tarihi":"created_at",
                "Bayi":"firma_yetkili",
                "Bakiye":"bakiye",
                "E-posta":"db_yetkili_email",
                "Şirket Ünvanı":"db_sirket_unvani",                                               
                "Tüzel Statü": {                   
                    field: "db_sirket_turu",
                    callback: (value) => {
                        return value=="sahis"?"Şahıs Şirketi"
                        :value=="limited"?"Limited Şirketi"
                        :value=="anonim"?"Anonim Şirketi"
                        :value=="sivil-toplum-kurulusu"?"Sivil Toplum Kuruluşu"
                        :value=="kurum"?"Kamu Kurumu / Üniversite"
                        :value=="yurt-disi-sirketi"?"Yurt Dışı Şirketi"
                        :value=="bireysel"?"Bireysel"
                        :value=="diger"?"Diğer"
                        :"";
                    },
                },                                               
                "Durum": {                   
                    field: "firma_durum",
                    callback: (value) => {
                        return value=="onay_bekliyor"?"Onay Bekliyor"
                        :value=="onaylandi"?"Onaylandı"
                        :value=="onaylanmadi"?"Onaylanmadı"
                        :value=="iptal_edildi"?"İptal Edildi"
                        :"";
                    },
                },  
            },
            baslangicTarihi:null,
            bitisTarihi:null,
            hoverText: "",
            hoverId: "",
            toplamBakiye:0,
            today: today,
            rezervasyonBaglantisi: false,
            hizmetler: {},
            visible: false,
            updateVisible: false,
            formData: {},
            baglanti_adi: "",
            baglanti_update_adi: "",
            query: "",
            durumSelect:"",
            tipSelect:"",
            dataDurums:[{"db_adi":"Onay Bekliyor",db_code:"onay_bekliyor"},{db_adi:"Onaylandı",db_code:"onaylandi"},{db_adi:"İptal Edildi",db_code:"iptal_edildi"},{db_adi:"Onaylanmadı",db_code:"onaylanmadi"}],
            dataTips:[{id:"1","db_adi":"Bireysel",db_code:"bireysel"},{id:2,db_adi:"Kurumsal",db_code:"kurumsal"}],
            modalData: {
                butonBaslik: "", // butonBaslik'u burada tanımlayın
            },
            datas: [],
            jsonFields: {
                'id': 'id'
            },
        };
    },
    props: { pageTitle: String, pageUrl: String },
    mounted() {
        this.dataGet();
    },
    methods: {
        dataGet(page = 1) {
            axios
                .post(this.pageUrl + "/get?page=" + page,{queryData:this.query,baslangicTarihi:this.baslangicTarihi,bitisTarihi:this.bitisTarihi,durumSelect:this.durumSelect?.db_code,tipSelect:this.tipSelect?.db_code})
                .then((response) => {
                    console.log(response.data);
                    this.datas = response.data.data;
                    this.toplamBakiye = response.data.toplam_bakiye;
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
        dataOnayla(data,durum){
            data.onayDurum=durum
            axios
                .post(this.pageUrl + "/islemYap",{ data:data})
                .then((response) => {
                    //this.$toasted.success(response.data.message)
                    this.dataGet();
                })
                .catch((error) => {
                    console.log(error);
                });
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

        showText(message,id,data) {
            this.hoverText=message
            this.hoverId=id
        },
        hideText() {
            this.hoverText=""
            this.hoverId=""
        },
    },
};
</script>
