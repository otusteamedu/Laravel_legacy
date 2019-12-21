/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

window.Vue = require('vue');

import UIkit from 'uikit';
import Icons from 'uikit/dist/js/uikit-icons';

UIkit.use(Icons);

/**
 * Device detect
 */
import MobileDetect from 'mobile-detect';
const md = new MobileDetect(window.navigator.userAgent);
const html = document.querySelector('html');
if (md.phone() || md.tablet()) {
    html.classList.add('touch');
}

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('navbar-component', require('./components/NavbarComponent.vue').default);
Vue.component('footer-component', require('./components/FooterComponent.vue').default);
Vue.component('consultation-component', require('./components/ConsultationComponent.vue').default);
Vue.component('hero-home', require('./components/Home/HeroHome.vue').default);
Vue.component('albums-home', require('./components/Home/AlbumsHome.vue').default);
Vue.component('materials-home', require('./components/Home/MaterialsHome.vue').default);
Vue.component('chronometer-home', require('./components/Home/ChronometerHome.vue').default);
Vue.component('interiors-home', require('./components/Home/InteriorsHome.vue').default);
Vue.component('topics-home', require('./components/Home/TopicsHome.vue').default);
Vue.component('you-get-home', require('./components/Home/YouGetHome.vue').default);
Vue.component('buying-scheme-home', require('./components/Home/BuyingSchemeHome.vue').default);

Vue.component('hero-materials', require('./components/Materials/HeroMaterials.vue').default);

import App from './App.vue';
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    // render: h => h(App),
});
