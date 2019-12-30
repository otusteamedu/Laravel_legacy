import List from "./components/admin/user/List";

require('./bootstrap');

import Vue from 'vue';
import Axios from 'axios';
import VueRouter from 'vue-router';
import router from "./router";
import VueBootstrap from 'bootstrap-vue';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

import App from './components/App';

Vue.use(VueRouter);
Vue.use(VueBootstrap);



const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
