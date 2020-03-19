require('./bootstrap');
import Vue from 'vue';
import axios from "axios/index";
import Notify from 'vue2-notify';
import VueConfirmDialog from "vue-confirm-dialog";

Vue.use(Notify, {position: 'top-right'});
Vue.use(VueConfirmDialog);

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
