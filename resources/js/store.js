import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import { global } from './modules/global.js';
import { order } from './modules/order.js';

export default new Vuex.Store({
	modules: {
        global,
        order
    }
});
