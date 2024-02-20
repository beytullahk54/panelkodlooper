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
                        >X</button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-1">
                            <b>{{data.db_adi}}</b>
                            <b>Duyuru Açıklaması:</b>
                            <p  v-html="data.db_aciklama" />
                        </div>
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
