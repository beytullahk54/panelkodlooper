<template>
    <div>
        
            <div class="modal-content">
                <div class="modal-header">
                    <h1
                        class="modal-title fs-5"
                        id="exampleModalLabel"
                    ></h1>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Kapat"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label
                            for="exampleFormControlInput1"
                            class="form-label"
                            >Miktar  </label
                        >
                        <div class="input-group">
                            <input type="text" v-model="data.bakiye" class="form-control" aria-label="Amount (to the nearest dollar)">
                            <div class="input-group-append">
                                <span class="input-group-text">₺</span>
                            </div>
                        </div>
                    </div>
                    <span class="badge badge-danger"> Ödeme türü seçmek için bakiye giriniz </span>
                    <div class="mb-3" v-if="data.bakiye  ">
                        <br>
                        <label
                            for="exampleFormControlInput1"
                            class="form-label"
                            ><b>Ödeme Yöntemi Seçiniz</b></label
                        >
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="banka" v-on:change="odemeTuruBakiyeKontrol()"  v-model="data.db_odeme_turu">
                            <label class="form-check-label" style="font-size:18px;" for="exampleRadios2">
                                Havale / EFT / FAST ile Öde
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="kredi_karti" v-on:change="odemeTuru()" v-model="data.db_odeme_turu">
                            <label class="form-check-label" style="font-size:18px;" for="exampleRadios1">
                                Kredi / Banka Kartı ile Öde
                            </label>
                        </div>
                    </div>
                    <div v-if="data.db_odeme_turu == 'kredi_karti' && odemeIzni==true" style="height: 700px;">

                            <iframe :src="'https://www.paytr.com/odeme/guvenli/'+paytrToken" v-if="paytrToken" id="paytriframe" style="height: 1000px!important;width: 100%;" frameborder="0"  ></iframe>

                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        @click="dataStore"
                        class="btn btn-primary"
                        data-bs-dismiss="modal"
                        v-if="data.bakiye >= minBakiye && data.db_odeme_turu == 'banka'"
                    >
                        Talep Oluştur
                    </button>
                </div>
            </div>
        
    </div>

</template>
<style>
    .input-group-addon {
        background-color: #e9ecef;
        border: 1px solid #ced4da;
        padding: 0.375rem 0.75rem;
        margin-bottom: 0;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        text-align: center;
        border-radius: 0.25rem;
    }
</style>
<script>
export default {
    data() {
        return {
            paytrToken:"",
            data:{},
            odemeIzni:false,
            minBakiye:0

        };
    },
    props: {
        
        modal: Object
    },

    methods: {
        async odemeTuruBakiyeKontrol(){
            await axios.post('/bayi/bakiye-islemleri/bakiyeKontrol',{"bakiye":this.data.bakiye}).then(res=>{
                this.minBakiye = res.data.min_bakiye
                if(res.data.status=="true"){
                    this.odemeIzni=true
                }else{
                    this.$toasted.error(res.data.message)
                    this.odemeIzni=false
                }
                
            })
        },
        async odemeTuru(){
            await  this.odemeTuruBakiyeKontrol()
            if(this.odemeIzni==true){
                axios.post('/kredi-karti-paytr-on-hazirlik',{"bakiye":this.data.bakiye}).then(res=>{
                        this.paytrToken = res.data.result
                })
            }
        },
        dataStore() {
            this.$toasted.info("İşlem devam ediyor")
            axios
                .post("/bayi/bakiye-islemleri/create", this.data )
                .then((response) => {
                    this.$toasted.success(response.data.message)
                    if(this.data.db_odeme_turu == 'banka'){
                        location.href='/bayi/bakiye-islemleri/'

                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
