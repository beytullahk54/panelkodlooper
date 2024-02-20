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
                        <div class="col-4">
                            <a href="/bayi/destek" class="m-3 btn btn-primary btn-block" style="display: block;">Yeni Talep / Tüm Talepler</a>
                            <a  href="javascript:void(0)" class="m-3 btn btn-danger btn-block" @click="onayla(datas)" style="display: block;">Sorunum Çözüldü</a>
                        </div>   
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body px-4 pt-5">
                                    <div>
                                        Konu: {{datas.db_destek_konu}}
                                    </div>
                                    <div>
                                        Açıklama: {{datas.db_destek_aciklama}}
                                    </div><br>

                                    <template v-if="datas.db_gorsel">
                                        <div>
                                            Dosyalar<br>
                                            <a :href="gorsel.path" target="_blank" v-for="gorsel in JSON.parse(datas.db_gorsel)"><img width="50" height="50" src="https://img.icons8.com/ios/50/document--v1.png" alt="document--v1"/></a>
                                        </div><br>
                                    </template><br>
                                    <div class="card m-2" v-for="mesaj in datasMesajlar">
                                        <div class="card-body">
                                            <span v-if="mesaj.db_destek_gonderen_tipi=='yonetici'">Yönetici</span>
                                            <span v-if="mesaj.db_destek_gonderen_tipi=='kullanici'">Siz</span>
                                            
                                            :  {{ mesaj.db_destek_mesaj }}
                                            <span  v-if="mesaj.db_destek_dosya!='[]'">
                                                Dosya: <a :href="gorsel.path" target="_blank" v-for="gorsel in mesaj.db_destek_dosya"><img width="36" height="36" src="https://img.icons8.com/ios/50/document--v1.png" alt="document--v1"/></a><br>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card m-2">
                                        <div class="card-body ">
                                                <textarea v-model="mesaj" id="" class="form-control" rows="10"></textarea><br>
                                                
                                                
                                                <div class="form-group">
                                                    <label for="exampleInputPassword">Destek Talep Görselleri</label>
                                                    <vue-upload-multiple-image
                                                        accept="file"
                                                        @upload-success="uploadImageSuccess"
                                                        @before-remove="beforeRemove"
                                                        @edit-image="editImage"
                                                        :data-images="image"
                                                        :multiple="true"
                                                        dragText="Dosya Sürükleyiniz"
                                                        browseText="Dosya Seçiniz"
                                                        primaryText="Yüklendi"
                                                    ></vue-upload-multiple-image>
                                                </div>
                                                <button @click="mesajGonder()" class="btn btn-primary btn-block">GÖNDER</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import VueUploadMultipleImage from 'vue-upload-multiple-image'
export default {

    components: {
        VueUploadMultipleImage,
    },
    data() {
        return {
            rezervasyonBaglantisi: false,
            hizmetler: {},
            image:[],
            visible: false,
            destekGorsel:[],
            updateVisible: false,
            formData: {},
            baglanti_adi: "",
            baglanti_update_adi: "",
            mesaj:"",
            query: "",
            datas: [],
            datasMesajlar: [],
        };
    },
    props: { pageTitle: String, pageUrl: String,detayId: String },
    mounted() {
        this.dataGet();
    },
    methods: {
        dataGet() {
            axios
                .post("/bayi/"+this.pageUrl + "/getDetayBayi",{id:this.detayId})
                .then((response) => {
                    this.datas = response.data.data;
                    this.datasMesajlar= response.data.data_mesajlar
                    this.datasMesajlar.map(data=>{
                        if(data.db_destek_dosya != "[]")
                        {
                            data.db_destek_dosya = JSON.parse(data.db_destek_dosya)
                        }
                    })
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        mesajGonder() {
            var mesajData = {};
            mesajData.id    = this.detayId;
            mesajData.mesaj = this.mesaj
            mesajData.db_destek_dosya = JSON.stringify(this.destekGorsel)
            axios
                .post("/bayi/"+this.pageUrl + "/storeDetayBayi",mesajData)
                .then((response) => {
                    this.$toasted.success(response.data.message)
                    this.mesaj=""
                    this.dataGet();
                    window.location.href = "/bayi/destek";
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        uploadImageSuccess(formData, index, fileList) {
            console.log('data', formData, index, fileList)
            
            let axiosUrl="";
            axiosUrl = "/gorselUpload/destekMesajGorsel"
            
            axios
                .post(axiosUrl, formData,
                { headers: {
                    "Content-Type": "multipart/form-data"
                }})
                .then((response) => {
                    this.destekGorsel.push({"path": "/"+response.data.url});
                    this.$toasted.success(response.data.message)
                    //this.dataGet();
                })
                .catch((error) => {
                    console.log(error);
                });
            // Upload image api
            // axios.post('http://your-url-upload', formData).then(response => {
            //   console.log(response)
            // })
        },
        beforeRemove (index, done, fileList) {
            console.log('index', index, fileList)
            var r = confirm("remove image")
            if (r == true) {
                done()
            } else {
            }
        },
        editImage (formData, index, fileList) {
            console.log('edit data', formData, index, fileList)
        },
        onayla(){

            axios
                .post("/bayi/"+this.pageUrl + "/onaylaDetayBayi",{id:this.detayId})
                .then((response) => {
                    this.$toasted.success(response.data.message)
                    this.mesaj=""
                    this.dataGet();
                    window.location.href = "/bayi/destek";
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    },
};
</script>
