import Vue from "vue";
import VueRouter from "vue-router";
import Sidebar from "./components/Sidebar"
import Breadcrumb from "./components/Breadcrumb"
import _Api from "./api";
import store from "./store";
import router from "./router";
import Toasted from 'vue-toasted';
import VueI18n from "vue-i18n";

import draggable from 'vuedraggable'

window.axios = require('axios');
// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    window.axios.defaults.headers.common['Accept'] = "application/json, text/javascript, */*; q=0.01";
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

window.Api = new _Api(token.content, window.apiRoute);
Vue.use(VueRouter);
Vue.use(Toasted)
Vue.use(VueI18n);

Vue.component("breadcrumb", Breadcrumb);
Vue.component("draggable", draggable);

const i18n = new VueI18n(window.i18n || {});

new Vue({
    i18n,
    router,
    store,
    data: () => ({
        title: "Dashboard"
    }),
    components: {
        Sidebar
    },
    mounted() {
        this.updateTitle();
    },
    methods: {
        updateTitle() {
            if (this.$route && this.$route.meta && this.$route.meta.title) {
                this.title = this.$route.meta.title
            } else {
                this.title = "Unknown :("
            }
        }
    },
    watch: {
        "$route": {
            handler() {
                this.updateTitle();
            },
            deep: true
        }
    }

}).$mount("#app");
