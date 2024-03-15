<template>
    <div>
        <div>
            ADMİN
        </div>
        
    </div>
</template>

<script>

export default {
    data() {
        return {
            firma:[],
            onay_bekleyen_katilim:0,
            onaylanan_katilimci:0,
            toplam_katilimci:0,
            onay_bekleyen_bayiler:0,
            onaylanan_bayiler:0,
            toplam_bayiler:0,
            aktif_universite:0,
            aktif_egitim:0,
            toplam_egitim:0,
            aktif_destek_talepleri:0,
            tamamlanan_destek_talepleri:0,
            toplam_destek_talepleri:0,
            tbl_bakiye_odeme_onay_bekliyor:0,
            tbl_bakiye_mevcut:0,
            tbl_bugun_yuklenen_bakiye_ciro_toplam:0,
            tbl_buhafta_yuklenen_bakiye_ciro_toplam:0,
            tbl_buay_yuklenen_bakiye_ciro_toplam:0
        };
    },
    props: { pageTitle: String, pageUrl: String },
    mounted() {
        this.dataGet()
    },
    methods: {
       
        dataGet() {
            axios
                .post(this.pageUrl + "/get")
                .then((response) => {
                    this.firma = response.data.firma;
                    this.onay_bekleyen_katilim = response.data.onay_bekleyen_katilim;
                    this.onaylanan_katilimci = response.data.onaylanan_katilimci;
                    this.toplam_katilimci = response.data.toplam_katilimci;
                    this.onay_bekleyen_bayiler = response.data.onay_bekleyen_bayiler;
                    this.onaylanan_bayiler = response.data.onaylanan_bayiler;
                    this.toplam_bayiler = response.data.toplam_bayiler;
                    this.aktif_universite = response.data.aktif_universite;
                    this.aktif_egitim = response.data.aktif_egitim;
                    this.toplam_egitim = response.data.toplam_egitim;
                    this.aktif_destek_talepleri = response.data.aktif_destek_talepleri;
                    this.tamamlanan_destek_talepleri = response.data.tamamlanan_destek_talepleri;
                    this.toplam_destek_talepleri = response.data.toplam_destek_talepleri;
                    this.tbl_bakiye_odeme_onay_bekliyor=response.data.tbl_bakiye_odeme_onay_bekliyor;
                    this.tbl_bakiye_mevcut=response.data.tbl_bakiye_mevcut;
                    this.tbl_bakiye_ciro=response.data.tbl_bakiye_ciro;
                    this.tbl_bugun_yuklenen_bakiye_ciro_toplam=response.data.tbl_bugun_yuklenen_bakiye_ciro_toplam;
                    this.tbl_buhafta_yuklenen_bakiye_ciro_toplam=response.data.tbl_buhafta_yuklenen_bakiye_ciro_toplam;
                    this.tbl_buay_yuklenen_bakiye_ciro_toplam=response.data.tbl_buay_yuklenen_bakiye_ciro_toplam;
                    
                    
                    
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
