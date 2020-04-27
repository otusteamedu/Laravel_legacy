import Vue from 'vue';
import Vuex from 'vuex';

import images from './modules/images';

import categories from './modules/categories';
import subCategories from './modules/sub-categories';
import textures from './modules/textures';
import users from './modules/users';
import roles from './modules/roles';
import permissions from './modules/permissions';
import settings from './modules/settings';
import settingGroups from './modules/setting-groups';
import deliveries from './modules/deliveries';
import orders from './modules/orders';
import orderStatuses from './modules/order-statuses';

Vue.use(Vuex);

import errors from '@/lib/errors';

const state = {
    pageTitle: '',
    serverErrors: [],
    searchedData: [],
    searchQuery: '',
    loading: false
};

const mutations = {
    SET_PAGE_TITLE(state, payload) {
        state.pageTitle = payload;
    },
    UPDATE_ERRORS(state, payload) {
        state.serverErrors = [];
        let error = payload;
        switch (error.status) {
            case 404:
                state.serverErrors.push(errors.ERROR_NOTFOUND);
                break;
            case 422:
                if (error.data.errors) {
                    for (let errorKey in error.data.errors) {
                        error.data.errors[errorKey].forEach(errorMessage => state.serverErrors.push(errorMessage));
                    }
                } else {
                    state.serverErrors.push(error.data.message);
                }
                break;
            default :
                state.serverErrors.push(errors.ERROR_DEFAULT);
        }
    },
    CLEAR_ERRORS(state) {
        state.serverErrors = [];
    },
    SET_SEARCHED_DATA(state, payload) {
        state.searchedData = payload;
    },
    DELETE_SEARCHED_DATA_ITEM(state, payload) {
        state.searchedData = state.searchedData.filter(item => item.id !== +payload);
    },
    SET_SEARCH_QUERY(state, payload) {
        state.searchQuery = payload.trim();
    },
    SET_LOADING(state, payload) {
        state.loading = !!payload;
    },
    CHANGE_PUBLISH(state, payload) {
        state.searchedData.forEach(item => {
            if(item.id === payload.id) {
                return item.publish = payload.publish;
            }
        });
    },
};

const actions = {
    setPageTitle(context, payload) {
        context.commit('SET_PAGE_TITLE', payload);
    },
    setSearchedData(context, payload) {
        context.commit('SET_SEARCHED_DATA', payload);
    },
    setSearchQuery(context, payload) {
        context.commit('SET_SEARCH_QUERY', payload);
    },
    setLoading(context, payload) {
        context.commit('SET_LOADING', payload);
    }
};

const getters = {
    pageTitle: state => state.pageTitle,
    serverErrors: state => state.serverErrors
};

export default new Vuex.Store({
    state,
    mutations,
    actions,
    getters,
    modules: {
        images,
        categories,
        subCategories,
        users,
        roles,
        permissions,
        textures,
        settings,
        settingGroups,
        deliveries,
        orders,
        orderStatuses
    }
});
