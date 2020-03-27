import { uniqueFieldEditMixin, uniqueFieldMixin } from "../../mixins/getters";

import { axiosAction } from "../../mixins/actions";

const state = {
    fields: {
        title: '',
        publish: '',
        description: ''
    },
    item: '',
    items: [],
    itemsByType: {
        tags: [],
        owners: []
    }
};

const mutations = {
    UPDATE_ITEMS(state, payload) {
        state.items = payload;
    },
    UPDATE_ITEMS_BY_TYPE(state, payload) {
        state.itemsByType[payload.type] = payload.items;
    },
    UPDATE_ITEM(state, payload) {
        state.item = payload;
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
    UPDATE_FIELD(state, payload) {
        state.fields[payload.field] = payload.value;
    },
    UPDATE_PUBLISH_FIELD(state) {
        state.fields.publish = +!state.fields.publish;
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
    index(context, category_type) {
        return axiosAction('get', context, {
            url: `/api/manager/catalog/${category_type}`,
            thenContent: response => context.commit('UPDATE_ITEMS', response.data)
        })
    },
    indexByType(context, category_type) {
        return axiosAction('get', context, {
            url: `/api/manager/catalog/${category_type}`,
            thenContent: response => context.commit('UPDATE_ITEMS_BY_TYPE', {
                items: response.data,
                type: category_type
            })
        })
    },
    show(context, payload) {
        return axiosAction('get', context, {
            url: `/api/manager/catalog/${payload.type}/${payload.id}`,
            thenContent: response => context.commit('UPDATE_FIELDS', response.data)
        })
    },
    showWithImages(context, payload) {
        return axiosAction('get', context, {
            url: `/api/manager/catalog/${payload.type}/${payload.id}/with-images`,
            thenContent: response => {
                context.commit('UPDATE_ITEM', response.data.item);
                context.commit('images/UPDATE_ITEMS', response.data.images, { root: true });
            }
        })
    },
    showWithExcludedImages(context, payload) {
        return axiosAction('get', context, {
            url: `/api/manager/catalog/${payload.type}/${payload.id}/with-excluded-images`,
            thenContent: response => {
                context.commit('UPDATE_ITEM', response.data.item);
                context.commit('images/UPDATE_ITEMS', response.data.images, { root: true });
            }
        })
    },
    publish(context, payload) {
        return axiosAction('get', context, {
            url: `/api/manager/catalog/${payload.type}/${payload.id}/publish`,
            thenContent: response => context.commit('CHANGE_PUBLISH', response.data)
        })
    },
    store(context, payload) {
        const form = new FormData();
        for(let field in payload.formData) {
            form.append(field, payload.formData[field]);
        }
        return axiosAction('post', context, {
            url: `/api/manager/catalog/${payload.type}`,
            data: form
        })
    },
    update(context, payload) {
        let form = new FormData();
        for(let field in payload.formData) {
            form.append(field, payload.formData[field]);
        }
        return axiosAction('post', context, {
            url: `/api/manager/catalog/${payload.type}/${payload.id}`,
            data: form
        })
    },
    destroy(context, payload) {
        return axiosAction('delete', context, {
            url: `/api/manager/catalog/${payload.type}/${payload.id}`,
            thenContent: response => {
                context.commit('DELETE_ITEM', payload.id);
                context.commit('DELETE_SEARCHED_DATA_ITEM', payload.id, { root: true });
            }
        })
    },
    uploadImages(context, payload) {
        let form = new FormData();
        for(let file of payload.files) {
            form.append('images[]', file);
        }
        return axiosAction('post', context, {
            url: `/api/manager/catalog/${payload.type}/${payload.id}/upload`,
            data: form,
            thenContent: response => {
                context.commit('images/CHANGE_FILE_PROGRESS', 0, { root: true });
                context.commit('images/UPDATE_ITEMS', response.data, { root: true });
            }
        })
    },
    removeImage(context, payload) {
        return axiosAction('get', context, {
            url: `/api/manager/catalog/${payload.type}/${payload.id}/images/${payload.image_id}/remove`,
            thenContent: response => context.commit('images/DELETE_ITEM', payload.image_id, { root: true })
        })
    },
    addSelectedImages(context, payload) {
        return axiosAction('post', context, {
            url: `/api/manager/catalog/${payload.type}/${payload.id}/images/add`,
            data: payload.selected_images
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
    isUniqueTitle: state => title => uniqueFieldMixin(state.items, 'title', title),
    isUniqueTitleEdit: state => (title, id) => uniqueFieldEditMixin(state.items, 'title', title, id)
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
};
