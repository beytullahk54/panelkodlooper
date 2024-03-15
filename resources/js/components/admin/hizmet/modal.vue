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
                                >Proje Adı</label
                            >
                            <input
                                v-model="data.db_name"
                                type="text"
                                class="form-control"
                                id="exampleFormControlInput1"
                            />
                        </div>
                        <div class="mb-3">
                            <label
                                for="exampleFormControlInput1"
                                class="form-label"
                                >Proje Hizmet Bitiş Tarihi</label
                            >
                            <input
                                v-model="data.db_hizmet_bitis_tarihi"
                                type="date"
                                class="form-control"
                                id="exampleFormControlInput1"
                            />
                        </div>
                        <div class="mb-3">
                            <label
                                for="exampleFormControlInput1"
                                class="form-label"
                                >Hizmet Ücreti</label
                            >
                            <input
                                v-model="data.db_hizmet_ucreti"
                                type="text"
                                class="form-control"
                                id="exampleFormControlInput1"
                            />
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
                            Kaydet / Güncelle
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {};
    },
    props: {
        data: Object,
        modal: Object,
    },
    methods: {
        kaydetClicked() {
            // Modal içinde "Kaydet" butonuna tıklandığında bu metod çalışacak
            this.$emit("kaydet", { data: this.data });
        },
    },
};
</script>
