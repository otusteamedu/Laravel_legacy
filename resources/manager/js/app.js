// =========================================================
// * Vue Material Dashboard PRO - v1.3.1
// =========================================================
//
// * Product Page: https://www.creative-tim.com/product/vue-material-dashboard-pro
// * Copyright 2019 Creative Tim (https://www.creative-tim.com)
//
// * Coded by Creative Tim
//
// =========================================================
//
// * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

import Vue from "vue";
import VueRouter from "vue-router";

import store from './store'

// Plugins
import DashboardPlugin from "./material-dashboard";
import Vuelidate from 'vuelidate'
import App from "./App.vue";
import Chartist from "chartist";
import CKEditor from '@ckeditor/ckeditor5-vue';

import langLibrary from './lib/Validations';

// router setup
import routes from "./routes/routes";

// plugin setup
Vue.use(VueRouter);
Vue.use(DashboardPlugin);
Vue.use(Vuelidate);
Vue.use(CKEditor);

Vue.prototype.$langLib = langLibrary;

// configure router
const router = new VueRouter({
    mode: 'history',
    routes, // short for routes: routes
    scrollBehavior: to => {
        if (to.hash) {
            return { selector: to.hash };
        } else {
            return { x: 0, y: 0 };
        }
    },
    linkExactActiveClass: "nav-item active"
});

// global library setup
Object.defineProperty(Vue.prototype, "$Chartist", {
    get() {
        return this.$root.Chartist;
    }
});

/* eslint-disable no-new */
new Vue({
    el: "#app",
    store,
    render: h => h(App),
    router,
    data: {
        Chartist: Chartist
    }
});
