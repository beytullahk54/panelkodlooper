<template>
    <div>
        <!-- Modal -->
        <div
            class="modal fade"
            id="exampleModal"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog">
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
                                >Destek Konu Başlığı</label
                            >
                            <input
                                v-model="data.db_destek_konu"
                                type="text"
                                class="form-control"
                                id="exampleFormControlInput1"
                            />
                        </div>
                        <div class="mb-3">
                            <label
                                for="exampleFormControlInput1"
                                class="form-label"
                                >Destek Konu Detayı</label
                            >
                            <textarea
                                v-model="data.db_destek_aciklama"
                                type="text"
                                cols="20"
                                rows="15"
                                class="form-control"
                                id="exampleFormControlInput1"
                            >
                            </textarea>
                        </div>
                            
                            <div class="form-group">
                                <label for="exampleInputPassword">Destek Talep Görselleri</label>
                                <vue-upload-multiple-image
                                    accept="file"
                                    @upload-success="uploadImageSuccess"
                                    @before-remove="beforeRemove"
                                    @edit-image="editImage"
                                    :data-images="data.image"
                                    :multiple="true"
                                    dragText="Dosya Sürükleyiniz"
                                    browseText="Dosya Seçiniz"
                                    primaryText="Yüklendi"
                                ></vue-upload-multiple-image>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Kapat
                        </button>
                        <button
                            type="button"
                            @click="kaydetClicked"
                            class="btn btn-primary"
                            data-bs-dismiss="modal"
                        >
                            Gönder
                        </button>
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
            destekGorsel:[]
        };
    },
    props: {
        data: Object,
        modal: Object,
    },
    methods: {
        kaydetClicked() {
            // Modal içinde "Kaydet" butonuna tıklandığında bu metod çalışacak
            this.data.destekGorsel = this.destekGorsel
            this.$emit("kaydet", { data: this.data });
        },

        uploadImageSuccess(formData, index, fileList) {
            console.log('data', formData, index, fileList)
            
            let axiosUrl="";
            axiosUrl = "/gorselUpload/destekGorsel"
            
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
    },
};
</script>
