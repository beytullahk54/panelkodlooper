/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
require('nodejs-base64-converter');


window.Vue = require("vue").default;

import VueCal from "vue-cal";
import JsonExcel from 'vue-json-excel';
import "vue-cal/dist/vuecal.css";
import Editor from '@tinymce/tinymce-vue'
import Toasted from 'vue-toasted';

import VueLazyload from 'vue-lazyload';

import Multiselect from 'vue-multiselect'

// register globally
Vue.component('Editor', Editor)
Vue.component('multiselect', Multiselect)
Vue.use(VueLazyload);
Vue.use(Toasted,{duration:10000,
    onClick : (e, toastObject) => {
        toastObject.goAway(0);
    },
    action : [
        {
            text : 'X',
            onClick : (e, toastObject) => {
                toastObject.goAway(0);
            }
        }
    ]})
Vue.component('downloadExcel', JsonExcel);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/*Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);*/

//ADMİN
Vue.prototype.$developer = false;

Vue.filter('dateConverter', function(dateF) {
    const date = new Date(dateF);
    const year = date.getFullYear().toString().slice(-4);
    const month = (date.getMonth() + 1).toString().padStart(2, '0');
    const day = date.getDate().toString().padStart(2, '0');
    const hours = date.getHours();
    const minute = date.getMinutes();
    return `${day}.${month}.${year} ${hours}:${minute}`;
});
Vue.filter('dateConverterSaatsiz', function(dateF) {
    const date = new Date(dateF);
    const year = date.getFullYear().toString().slice(-4);
    const month = (date.getMonth() + 1).toString().padStart(2, '0');
    const day = date.getDate().toString().padStart(2, '0');
    const hours = date.getHours();
    const minute = date.getMinutes();
    return dateF != null?`${day}.${month}.${year}`:"";
});

Vue.component("dashboard", require("./components/admin/dashboard/index.vue").default);

Vue.component("firma-olustur", require("./components/auth/register.vue").default);

Vue.component("bakiye-islemleri", require("./components/admin/bakiyeIslemleri/index.vue").default);
Vue.component("bakiye-islemleri-modal", require("./components/admin/bakiyeIslemleri/modal.vue").default);

Vue.component("takvim", require("./components/takvim.vue").default);

Vue.component("bayi", require("./components/admin/bayi/index.vue").default);
Vue.component("bayi-view", require("./components/admin/bayi/view.vue").default);
Vue.component("bayi-modal", require("./components/admin/bayi/modal.vue").default);

Vue.component("katilimci", require("./components/admin/katilimci/index.vue").default);
Vue.component("katilimci-yeni", require("./components/admin/katilimci/yeni.vue").default);
Vue.component("katilimci-view", require("./components/admin/katilimci/view.vue").default);
Vue.component(
    "katilimci-modal",
    require("./components/admin/katilimci/modal.vue").default
);

Vue.component("project", require("./components/admin/project/index.vue").default);
Vue.component("project-modal",require("./components/admin/project/modal.vue").default);
Vue.component("project-view",require("./components/admin/project/view.vue").default);

Vue.component("hizmet", require("./components/admin/hizmet/index.vue").default);
Vue.component("hizmet-modal",require("./components/admin/hizmet/modal.vue").default);
Vue.component("hizmet-view",require("./components/admin/hizmet/view.vue").default);

Vue.component("duyuru", require("./components/admin/duyuru/index.vue").default);
Vue.component(
    "duyuru-modal",
    require("./components/admin/duyuru/modal.vue").default
);

Vue.component("egitim", require("./components/admin/egitim/index.vue").default);
Vue.component("egitim-yeni", require("./components/admin/egitim/yeni.vue").default);
Vue.component("egitim-detay", require("./components/admin/egitim/detayPage.vue").default);
Vue.component("egitim-guncelle", require("./components/admin/egitim/guncelle.vue").default);
Vue.component("egitim-modal", require("./components/admin/egitim/modal.vue").default);
Vue.component("egitim-detay-modal", require("./components/admin/egitim/detayModal.vue").default);

Vue.component(
    "universite",
    require("./components/admin/universite/index.vue").default
);
Vue.component(
    "universite-modal",
    require("./components/admin/universite/modal.vue").default
);

Vue.component("destek", require("./components/admin/destek/index.vue").default);
Vue.component("destek-detay", require("./components/admin/destek/detay.vue").default);
Vue.component("destek-modal", require("./components/admin/destek/modal.vue").default);

Vue.component("varyant", require("./components/admin/varyant/index.vue").default);
Vue.component(
    "varyant-modal",
    require("./components/admin/varyant/modal.vue").default
);

Vue.component("vue-cal", VueCal);

Vue.component("ayarlar", require("./components/admin/ayarlar/index.vue").default);

//BAYİ


Vue.component("dashboard-bayi", require("./components/bayi/dashboard/index.vue").default);

Vue.component(
    "universite-bayi",
    require("./components/bayi/universite/index.vue").default
);

Vue.component("katilimci-bayi", require("./components/bayi/katilimci/index.vue").default);
Vue.component("katilimci-bayi-yeni", require("./components/bayi/katilimci/yeni.vue").default);
Vue.component(
    "katilimci-bayi-modal",
    require("./components/bayi/katilimci/modal.vue").default
);


Vue.component("profil-bayi", require("./components/bayi/profil/index.vue").default);
Vue.component("destek-bayi", require("./components/bayi/destek/index.vue").default);
Vue.component("destek-bayi-modal", require("./components/bayi/destek/modal.vue").default);
Vue.component("destek-bayi-detay", require("./components/bayi/destek/detay.vue").default);

Vue.component("egitim-bayi", require("./components/bayi/egitim/index.vue").default);
Vue.component("egitim-detay-bayi", require("./components/bayi/egitim/detayPage.vue").default);

Vue.component("iletisim", require("./components/bayi/iletisim/index.vue").default);

Vue.component("sss", require("./components/bayi/sss/index.vue").default);

Vue.component("hizmet-sozlesmesi", require("./components/bayi/hizmetSozlesmesi/index.vue").default);

Vue.component("bakiye-islemleri-bayi", require("./components/bayi/bakiyeIslemleri/index.vue").default);
Vue.component("bakiye-islemleri-bayi-new", require("./components/bayi/bakiyeIslemleri/new.vue").default);
Vue.component("bakiye-islemleri-modal-bayi", require("./components/bayi/bakiyeIslemleri/modal.vue").default);

Vue.component("duyuru-bayi", require("./components/bayi/duyuru/index.vue").default);
Vue.component(
    "duyuru-modal-bayi",
    require("./components/bayi/duyuru/modal.vue").default
);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
});
