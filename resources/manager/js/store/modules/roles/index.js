import { uniqueFieldEditMixin, uniqueFieldMixin } from "../../mixins/getters";

import { axiosAction } from "../../mixins/actions";

const state = {
    fields: {
        name: '',
        display_name: '',
        description: '',
        permissions: []
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
            if (state.fields[field] instanceof Array) {
                state.fields[field] = [];
            } else {
                state.fields[field] = '';
            }
        }
    },
    UPDATE_FIELDS(state, payload) {
        for(let field in state.fields) {
            if (payload[field]) {
                if (state.fields[field] instanceof Array && payload[field] instanceof Array) {
                    payload[field].forEach(fieldItem => {
                        state.fields[field].push(fieldItem);
                    });
                } else {
                    state.fields[field] = payload[field];
                }
            }
        }
    },
};

const actions = {
    getItems(context) {
        return axiosAction('get', context, {
            url: '/api/manager/roles',
            thenContent: response => context.commit('UPDATE_ITEMS', response.data)
        })
    },
    getItem(context, id) {
        return axiosAction('get', context, {
            url: `/api/manager/roles/${id}`,
            thenContent: response => context.commit('UPDATE_FIELDS', response.data)
        })
    },
    store(context, payload) {
        const form = new FormData();
        for(let item in payload) {
            if (payload[item] instanceof Array) {
                for(let data of payload[item]) {
                    form.append(`${item}[]`, data);
                }
            } else {
                form.append(item, payload[item]);
            }
        }
        return axiosAction('post', context, {
            url: '/api/manager/roles',
            data: form
        })
    },
    update(context, payload) {
        const form = new FormData();
        for(let item in payload.formData) {
            if (payload.formData[item] instanceof Array) {
                for(let data of payload.formData[item]) {
                    form.append(`${item}[]`, data);
                }
            } else {
                form.append(item, payload.formData[item]);
            }
        }
        return axiosAction('post', context, {
            url: `/api/manager/roles/${payload.id}`,
            data: form
        })
    },
    destroy(context, id) {
        return axiosAction('delete', context, {
            url: `/api/manager/roles/${id}`,
            thenContent: response => context.commit('DELETE_ITEM', id)
        })
    },
    updateField(context, payload) {
        context.commit('UPDATE_FIELD', payload);
    },
    clearFields(context) {
        context.commit('CLEAR_FIELDS');
    },
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
