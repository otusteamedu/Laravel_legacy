import { uniqueFieldEditMixin, uniqueFieldMixin } from "../../mixins/getters";

import { axiosAction } from "../../mixins/actions";

const state = {
    fields: {
        name: '',
        display_name: '',
        description: ''
    },
    items: []
};

const mutations = {
    UPDATE_ITEMS(state, payload) {
        state.items = payload;
    },
    UPDATE_FIELD(state, payload) {
        state.fields[payload.field] = payload.value;
    },
    DELETE_ITEM(state, payload) {
        state.items = state.items.filter(item => item.id !== payload);
    },
    CLEAR_FIELDS(state) {
        for(let field in state.fields) {
            state.fields[field] = '';
        }
    },
    UPDATE_FIELDS(state, payload) {
        for(let field in state.fields) {
            state.fields[field] = payload[field] === null ? '' : payload[field];
        }
    },
};

const actions = {
    index(context) {
        return axiosAction('get', context, {
            url: '/api/manager/permissions',
            thenContent: response => context.commit('UPDATE_ITEMS', response.data)
        })
    },
    show(context, id) {
        return axiosAction('get', context, {
            url: `/api/manager/permissions/${id}`,
            thenContent: response => context.commit('UPDATE_FIELDS', response.data)
        })
    },
    store(context, payload) {
        const form = new FormData();
        for(let item in payload) {
            form.append(item, payload[item]);
        }
        return axiosAction('post', context, {
            url: '/api/manager/permissions',
            data: form
        })
    },
    update(context, payload) {
        const form = new FormData();
        for(let item in payload.formData) {
            form.append(item, payload.formData[item]);
        }
        return axiosAction('post', context, {
            url: `/api/manager/permissions/${payload.id}`,
            data: form
        })
    },
    destroy(context, id) {
        return axiosAction('delete', context, {
            url: `/api/manager/permissions/${id}`,
            thenContent: response => context.commit('DELETE_ITEM', id)
        })
    },
    updateField(context, payload) {
        context.commit('UPDATE_FIELD', payload);
    },
    clearFields(context) {
        context.commit('CLEAR_FIELDS');
    }
};

const getters = {
    isUniqueName: state => value => uniqueFieldMixin(state.items, 'name', value),
    isUniqueNameEdit: state => (value, id) => uniqueFieldEditMixin(state.items, 'name', value, id),
    isUniqueDisplayName: state => value => uniqueFieldMixin(state.items, 'display_name', value),
    isUniqueDisplayNameEdit: state => (value, id) => uniqueFieldEditMixin(state.items, 'display_name', value, id)
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
};
