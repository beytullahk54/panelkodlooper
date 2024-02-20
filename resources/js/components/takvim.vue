<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Takvim</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="p-2">
                            <div
                                class="alert alert-info alert-dismissible fade show"
                                role="alert"
                            >
                                <span class="alert-inner--icon"
                                    ><i class="ni ni-like-2"></i
                                ></span>
                                <span class="alert-inner--text"
                                    ><strong>Takvim sayfana hoşgeldin,</strong>
                                    burada oluşturulan randevularını
                                    görüntüleyebilirsin</span
                                >
                            </div>
                        </div>

                        <div class="p-2">
                            <div
                                class="alert alert-info alert-dismissible fade show"
                                role="alert"
                            >
                                <span class="alert-inner--icon"
                                    ><i class="ni ni-like-2"></i
                                ></span>
                                <span class="alert-inner--text"
                                    >Kısa süre sonra randevularını excel'e
                                    aktarabileceksin.</span
                                >
                            </div>
                        </div>

                        <div class="p-5">
                            <vue-cal style="height: 1000px" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup></script>
