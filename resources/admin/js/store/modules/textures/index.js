import { uniqueFieldEditMixin, uniqueFieldMixin } from "../../mixins/getters";

import { axiosAction } from "../../mixins/actions";

const state = {
    fields: {
        name: '',
        price: '',
        width: '',
        thumb_path: '',
        thumb: '',
        sample_path: '',
        sample: '',
        background_path: '',
        background: '',
        publish: '',
        description: ''
    },
    items: []
};

const mutations = {
    UPDATE_ITEMS(state, payload) {
        state.items = payload;
    },
    DELETE_ITEM(state, payload) {
        state.items = state.items.filter(item => item.id !== payload);
    },
    CHANGE_PUBLISH(state, payload) {
        state.items.forEach(item => {
            if(item.id === payload.id) {
                item.publish = payload.publish;
            }
        });
    },
    UPDATE_NAME_FIELD(state, payload) {
        state.fields.name = payload;
    },
    UPDATE_PRICE_FIELD(state, payload) {
        state.fields.price = payload;
    },
    UPDATE_WIDTH_FIELD(state, payload) {
        state.fields.width = payload;
    },
    UPDATE_THUMB_FIELD(state, payload) {
        state.fields.thumb = payload;
    },
    UPDATE_SAMPLE_FIELD(state, payload) {
        state.fields.sample = payload;
    },
    UPDATE_BACKGROUND_FIELD(state, payload) {
        state.fields.background = payload;
    },
    UPDATE_PUBLISH_FIELD(state) {
        state.fields.publish = +!state.fields.publish;
    },
    UPDATE_DESCRIPTION_FIELD(state, payload) {
        state.fields.description = payload === null ? '' : payload;
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
    }
};

const actions = {
    index(context) {
        return axiosAction('get', context, {
            url: '/api/manager/textures',
            thenContent: response => context.commit('UPDATE_ITEMS', response.data)
        })
    },
    show(context, payload) {
        return axiosAction('get', context, {
            url: `/api/manager/textures/${payload}`,
            thenContent: response => context.commit('UPDATE_FIELDS', response.data)
        })
    },
    publish(context, payload) {
        return axiosAction('get', context, {
            url: `/api/manager/textures/${payload}/publish`,
            thenContent: response => context.commit('CHANGE_PUBLISH', response.data)
        })
    },
    store(context, payload) {
        const form = new FormData();
        for (let field in payload) {
            form.append(field, payload[field]);
        }
        return axiosAction('post', context, {
            url: '/api/manager/textures',
            data: form
        })
    },
    update(context, payload) {
        const form = new FormData();
        const images = ['thumb', 'sample', 'background'];
        for(let field in payload.formData) {
            if (!images.includes(field)) {
                form.append(field, payload.formData[field]);
            } else if (payload.formData[field]) {
                form.append(field, payload.formData[field]);
            }
        }
        return axiosAction('post', context, {
            url: `/api/manager/textures/${payload.id}`,
            data: form
        })
    },
    destroy(context, id) {
        return axiosAction('delete', context, {
            url: `/api/manager/textures/${id}`,
            thenContent: response => context.commit('DELETE_ITEM', id)
        })
    },
    updateNameField(context, value) {
        context.commit('UPDATE_NAME_FIELD', value);
    },
    updatePriceField(context, value) {
        context.commit('UPDATE_PRICE_FIELD', value);
    },
    updateWidthField(context, value) {
        context.commit('UPDATE_WIDTH_FIELD', value);
    },
    updateThumbField(context, value) {
        context.commit('UPDATE_THUMB_FIELD', value);
    },
    updateSampleField(context, value) {
        context.commit('UPDATE_SAMPLE_FIELD', value);
    },
    updateBackgroundField(context, value) {
        context.commit('UPDATE_BACKGROUND_FIELD', value);
    },
    updateDescriptionField(context, value) {
        context.commit('UPDATE_DESCRIPTION_FIELD', value);
    },
    updatePublishField(context) {
        context.commit('UPDATE_PUBLISH_FIELD');
    },
    clearFields(context) {
        context.commit('CLEAR_FIELDS');
    }
};

const getters = {
    isUniqueName: state => name => uniqueFieldMixin(state.items, 'name', name),
    isUniqueNameEdit: state => (name, id) => uniqueFieldEditMixin(state.items, 'name', name, id)
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
};
