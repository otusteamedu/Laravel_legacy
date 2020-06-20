require('./bootstrap');

import Vue    	 from 'vue';
import router    from './routes.js';
import VueInternationalization from 'vue-i18n';
import Locale from './vue-i18n-locales.generated';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faShoppingBasket, faSearch, faCog, faTrashAlt } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import store  	 from './store.js'

library.add(faShoppingBasket, faSearch, faCog, faTrashAlt);

Vue.component('font-awesome-icon', FontAwesomeIcon);

Vue.use(VueInternationalization);

const lang = document.documentElement.lang.substr(0, 2);

const i18n = new VueInternationalization({
    locale: lang,
    messages: Locale
});

const app = new Vue({
    el: '#app',
    i18n,
    router,
    store
});

Vue.config.productionTip = false; // TODO remove
