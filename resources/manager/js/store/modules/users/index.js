import { uniqueFieldEditMixin, uniqueFieldMixin } from "../../mixins/getters";

import { axiosAction } from "../../mixins/actions";

const state = {
    fields: {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        role: null,
        orders: 0,
        publish: 0,
        old_password: ''
    },
    items: []
};

const mutations = {
    UPDATE_ITEMS(state, payload) {
        state.items = payload;
    },
    CHANGE_PUBLISH(state, payload) {
        state.items.forEach(item => {
            if(item.id === payload.id) {
                item.publish = +payload.publish;
            }
        });
    },
    UPDATE_FIELD(state, payload) {
        state.fields[payload.field] = payload.value;
    },
    UPDATE_PUBLISH_FIELD(state) {
        state.fields.publish = +!state.fields.publish;
    },
    CLEAR_FIELDS(state) {
        for(let field in state.fields) {
            if (state.fields[field] instanceof Array) {
                state.fields[field] = [];
            } else if (!isNaN(parseFloat(state.fields[field])) && isFinite(state.fields[field])) {
                state.fields[field] = 0;
            } else {
                state.fields[field] = '';
            }
        }
    },
    UPDATE_FIELDS(state, payload) {
        for(let field in state.fields) {
            state.fields[field] = payload[field] === null ? '' : payload[field];
        }
    },
    DELETE_ITEM(state, payload) {
        state.items = state.items.filter(item => item.id !== payload);
    }
};

const actions = {
    getItems(context) {
        return axiosAction('get', context, {
            url: '/api/manager/users',
            thenContent: response => context.commit('UPDATE_ITEMS', response.data)
        })
    },
    getItem(context, payload) {
        return axiosAction('get', context, {
            url: `/api/manager/users/${payload}`,
            thenContent: response => context.commit('UPDATE_FIELDS', response.data)
        })
    },
    publish(context, payload) {
        return axiosAction('get', context, {
            url: `/api/manager/users/${payload}/publish`,
            thenContent: response => context.commit('CHANGE_PUBLISH', response.data)
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
            url: '/api/manager/users',
            data: form,
            thenContent: response => context.commit('CHANGE_PUBLISH', response.data)
        })
    },
    update(context, payload) {
        const form = new FormData();
        for(let item in payload.formData) {
            form.append(item, payload.formData[item]);
        }
        return axiosAction('post', context, {
            url: `/api/manager/users/${payload.id}`,
            data: form
        })
    },
    destroy(context, id) {
        return axiosAction('delete', context, {
            url: `/api/manager/users/${id}`,
            thenContent: response => {
                context.commit('DELETE_ITEM', id);
                context.commit('DELETE_SEARCHED_DATA_ITEM', id, { root: true })
            }
        })
    },
    updateField(context, payload) {
        context.commit('UPDATE_FIELD', payload);
    },
    updatePublishField(context) {
        context.commit('UPDATE_PUBLISH_FIELD');
    },
    clearFields(context) {
        context.commit('CLEAR_FIELDS');
    }
};

const getters = {
    isUniqueEmail: state => email => uniqueFieldMixin(state.items, 'email', email),
    isUniqueEmailEdit: state => (email, id) => uniqueFieldEditMixin(state.items, 'email', email, id)
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
};
