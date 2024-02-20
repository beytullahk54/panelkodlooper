<template>
    <div>
        <div>
            ADMİN
        </div>

        <div class="row p-3 ">

            <div class="col-md-4 align-self-center">              
                <div class="card card-stats mb-4 mb-xl-0"  style="background: #2BCE89;">
                
                    <div class="card-body">
                        <a href="/admin/bakiye-hareketleri">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 text-white"> Onay Bekleyen BAKİYE</h5>
                                    <span class="h2 font-weight-bold mb-0 text-white">{{ tbl_bakiye_odeme_onay_bekliyor }} ₺</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape  text-white rounded-circle shadow">
                                        <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/exchange-lira.png" alt="exchange-lira"/>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 align-self-center">              
                <div class="card card-stats mb-4 mb-xl-0"  style="background: #2BCE89;">
                
                    <div class="card-body">
                        <a href="/admin/bakiye-hareketleri">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 text-white"> MEVCUT BAKİYE</h5>
                                    <span class="h2 font-weight-bold mb-0 text-white">{{ tbl_bakiye_mevcut }} ₺</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape  text-white rounded-circle shadow">
                                        <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/exchange-lira.png" alt="exchange-lira"/>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 align-self-center">              
                <div class="card card-stats mb-4 mb-xl-0"  style="background: #2BCE89;">
                
                    <div class="card-body">
                        <a href="/admin/bakiye-hareketleri">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 text-white"> Toplam CİRO</h5>
                                    <span class="h2 font-weight-bold mb-0 text-white">{{ tbl_bakiye_ciro }}  ₺</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape  text-white rounded-circle shadow">
                                        <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/exchange-lira.png" alt="exchange-lira"/>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row p-3 ">

            <div class="col-md-4 align-self-center">              
                <div class="card card-stats mb-4 mb-xl-0"  style="background: #2BCE89;">
                
                    <div class="card-body">
                        <a href="/admin/bakiye-hareketleri">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 text-white"> BUGÜN YÜKLENEN BAKİYE</h5>
                                    <span class="h2 font-weight-bold mb-0 text-white">{{ tbl_bugun_yuklenen_bakiye_ciro_toplam }} ₺</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape  text-white rounded-circle shadow">
                                        <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/exchange-lira.png" alt="exchange-lira"/>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 align-self-center">              
                <div class="card card-stats mb-4 mb-xl-0"  style="background: #2BCE89;">
                
                    <div class="card-body">
                        <a href="/admin/bakiye-hareketleri">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 text-white"> BU HAFTA YÜKLENEN BAKİYE</h5>
                                    <span class="h2 font-weight-bold mb-0 text-white">{{ tbl_buhafta_yuklenen_bakiye_ciro_toplam }} ₺</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape  text-white rounded-circle shadow">
                                        <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/exchange-lira.png" alt="exchange-lira"/>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 align-self-center">              
                <div class="card card-stats mb-4 mb-xl-0"  style="background: #2BCE89;">
                
                    <div class="card-body">
                        <a href="/admin/bakiye-hareketleri">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 text-white"> BU AY YÜKLENEN BAKİYE</h5>
                                    <span class="h2 font-weight-bold mb-0 text-white">{{ tbl_buay_yuklenen_bakiye_ciro_toplam }} ₺</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape  text-white rounded-circle shadow">
                                        <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/exchange-lira.png" alt="exchange-lira"/>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            
            
        </div>
        <div class="row p-3">
            <div class="col-xl-4 col-lg-6">
                
                <div class="card card-stats mb-4 mb-xl-0"  style="background: #8F2195;">
                
                    <div class="card-body">
                    <a href="/admin/katilimci">
                        <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0 text-white">Onay Bekleyen Katılımcılar</h5>
                            <span class="h2 font-weight-bold mb-0 text-white">{{onay_bekleyen_katilim}}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape text-white rounded-circle shadow">
                            <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/conference-call.png" alt="conference-call"/>
                            </div>
                        </div>
                        </div>
                    </a>
                </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0"  style="background: #8F2195;">
                <a href="/admin/katilimci">
                    <div class="card-body">
                    <div class="row">
                        <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0 text-white"  >Onaylanan Katılımcılar</h5>
                        <span class="h2 font-weight-bold mb-0 text-white">{{onaylanan_katilimci}}</span>
                        </div>
                        <div class="col-auto">
                        <div class="icon icon-shape  text-white rounded-circle shadow">
                            
                        <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/conference-call.png" alt="conference-call"/>
                        </div>
                        </div>
                    </div>
                    </div>
                </a>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0"  style="background: #8F2195;">
                <a href="/admin/katilimci">
                    <div class="card-body">
                    <div class="row">
                        <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0 text-white" >Toplam Katılımcılar</h5>
                        <span class="h2 font-weight-bold mb-0 text-white">{{toplam_katilimci}}</span>
                        </div>
                        <div class="col-auto">
                        <div class="icon icon-shape text-white rounded-circle shadow">
                            
                        <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/conference-call.png" alt="conference-call"/>
                        </div>
                        </div>
                    </div>
                    </div>
                </a>
                </div>
            </div>
        </div>
        <div class="row p-3">
            <div class="col-xl-4 col-lg-6">
                
                <div class="card card-stats mb-4 mb-xl-0"  style="background: #dd2be6;">
                
                    <div class="card-body">
                    <a href="/admin/bayi">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 text-white">Onay Bekleyen BAYİLER</h5>
                                <span class="h2 font-weight-bold mb-0 text-white">{{onay_bekleyen_bayiler}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape text-white rounded-circle shadow">
                                <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/conference-call.png" alt="conference-call"/>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0"  style="background: #dd2be6;">
                <a href="/admin/bayi">
                    <div class="card-body">
                    <div class="row">
                        <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0 text-white"  >Onaylanan BAYİLER</h5>
                        <span class="h2 font-weight-bold mb-0 text-white">{{onaylanan_bayiler}}</span>
                        </div>
                        <div class="col-auto">
                        <div class="icon icon-shape  text-white rounded-circle shadow">
                            
                        <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/conference-call.png" alt="conference-call"/>
                        </div>
                        </div>
                    </div>
                    </div>
                </a>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0"  style="background: #dd2be6;">
                <a href="/admin/bayi">
                    <div class="card-body">
                    <div class="row">
                        <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0 text-white" >Toplam BAYİLER</h5>
                        <span class="h2 font-weight-bold mb-0 text-white">{{toplam_bayiler}}</span>
                        </div>
                        <div class="col-auto">
                        <div class="icon icon-shape text-white rounded-circle shadow">
                            
                        <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/conference-call.png" alt="conference-call"/>
                        </div>
                        </div>
                    </div>
                    </div>
                </a>
                </div>
            </div>
        </div>
        <div class="row p-3">
            <div class="col-xl-4 col-lg-6">
                <a href="/admin/destek">
                <div class="card card-stats mb-4 mb-xl-0"  style="background:#0cbfd3;">
                    <div class="card-body">
                    <div class="row">
                        <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0 text-white">AKTİF Destek TALEPLERİ</h5>
                        <span class="h2 font-weight-bold mb-0 text-white">{{aktif_destek_talepleri}}</span>
                        </div>
                        <div class="col-auto">
                        <div class="icon icon-shape text-white rounded-circle shadow">
                            <img width="50" height="50" src="https://img.icons8.com/sf-black-filled/64/FFFFFF/chat.png" alt="chat"/>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-xl-4 col-lg-6">
                <a href="/admin/destek">
                <div class="card card-stats mb-4 mb-xl-0"  style="background:#0cbfd3;">
                    <div class="card-body">
                    <div class="row">
                        <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0 text-white"  >Tamamlanan Destek TALEPLERİ</h5>
                        <span class="h2 font-weight-bold mb-0 text-white">{{tamamlanan_destek_talepleri}}</span>
                        </div>
                        <div class="col-auto">
                        <div class="icon icon-shape text-white rounded-circle shadow">
                            
                        <img width="50" height="50" src="https://img.icons8.com/sf-black-filled/64/FFFFFF/chat.png" alt="chat"/>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-xl-4 col-lg-6">
                <a href="/admin/destek">
                <div class="card card-stats mb-4 mb-xl-0"  style="background:#0cbfd3;">
                    <div class="card-body">
                    <div class="row">
                        <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0 text-white" >Toplam Destek TALEPLERİ</h5>
                        <span class="h2 font-weight-bold mb-0 text-white">{{toplam_destek_talepleri}}</span>
                        </div>
                        <div class="col-auto">
                        <div class="icon icon-shape text-white rounded-circle shadow">
                            
                        <img width="50" height="50" src="https://img.icons8.com/sf-black-filled/64/FFFFFF/chat.png" alt="chat"/>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <div class="row p-3">
            <div class="col-xl-4 col-lg-6">
                <a href="/admin/egitim">
                    <div class="card card-stats mb-4 mb-xl-0"  style="background: #1D4793;">
                        <div class="card-body">
                            <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 text-white">Onay Bekleyen EĞİTİMLER</h5>
                                <span class="h2 font-weight-bold mb-0 text-white">{{onay_bekleyen_katilim}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape text-white rounded-circle shadow">
                                    
                                <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/graduation-cap.png" alt="graduation-cap"/>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 col-lg-6">
                <a href="/admin/egitim">
                    <div class="card card-stats mb-4 mb-xl-0"  style="background: #1D4793;">
                        <div class="card-body">
                            <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 text-white"  >Onaylanan EĞİTİMLER</h5>
                                <span class="h2 font-weight-bold mb-0 text-white">{{onaylanan_katilimci}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape text-white rounded-circle shadow">
                                
                                <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/graduation-cap.png" alt="graduation-cap"/>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 col-lg-6">
                <a href="/admin/egitim">
                    <div class="card card-stats mb-4 mb-xl-0"  style="background: #1D4793;">
                        <div class="card-body">
                            <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 text-white" >Toplam ÖNERİLEN EĞİTİMLER</h5>
                                <span class="h2 font-weight-bold mb-0 text-white">{{toplam_katilimci}}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape text-white rounded-circle shadow">
                                
                                <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/graduation-cap.png" alt="graduation-cap"/>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row p-3" >
            <div class="col-xl-4 col-lg-6">
                <a href="/admin/universite">
                <div class="card card-stats mb-4 mb-xl-0" style="background: #662E93;">
                    <div class="card-body">
                    <div class="row">
                        <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0 text-white">AKTİF Anlaşmalı Kurum</h5>
                        <span class="h2 font-weight-bold mb-0 text-white">{{ aktif_universite }}</span>
                        </div>
                        <div class="col-auto">
                        <div class="icon icon-shape text-white rounded-circle shadow">
                            
                            <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/university.png" alt="university"/>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-xl-4 col-lg-6">
                <a href="/admin/egitim">
                <div class="card card-stats mb-4 mb-xl-0" style="background: #4B3792;">
                    <div class="card-body">
                    <div class="row">
                        <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0 text-white">Aktif EĞİTİM Sayısı</h5>
                        <span class="h2 font-weight-bold mb-0 text-white">{{aktif_egitim}}</span>
                        </div>
                        <div class="col-auto">
                        <div class="icon icon-shape text-white rounded-circle shadow">
                            <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/graduation-cap.png" alt="graduation-cap"/>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-xl-4 col-lg-6">
                <a href="/admin/egitim">
                <div class="card card-stats mb-4 mb-xl-0" style="background: #4B3792;">
                    <div class="card-body">
                    <div class="row">
                        <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0 text-white">Toplam EĞİTİM Sayısı</h5>
                        <span class="h2 font-weight-bold mb-0 text-white">{{toplam_egitim}}</span>
                        </div>
                        <div class="col-auto">
                        <div class="icon icon-shape text-white rounded-circle shadow">
                            <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/graduation-cap.png" alt="graduation-cap"/>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </a>
            </div>
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
