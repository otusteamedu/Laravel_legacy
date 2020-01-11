import { uniqueFieldEditMixin, uniqueFieldMixin } from "../../mixins/getters";

import { axiosAction } from "../../mixins/actions";

const state = {
    fields: {
        key_name: '',
        display_name: '',
        type: '',
        group_id: ''
    },
    types: [],
    items: []
};

const mutations = {
    UPDATE_ITEMS(state, payload) {
        state.items = payload;
    },
    UPDATE_ITEM(state, payload) {
        state.items.forEach((item) => {
            if (item.key_name === payload.key_name) {
                item.value = payload.value;
            }
        })
    },
    DELETE_ITEM(state, payload) {
        state.items = state.items.filter(item => item.id !== payload);
    },
    UPDATE_KEY_NAME_FIELD(state, payload) {
        state.fields.key_name = payload;
    },
    UPDATE_DISPLAY_NAME_FIELD(state, payload) {
        state.fields.display_name = payload;
    },
    UPDATE_TYPE_FIELD(state, payload) {
        state.fields.type = payload;
    },
    UPDATE_GROUP_FIELD(state, payload) {
        state.fields.group_id = payload;
    },
    CLEAR_FIELDS(state) {
        for(let field in state.fields) {
            state.fields[field] = '';
        }
    },
    SET_ITEM_FIELDS(state, payload) {
        for(let item of state.items) {
            if(item.id == payload) {
                for(let field in state.fields) {
                    state.fields[field] = item[field] === null ? '' : item[field];
                }
            }
        }
    },
    UPDATE_FIELDS(state, payload) {
        for(let field in state.fields) {
            state.fields[field] = payload[field] === null ? '' : payload[field];
        }
    },
    UPDATE_TYPES(state, payload) {
        state.types = payload;
    }
};

const actions = {
    index(context) {
        return axiosAction('get', context, {
            url: '/api/manager/settings',
            thenContent: response => context.commit('UPDATE_ITEMS', response.data)
        })
    },
    indexWithGroup(context) {
        return axiosAction('get', context, {
            url: '/api/manager/settings/with-group',
            thenContent: response => context.commit('UPDATE_ITEMS', response.data)
        })
    },
    indexWithTypes(context) {
        return axiosAction('get', context, {
            url: '/api/manager/settings/with-types',
            thenContent: response => {
                context.commit('UPDATE_ITEMS', response.data.items);
                context.commit('UPDATE_TYPES', response.data.types);
            }
        })
    },
    show(context, id) {
        return axiosAction('get', context, {
            url: `/api/manager/settings/${id}`,
            thenContent: response => {
                context.commit('UPDATE_FIELDS', response.data.item);
                context.commit('UPDATE_TYPES', response.data.types);
            }
        })
    },
    store(context, payload) {
        const form = new FormData();
        for(let field in payload) {
            form.append(field, payload[field]);
        }
        return axiosAction('post', context, {
            url: '/api/manager/settings',
            data: form
        })
    },
    update(context, payload) {
        const form = new FormData();
        for(let field in payload.formData) {
            form.append(field, payload.formData[field]);
        }
        return axiosAction('post', context, {
            url: `/api/manager/settings/${payload.id}`,
            data: form
        })
    },
    set(context, payload) {
        const form = new FormData();
        for(let field in payload) {
            form.append(field, payload[field]);
        }
        return axios.post('/api/manager/settings/set', form)
            .then(() => {
                context.commit('UPDATE_ITEM', payload);
                context.commit('CLEAR_ERRORS', null, {root: true});
            })
            .catch(error => {
                context.commit('UPDATE_ERRORS', error.response, {root: true});
                throw Error;
            });
    },
    destroy(context, id) {
        return axiosAction('delete', context, {
            url: `/api/manager/settings/${id}`,
            thenContent: response => context.commit('DELETE_ITEM', id)
        })
    },
    setItemFields(context, itemId) {
        return context.commit('SET_ITEM_FIELDS', itemId);
    },
    setImageValue(context, payload) {
        const form = new FormData();
        for(let field in payload) {
            form.append(field, payload[field]);
        }

        return axiosAction('post', context, {
            url: `/api/manager/settings/set-image`,
            data: form
        })
    },
    setTextValue(context, payload) {
        const form = new FormData();
        for(let field in payload) {
            form.append(field, payload[field]);
        }

        return axiosAction('post', context, {
            url: `/api/manager/settings/set-text`,
            data: form
        })
    },
    updateKeyNameField(context, value) {
        context.commit('UPDATE_KEY_NAME_FIELD', value);
    },
    updateDisplayNameField(context, value) {
        context.commit('UPDATE_DISPLAY_NAME_FIELD', value);
    },
    updateTypeField(context, value) {
        context.commit('UPDATE_TYPE_FIELD', value);
    },
    updateGroupField(context, value) {
        context.commit('UPDATE_GROUP_FIELD', value);
    },
    clearFields(context) {
        context.commit('CLEAR_FIELDS');
    }
};

const getters = {
    isUniqueKeyName: state => value => uniqueFieldMixin(state.items, 'key_name', value),
    isUniqueKeyNameEdit: state => (value, id) => uniqueFieldEditMixin(state.items, 'key_name', value, id),
    isUniqueDisplayName: state => value => uniqueFieldMixin(state.items, 'display_name', value),
    isUniqueDisplayNameEdit: state => (value, id) => uniqueFieldEditMixin(state.items, 'display_name', value, id),
    firstTypeName: state => state.types.slice(0, 1)[0] ? state.types.slice(0, 1)[0].name : ''
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
};
