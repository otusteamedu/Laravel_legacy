// You should manually place <script> tag with admin bootstrap js file
// require('./bootstrap');

//const fonts = ['Lora:400,700', 'Roboto:400,700'];
//const web_fonts_loader = require('../modules/webfonts')(fonts);
//web_fonts_loader.load();

// window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('card-simple', require('./components/CardSimple.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });

(function($) {
    $(document).ready(function () {
        select2Features();
    });
})(jQuery);

const select2Features = function () {
    if (typeof $.fn.select2 === 'undefined') {
        return false;
    }

    $('.select2').select2();
};