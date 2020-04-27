import last from 'lodash/last'
import { axiosAction } from "../../mixins/actions";

const state = {
    item: {},
    items: []
};

const mutations = {
    SET_ITEMS(state, payload) {
        state.items = payload;
    },
    SET_ITEM(state, payload) {
        state.item = payload
    },
    UPDATE_ITEMS(state, payload) {
        state.items = state.items.map(item => item.id === payload.id ? payload : item);
    },
    DELETE_ITEM(state, payload) {
        state.items = state.items.filter(item => item.id !== payload);
    }
};

const actions = {
    getItems(context) {
        return axiosAction('get', context, {
            url: '/api/manager/store/orders',
            thenContent: response => context.commit('SET_ITEMS', response.data)
        })
    },
    getItem(context, id) {
        return axiosAction('get', context, {
            url: `/api/manager/store/orders/${id}/details`,
            thenContent: response => context.commit('SET_ITEM', response.data)
        })
    },
    destroy(context, id) {
        return axiosAction('delete', context, {
            url: `/api/manager/store/orders/${id}`,
            thenContent: response => context.commit('DELETE_ITEM', id)
        })
    },
    changeStatus(context, { id, status, list = true }) {
        return axiosAction('post', context, {
            url: `/api/manager/store/orders/${id}/status`,
            data: { status, list },
            thenContent: (response) => {
                list
                    ? context.commit('UPDATE_ITEMS', response.data)
                    : context.commit('SET_ITEM', response.data)
            }
        })
    }
};

const getters = {
    completedItems: state => state.items.filter((item) => {
        const currentStatus = last([...item.statuses]);
        return currentStatus.alias === 'completed';
    }),
    notCompletedItems: state => state.items.filter((item) => {
        const currentStatus = last([...item.statuses]);
        return currentStatus.alias !== 'completed';
    })
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
};
