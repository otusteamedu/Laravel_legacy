import Vue from 'vue';

import LaravelPagination from 'laravel-vue-pagination';
import VueRouter from 'vue-router';
import router from "./router";
import VueBootstrap from 'bootstrap-vue';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import axios from 'axios';
import VueAxios from 'vue-axios';
import VueAuth from '@websanova/vue-auth';

import App from './components/App';

// @websanova/vue-auth
import websanovaAuth from '@websanova/vue-auth/drivers/auth/bearer';
import websanovaHttp from '@websanova/vue-auth/drivers/http/axios.1.x';
import websanovaRouter from '@websanova/vue-auth/drivers/router/vue-router.2.x';

Vue.use(VueAxios, axios);
Vue.use(VueRouter);
Vue.use(VueBootstrap);

Vue.use(VueAuth, {
    auth: websanovaAuth,
    http: websanovaHttp,
    router: websanovaRouter
});

Vue.component('pagination', LaravelPagination);

const app = new Vue({
    el: '#app',
    components: {App},
    router,
});
