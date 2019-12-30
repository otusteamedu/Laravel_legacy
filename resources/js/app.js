import Vue from 'vue';

import LaravelPagination from 'laravel-vue-pagination';
import VueRouter from 'vue-router';
import router from "./router";
import VueBootstrap from 'bootstrap-vue';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

import App from './components/App';

Vue.use(VueRouter);
Vue.use(VueBootstrap);

Vue.component('pagination', LaravelPagination);

const app = new Vue({
    el: '#app',
    components: {App},
    router,
});
