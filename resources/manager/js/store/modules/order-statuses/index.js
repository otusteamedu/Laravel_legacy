import differenceBy from 'lodash/differenceBy'
import { uniqueFieldEditMixin, uniqueFieldMixin } from "../../mixins/getters";
import {axiosAction, axiosPatch} from "../../mixins/actions";

const state = {
    fields: {
        title: '',
        alias: '',
        order: '',
        publish: '',
        description: ''
    },
    item: {},
    items: []
};

const mutations = {
    SET_ITEMS(state, payload) {
        state.items = payload;
    },
    UPDATE_FIELD(state, { field, value }) {
        state.fields[field] = value;
    },
    SET_FIELDS(state, payload) {
        for(const [field, value] of Object.entries(payload)) {
            if (Object.hasOwnProperty.call(state.fields, field)) {
                state.fields[field] = value
            }
        }
    },
    DELETE_ITEM(state, payload) {
        state.items = state.items.filter(item => item.id !== payload);
    },
    CLEAR_FIELDS(state) {
        for(const field of Object.keys(state.fields)) {
            state.fields[field] = '';
        }
    },
    TOGGLE_PUBLISH_FIELD(state) {
        state.fields.publish = +!state.fields.publish;
    },
    CHANGE_PUBLISH(state, payload) {
        state.items.forEach(item => {
            if(item.id === payload.id) {
                item.publish = payload.publish;
            }
        });
    }
};

const actions = {
    getItems(context) {
        return axiosAction('get', context, {
            url: '/api/manager/store/order-statuses',
            thenContent: response => context.commit('SET_ITEMS', response.data)
        })
    },
    getItem(context, id) {
        return axiosAction('get', context, {
            url: `/api/manager/store/order-statuses/${id}`,
            thenContent: response => context.commit('SET_FIELDS', response.data)
        })
    },
    store(context, payload) {
        return axiosAction('post', context, {
            url: '/api/manager/store/order-statuses',
            data: payload
        })
    },
    update(context, { id, data }) {
        return axiosPatch({
            url: `/store/order-statuses/${id}`,
            context,
            data
        })
    },
    destroy(context, id) {
        return axiosAction('delete', context, {
            url: `/api/manager/store/order-statuses/${id}`,
            thenContent: response => context.commit('DELETE_ITEM', id)
        })
    },
    setField(context, payload) {
        context.commit('SET_FIELD', payload);
    },
    clearFields(context) {
        context.commit('CLEAR_FIELDS');
    },
    togglePublishField(context) {
        context.commit('TOGGLE_PUBLISH_FIELD');
    },
    publish(context, id) {
        return axiosAction('get', context, {
            url: `/api/manager/store/order-statuses/${id}/publish`,
            thenContent: response => context.commit('CHANGE_PUBLISH', response.data)
        })
    },
    updateField(context, payload) {
        context.commit('UPDATE_FIELD', payload);
    },
};

const getters = {
    isUniqueTitle: state => value => uniqueFieldMixin(state.items, 'title', value),
    isUniqueTitleEdit: state => (value, id) => uniqueFieldEditMixin(state.items, 'title', value, id),
    isUniqueAlias: state => title => uniqueFieldMixin(state.items, 'alias', title),
    isUniqueAliasEdit: state => (title, id) => uniqueFieldEditMixin(state.items, 'alias', title, id),
    getItemById: state => id => state.items.find(item => item.id === id),
    getRestItems: state => currentOrder => state.items.filter(item => item.order > currentOrder)
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
};
