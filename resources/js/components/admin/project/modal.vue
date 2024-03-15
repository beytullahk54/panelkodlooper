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
                            <input
                                v-model="data.db_not"
                                type="text"
                                class="form-control"
                                id="exampleFormControlInput1"
                            />
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
