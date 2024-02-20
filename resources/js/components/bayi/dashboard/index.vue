<template>
    <div>
        <div class="row p-3 ">
           <!-- <div class="col-md-4">
                <span class="btn btn-success btn-block" >Toplam Katılımcım: {{ firma.bakiye }} ₺ </span>
            </div>
            <div class="col-md-4">
                <span class="btn btn-success btn-block" >Onay Bekleyen Katılımcım: {{ firma.bakiye }} ₺ </span>
            </div>
            <div class="col-md-4">
                <span class="btn btn-success btn-block" >Onaylanan Katılımcım: {{ firma.bakiye }} ₺ </span>
            </div>
            <div class="col-md-4">
                <span class="btn btn-success btn-block" >Aktif Üniversite: {{ firma.bakiye }} ₺ </span>
            </div>
            <div class="col-md-4">
                <span class="btn btn-success btn-block" >Aktif Eğitim Sayısı: {{ firma.bakiye }} ₺ </span>
            </div>-->

            <div class="col-md-4 align-self-center">              
              <div class="card card-stats mb-4 mb-xl-0"  style="background: #2BCE89;">
                
                <div class="card-body">
                  <a href="/bayi/bakiye-islemleri">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0 text-white"> BAKİYEM</h5>
                        <span class="h2 font-weight-bold mb-0 text-white">{{firma.bakiye}} ₺</span>
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
            <div class="col-md-4">
                
            </div>
            <div class="col-md-4">
            </div>
            
           
        </div>
        <div class="row p-3">
            <div class="col-xl-4 col-lg-6">
              
              <div class="card card-stats mb-4 mb-xl-0"  style="background: #8F2195;">
                
                  <div class="card-body">
                    <a href="/bayi/katilimci">
                      <div class="row">
                        <div class="col">
                          <h5 class="card-title text-uppercase text-muted mb-0 text-white">Onay Bekleyen Katılımcılarım</h5>
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
                <a href="/bayi/katilimci">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0 text-white"  >Onaylanan Katılımcılarım</h5>
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
                <a href="/bayi/katilimci">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0 text-white" >Toplam Katılımcılarım</h5>
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
              <div class="card card-stats mb-4 mb-xl-0"  style="background: #1D4793;">
                <a href="/bayi/egitimlerim">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0 text-white">Onay Bekleyen EĞİTİMLERİM</h5>
                        <span class="h2 font-weight-bold mb-0 text-white">{{onay_bekleyen_katilim}}</span>
                      </div>
                      <div class="col-auto">
                          <div class="icon icon-shape text-white rounded-circle shadow">
                            
                          <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/graduation-cap.png" alt="graduation-cap"/>
                          </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0"  style="background: #1D4793;">

                <a href="/bayi/egitimlerim">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0 text-white"  >Onaylanan EĞİTİMLERİM</h5>
                        <span class="h2 font-weight-bold mb-0 text-white">{{onaylanan_katilimci}}</span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape text-white rounded-circle shadow">
                          
                          <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/graduation-cap.png" alt="graduation-cap"/>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0"  style="background: #1D4793;">

                <a href="/bayi/egitimlerim">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0 text-white" >Toplam EĞİTİMLERİM</h5>
                        <span class="h2 font-weight-bold mb-0 text-white">{{toplam_katilimci}}</span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape text-white rounded-circle shadow">
                          
                          <img width="50" height="50" src="https://img.icons8.com/ios-filled/50/FFFFFF/graduation-cap.png" alt="graduation-cap"/>
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
              <a href="/bayi/destek">
                <div class="card card-stats mb-4 mb-xl-0"  style="background:#0cbfd3;">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0 text-white">AKTİF Destek TALEPLERİM</h5>
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
              <a href="/bayi/destek">
                <div class="card card-stats mb-4 mb-xl-0"  style="background:#0cbfd3;">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0 text-white"  >Tamamlanan Destek TALEPLERİM</h5>
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
              <a href="/bayi/destek">
                <div class="card card-stats mb-4 mb-xl-0"  style="background:#0cbfd3;">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0 text-white" >Toplam Destek TALEPLERİM</h5>
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
        <div class="row p-3" >
            <!--<div class="col-xl-4 col-lg-6">
              <a href="/bayi/universite">
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
            </div>-->
            <div class="col-xl-4 col-lg-6">
              <a href="/bayi/egitim">
                <div class="card card-stats mb-4 mb-xl-0" style="background: #4B3792;">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0 text-white">AKTİF EĞİTİM Sayısı</h5>
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
              <a href="/bayi/egitim">
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
        <div class="row">
          <div class="col-md-12">
            <duyuru-bayi page-title="Duyurular" yeni="false" search="false" page-url="duyuru"/>
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
            aktif_universite:0,
            aktif_egitim:0,
            toplam_egitim:0,
            aktif_destek_talepleri:0,
            tamamlanan_destek_talepleri:0,
            toplam_destek_talepleri:0,
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
                    this.firma = response.data.firma;
                    this.onay_bekleyen_katilim = response.data.onay_bekleyen_katilim;
                    this.onaylanan_katilimci = response.data.onaylanan_katilimci;
                    this.toplam_katilimci = response.data.toplam_katilimci;
                    this.aktif_universite = response.data.aktif_universite;
                    this.aktif_egitim = response.data.aktif_egitim;
                    this.toplam_egitim = response.data.toplam_egitim;
                    this.aktif_destek_talepleri = response.data.aktif_destek_talepleri;
                    this.tamamlanan_destek_talepleri = response.data.tamamlanan_destek_talepleri;
                    this.toplam_destek_talepleri = response.data.toplam_destek_talepleri;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    }
       
};
</script>
