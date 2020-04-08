/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue';
import axios from "axios/index";
import Notify from 'vue2-notify';
import VueConfirmDialog from "vue-confirm-dialog";

Vue.use(Notify, {position: 'top-right'});
Vue.use(VueConfirmDialog);

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const App = new Vue({
    el: '#app',
    data: {
        add: 0,
        edit: 0,
    },
    methods: {
        save: function (url, id, fields) {
            let data = {};
            fields.forEach((field) => {
                data.id = id;
                data[field] = this.$refs[field + '_' + id].value;
            });
            axios.post(url, data)
                .then((response) => {
                    if (this.checkResult(response.data)) {
                        document.location.reload();
                    }
                })
                .catch(function (error) {
                    console.log(error.response);
                    Vue.$notify(error.response.data.message, 'error');
                })
            ;
        },
        remove: function (url, id) {
            this.$vueConfirm.confirm(
                {
                    auth: false,
                    message: 'Вы уверены?',
                    button: {
                        no: 'Нет',
                        yes: 'Да'
                    }
                },
                (confirm) => {
                    if (confirm == true) {
                        axios.post(url, {id: id})
                            .then((response) => {
                                if (this.checkResult(response.data)) {
                                    document.location.reload();
                                }
                            })
                            .catch(function (error) {
                                console.log(error.response);
                                Vue.$notify(error.response.data.message, 'error');
                            })
                        ;
                    }
                }
            );
        },
        checkResult: function (data) {
            if (!!data.errors) {
                Vue.$notify(!!data.message ? data.message : 'Неизвестная ошибка!', 'error');
                return false;
            }
            return true;
        }
    },
});
