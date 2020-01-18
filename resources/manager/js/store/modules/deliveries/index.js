import { uniqueFieldEditMixin, uniqueFieldMixin } from "../../mixins/getters";

import { axiosAction } from "../../mixins/actions";

const state = {
    fields: {
        title: '',
        cost: '',
        publish: '',
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
    UPDATE_PUBLISH_FIELD(state) {
        state.fields.publish = +!state.fields.publish;
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
    CHANGE_PUBLISH(state, payload) {
        state.items.forEach(item => {
            if(item.id === payload.id) {
                item.publish = payload.publish;
            }
        });
    }
};

const actions = {
    index(context) {
        return axiosAction('get', context, {
            url: '/api/manager/store/deliveries',
            thenContent: response => context.commit('UPDATE_ITEMS', response.data)
        })
    },
    show(context, id) {
        return axiosAction('get', context, {
            url: `/api/manager/store/deliveries/${id}`,
            thenContent: response => context.commit('UPDATE_FIELDS', response.data)
        })
    },
    store(context, payload) {
        const form = new FormData();
        for(let item in payload) {
            form.append(item, payload[item]);
        }
        return axiosAction('post', context, {
            url: '/api/manager/store/deliveries',
            data: form
        })
    },
    update(context, payload) {
        const form = new FormData();
        for(let item in payload.formData) {
            form.append(item, payload.formData[item]);
        }
        return axiosAction('post', context, {
            url: `/api/manager/store/deliveries/${payload.id}`,
            data: form
        })
    },
    destroy(context, id) {
        return axiosAction('delete', context, {
            url: `/api/manager/store/deliveries/${id}`,
            thenContent: response => context.commit('DELETE_ITEM', id)
        })
    },
    publish(context, id) {
        return axiosAction('get', context, {
            url: `/api/manager/store/deliveries/${id}/publish`,
            thenContent: response => context.commit('CHANGE_PUBLISH', response.data)

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
    isUniqueTitle: state => value => uniqueFieldMixin(state.items, 'title', value),
    isUniqueTitleEdit: state => (value, id) => uniqueFieldEditMixin(state.items, 'title', value, id),
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
};
