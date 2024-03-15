<template>
    <div class="newPageStyle" >
            <div class="modal-content">
                <div class="modal-body">
                    <div class="mb-3">
                        <label
                            for="exampleFormControlInput1"
                            class="form-label"
                            >Proje Adı</label
                        >
                        <input
                            v-model="data.db_adi"
                            type="text"
                            class="form-control"
                            id="exampleFormControlInput1"
                        />
                    </div>
                    <div class="mb-3">
                        <label
                            for="exampleFormControlInput1"
                            class="form-label"
                            >Proje Başlangıç Tarihi</label
                        >
                        <input
                            v-model="data.db_project_start_date"
                            type="date"
                            class="form-control"
                            id="exampleFormControlInput1"
                        />
                    </div>
                    <div class="mb-3">
                        <label
                            for="exampleFormControlInput1"
                            class="form-label"
                            >Proje Bitiş Tarihi</label
                        >
                        <input
                            v-model="data.db_project_end_date"
                            type="date"
                            class="form-control"
                            id="exampleFormControlInput1"
                        />
                    </div>
                    <div class="mb-3">
                        <label
                            for="exampleFormControlInput1"
                            class="form-label"
                            >Proje Not</label
                        >

                        <Editor 
                        api-key="wsuxoph1s8qivel18r8hn6t0dnliik8883sz5nqy2gf07vgi"
                        :init="{
                            height: 500,
                            plugins: [
                                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                                'insertdatetime', 'media', 'table', 'help', 'wordcount'
                            ],
                            toolbar: 'undo redo | blocks | ' +
                            'bold italic backcolor | alignleft aligncenter ' +
                            'alignright alignjustify | bullist numlist outdent indent | ' +
                            'removeformat | help',
                          }"
                        v-model="data.db_not" rows="18" cols="50"></Editor>
                    </div>
                    <div class="mb-3">
                        <label
                            for="exampleFormControlInput1"
                            class="form-label"
                            >Tahmini Gün</label
                        >
                        <input
                            v-model="data.db_tahmini_gun"
                            type="text"
                            class="form-control"
                            id="exampleFormControlInput1"
                        />
                    </div>
                    <div class="mb-3">
                        <label
                            for="exampleFormControlInput1"
                            class="form-label"
                            >Tahmini Bitiş Tarihi</label
                        >
                        <input
                            v-model="data.db_tahmini_bitis_tarihi"
                            type="date"
                            class="form-control"
                            id="exampleFormControlInput1"
                        />
                    </div>
                    <div class="mb-3">
                        <label
                            for="exampleFormControlInput1"
                            class="form-label"
                            >Çalışılan Gün</label
                        >
                        <input
                            v-model="data.db_calisilan_gun"
                            type="text"
                            class="form-control"
                            id="exampleFormControlInput1"
                        />
                    </div>
                    <div class="mb-3">
                        <label
                            for="exampleFormControlInput1"
                            class="form-label"
                            >Teklif Fiyat</label
                        >
                        <input
                            v-model="data.db_teklif_ucret"
                            type="text"
                            class="form-control"
                            id="exampleFormControlInput1"
                        />
                    </div>
                    <div class="mb-3">
                        <label
                            for="exampleFormControlInput1"
                            class="form-label"
                            >Anlaşılan Ücret</label
                        >
                        <input
                            v-model="data.db_anlasilan_ucret"
                            type="text"
                            class="form-control"
                            id="exampleFormControlInput1"
                        />
                    </div>
                    <div class="mb-3">
                        <label
                            for="exampleFormControlInput1"
                            class="form-label"
                            >Hizmet</label
                        >
                        <input
                            v-model="data.db_hizmet"
                            type="text"
                            class="form-control"
                            id="exampleFormControlInput1"
                        />
                    </div>
                    <div class="mb-3">
                        <label
                            for="exampleFormControlInput1"
                            class="form-label"
                            >Müşteri</label
                        >
                        <input
                            v-model="data.db_musteri"
                            type="text"
                            class="form-control"
                            id="exampleFormControlInput1"
                        />
                    </div>
                    <div class="mb-3">
                        <label
                            for="exampleFormControlInput1"
                            class="form-label"
                            >Durum</label
                        >
                        <input
                            v-model="data.db_durum"
                            type="text"
                            class="form-control"
                            id="exampleFormControlInput1"
                        />
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        @click="kaydetClicked('onlySave')"
                        class="btn btn-primary"
                    >
                        Kaydet
                    </button>
                    <button
                        type="button"
                        @click="kaydetClicked('homeSave')"
                        class="btn btn-primary"
                    >
                        Kaydet / Anasayfa
                    </button>
                </div>
                
            </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            data:{},
            url:"/admin/project"
        };
    },
    mounted(){
        this.get()
    },
    props: {
        modal: Object,
        id:String
    },
    methods: {
        get(){
            axios.post(this.url+"/getData/"+this.id).then((response)=>{
                this.data = response.data.data
            })
        },
        kaydetClicked(transaction){
            axios.post(this.url+"/update/",this.data).then((response)=>{
                console.log(response.data)

                this.$toasted.success(response.data.message)
                if(transaction!="onlySave")
                {
                    location.href='/admin/project'
                }

            })
        }
    },
};
</script>
