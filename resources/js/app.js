require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import VueBootstrap from 'bootstrap-vue';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

Vue.use(VueRouter);
Vue.use(VueBootstrap);

import App from './components/App';
import About from './components/About';
import Home from './components/Home';
import Features from './components/Features';
import Prices from './components/Prices';
import Contacts from './components/Contacts';

import Registration from './components/auth/Registration';
import Login from './components/auth/Login';
import ForgotPassword from './components/auth/ForgotPassword';

import Terms from './components/Terms';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/about',
            name: 'about',
            component: About,
        },
        {
            path: '/features',
            name: 'features',
            component: Features,
        },
        {
            path: '/prices',
            name: 'prices',
            component: Prices,
        },
        {
            path: '/contacts',
            name: 'contacts',
            component: Contacts,
        },
        {
            path: '/registration',
            name: 'registration',
            component: Registration,
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
        {
            path: '/forgot-password',
            name: 'forgot-password',
            component: ForgotPassword,
        },
        {
            path: '/terms',
            name: 'terms',
            component: Terms,
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});