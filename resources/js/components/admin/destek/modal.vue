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
                                >Destek Konu</label
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
                        <div class="mb-3" >
                            <label
                                for="exampleFormControlInput1"
                                class="form-label"
                                >Bayi</label
                            >
                            <multiselect v-model="localDbHedefFirma" :options="bayis"   :multiple="false" label="firma_adi" placeholder="Bayi Seçiniz" @input="updateLocalDbHedefFirma"></multiselect>
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
                            Talep Oluştur
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
        return {
            localDbHedefFirma: {} // db_hedef_firma prop'unu bir veri olarak al
        };
    },
    props: {
        data: Object,
        modal: Object,
        bayis: Array,
    },
    watch: {
        // Watch özelliği ile data prop'u değiştiğinde localDbHedefFirma'yı güncelleyin
        data: {
            immediate: true,
            handler(newData) {
                this.localDbHedefFirma = newData.db_hedef_firma;
            }
        }
    },
    methods: {
        kaydetClicked() {
            // Modal içinde "Kaydet" butonuna tıklandığında bu metod çalışacak
            this.$emit("kaydet", { data: this.data });
        },
        
        updateLocalDbHedefFirma(newValue) {
            this.localDbHedefFirma = newValue;
            this.$emit('bayiUpdate', { data: { db_hedef_firma: newValue } });
        },
        kaydetClicked() {
            // Modal içinde "Kaydet" butonuna tıklandığında bu metod çalışacak
            this.$emit("kaydet", { data: this.data });
        },
    },
};
</script>
