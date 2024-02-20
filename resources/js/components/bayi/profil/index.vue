<template>
    <div>
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">Profil Bilgileri</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <table>
                            <tr>
                                <td>Email Adresi</td>
                                <td>: {{userData.email}}</td>
                            </tr>
                            <tr>
                                <td v-if="data.sirket_kurumsal_sahis == 'kurumsal'">Yetkili Ad Soyad</td>
                                <td v-else>Ad Soyad</td>
                                <td>: {{userData.name}} {{userData.surname}}</td>
                            </tr>
                            <tr>
                                <td>Doğum Tarihi</td>
                                <td>: {{data.db_dogum_tarihi | dateConverterSaatsiz}} </td>
                            </tr>
                            <tr>
                                <td>Uyruğu</td>
                                
                                <td>: 
                                    <span v-if="data.db_yetkili_uyrugu=='tc'"> {{"T.C. Vatandaşıyım"}} </span>
                                    <span v-else> {{"T.C. Vatandaşı Değilim"}} </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span v-if="data.db_yetkili_uyrugu=='tc'">T.C. Kimlik Numarası  </span>
                                    <span v-else>Pasaport ya da Kimlik No </span>
                                </td>
                                <td>: {{data.db_tc_pasaport}} </td>
                            </tr>
                            <tr>
                                <td>Cep Telefon Numarası</td>
                                <td>: {{data.db_cep_no}} </td>
                            </tr>
                            <tr>
                                <td>Şirket Türü</td>
                                <td>:
                                    <span v-if="data.db_sirket_turu=='sahis'"> {{"Şahıs Şirketi"}} </span>
                                    <span v-if="data.db_sirket_turu=='limited'"> {{"Limited Şirketi"}} </span>
                                    <span v-if="data.db_sirket_turu=='anonim'"> {{"Anonim Şirketi"}} </span>
                                    <span v-if="data.db_sirket_turu=='sivil-toplum-kurulusu'"> {{"Sivil Toplum Kuruluşu"}} </span>
                                    <span v-if="data.db_sirket_turu=='kurum'"> {{"Kamu Kurumu / Üniversite"}} </span>
                                    <span v-if="data.db_sirket_turu=='yurt-disi-sirketi'"> {{"Yurt Dışı Şirketi"}} </span>
                                    <span v-if="data.db_sirket_turu=='diger'"> {{"Diğer"}} </span>
                                </td>
                            </tr>
                            <tr v-if="data.sirket_kurumsal_sahis == 'kurumsal'">
                                <td>Şirket Ünvanı</td>
                                <td>: {{data.firma_adi}} </td>
                            </tr>
                            <tr v-if="data.sirket_kurumsal_sahis == 'kurumsal'">
                                <td>Şirket Vergi Numarası</td>
                                <td>: {{data.db_sirket_vergi_no}} </td>
                            </tr>
                            <tr v-if="data.sirket_kurumsal_sahis == 'kurumsal'">
                                <td>Şirket Vergi Dairesi</td>
                                <td>: {{data.db_sirket_dairesi}} </td>
                            </tr>
                            <tr>
                                <td>Ülke</td>
                                <td>: {{data.db_ulke_obj?.baslik}} </td>
                            </tr>
                            <tr>
                                <td>Şehir</td>
                                <td>: {{data.db_sehir_obj?.baslik}} </td>
                            </tr>
                            <tr>
                                <td>İlçe</td>
                                <td>: {{data.db_ilce_obj?.baslik}} </td>
                            </tr>
                            <tr v-if="data.sirket_kurumsal_sahis == 'kurumsal'">
                                <td>Şirket Adresi</td>
                                <td>: {{data.db_sirket_adresi}} </td>
                            </tr>
                            <tr>
                                <td v-if="data.sirket_kurumsal_sahis == 'kurumsal'">Şirket Web Sitesi</td>
                                <td v-else>Web Sitesi</td>
                                <td>: {{data.db_sirket_web_adresi}} </td>
                            </tr>
                            <tr>
                                <td v-if="data.sirket_kurumsal_sahis == 'kurumsal'">Şirket Sosyal Medya</td>
                                <td v-else>Sosyal Medya</td>
                                <td>: {{data.db_sosyal_medya_hesabi}} </td>
                            </tr>
                        </table>
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
            userData: {},
            data: {}
        };
    },
    props: { pageTitle: String, pageUrl: String },
    mounted() {
        this.dataGet();
    },
    methods: {
        dataGet() {
            axios
                .post(this.pageUrl + "/get")
                .then((response) => {
                    this.data = response.data.data;
                    this.data.db_ulke_obj = JSON.parse(response.data.data.db_ulke_obj);
                    this.data.db_sehir_obj = JSON.parse(response.data.data.db_sehir_obj);
                    this.data.db_ilce_obj = JSON.parse(response.data.data.db_ilce_obj);
                    console.log(this.data)
                    this.userData = response.data.user;
                    console.log(this.datas)
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
