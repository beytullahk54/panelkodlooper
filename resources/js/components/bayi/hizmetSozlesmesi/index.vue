<template>
    <div>
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
                                <div class="card-body ">
                                    <div v-html="datas.db_value"/>
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
                .post(this.pageUrl + "/get")
                .then((response) => {
                    this.datas = response.data;
                    console.log(this.datas)
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
