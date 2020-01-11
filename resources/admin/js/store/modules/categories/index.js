import { uniqueFieldEditMixin, uniqueFieldMixin } from "../../mixins/getters";

import { axiosAction } from "../../mixins/actions";

const state = {
    fields: {
        type: '',
        title: '',
        alias: '',
        image: '',
        image_path: '',
        publish: '',
        description: '',
        keywords: ''
    },
    item: '',
    items: [],
    selectedImages: []
};

const mutations = {
    UPDATE_ITEMS(state, payload) {
        state.items = payload;
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
    UPDATE_TITLE_FIELD(state, payload) {
        state.fields.title = payload;
    },
    UPDATE_ALIAS_FIELD(state, payload) {
        state.fields.alias = payload;
    },
    UPDATE_IMAGE_FIELD(state, payload) {
        state.fields.image = payload;
    },
    UPDATE_PUBLISH_FIELD(state) {
        state.fields.publish = +!state.fields.publish;
    },
    UPDATE_DESCRIPTION_FIELD(state, payload) {
        state.fields.description = payload === null ? '' : payload;
    },
    UPDATE_KEYWORDS_FIELD(state, payload) {
        state.fields.keywords = payload === null ? '' : payload;
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
    UPDATE_SELECTED_IMAGES(state, payload) {
        state.selectedImages = payload;
    },
    CLEAR_SELECTED_IMAGES(state) {
        state.selectedImages = [];
    }
};

const actions = {
    index(context) {
        return axiosAction('get', context, {
            url: '/api/manager/catalog/categories',
            thenContent: response => context.commit('UPDATE_ITEMS', response.data)
        })
    },
    indexByType(context, category_type) {
        return axiosAction('get', context, {
            url: `/api/manager/catalog/categories/type/${category_type}`,
            thenContent: response => context.commit('UPDATE_ITEMS', response.data)
        })
    },
    show(context, payload) {
        return axiosAction('get', context, {
            url: `/api/manager/catalog/categories/${payload}`,
            thenContent: response => context.commit('UPDATE_FIELDS', response.data)
        })
    },
    showWithImages(context, payload) {
        return axiosAction('get', context, {
            url: `/api/manager/catalog/categories/${payload}/with-images`,
            thenContent: response => {
                context.commit('UPDATE_ITEM', response.data.item);
                context.commit('images/UPDATE_ITEMS', response.data.images, { root: true });
            }
        })
    },
    showWithExcludedImages(context, payload) {
        return axiosAction('get', context, {
            url: `/api/manager/catalog/categories/${payload}/with-excluded-images`,
            thenContent: response => {
                context.commit('UPDATE_ITEM', response.data.item);
                context.commit('images/UPDATE_ITEMS', response.data.images, { root: true });
                context.commit('CLEAR_SELECTED_IMAGES');
            }
        })
    },
    publish(context, payload) {
        return axiosAction('get', context, {
            url: `/api/manager/catalog/categories/${payload}/publish`,
            thenContent: response => context.commit('CHANGE_PUBLISH', response.data)
        })
    },
    store(context, payload) {
        const form = new FormData();
        for(let field in payload) {
            form.append(field, payload[field]);
        }
        return axiosAction('post', context, {
            url: `/api/manager/catalog/categories`,
            data: form
        })
    },
    update(context, payload) {
        const form = new FormData();
        for(let field in payload.formData) {
            if (field !== 'image') {
                form.append(field, payload.formData[field]);
            } else {
                if (payload.formData[field]) {
                    form.append(field, payload.formData[field]);
                }
            }
        }
        return axiosAction('post', context, {
            url: `/api/manager/catalog/categories/${payload.category_id}`,
            data: form
        })
    },
    destroy(context, id) {
        return axiosAction('delete', context, {
            url: `/api/manager/catalog/categories/${id}`,
            thenContent: response => {
                context.commit('DELETE_ITEM', id);
                context.commit('DELETE_SEARCHED_DATA_ITEM', id, { root: true })
            }
        })
    },
    updateTitleField(context, value) {
        context.commit('UPDATE_TITLE_FIELD', value);
    },
    updateAliasField(context, value) {
        context.commit('UPDATE_ALIAS_FIELD', value);
    },
    updateImageField(context, value) {
        context.commit('UPDATE_IMAGE_FIELD', value);
    },
    updatePublishField(context) {
        context.commit('UPDATE_PUBLISH_FIELD');
    },
    updateDescriptionField(context, value) {
        context.commit('UPDATE_DESCRIPTION_FIELD', value);
    },
    updateKeywordsField(context, value) {
        context.commit('UPDATE_KEYWORDS_FIELD', value);
    },
    clearFields(context) {
        context.commit('CLEAR_FIELDS');
    },
    uploadImages(context, payload) {
        const form = new FormData();
        for(let file of payload.files) {
            form.append('images[]', file);
        }
        return axiosAction('post', context, {
            url: `/api/manager/catalog/categories/${payload.category_id}/upload`,
            data: form,
            uploadProgress: {
                onUploadProgress: (imageUpload) => {
                    context.commit('images/CHANGE_FILE_PROGRESS', Math.round((imageUpload.loaded / imageUpload.total) * 100), {root: true});
                }
            },
            thenContent: response => {
                context.commit('images/CHANGE_FILE_PROGRESS', 0, { root: true });
                context.commit('images/UPDATE_ITEMS', response.data, { root: true });
            }
        })
    },
    removeImage(context, payload) {
        return axiosAction('get', context, {
            url: `/api/manager/catalog/categories/${payload.category_id}/images/${payload.image_id}/remove`,
            thenContent: response => context.commit('images/DELETE_ITEM', payload.image_id, { root: true })
        })
    },
    updateSelectedImages(context, value) {
        context.commit('UPDATE_SELECTED_IMAGES', value);
    },
    addSelectedImages(context, payload) {
        return axiosAction('post', context, {
            url: `/api/manager/catalog/categories/${payload.category_id}/images/add`,
            data: payload.selected_images,
            thenContent: response => context.commit('CLEAR_SELECTED_IMAGES')
        })
    },

};

const getters = {
    isUniqueTitle: state => title => uniqueFieldMixin(state.items, 'title', title),
    isUniqueTitleEdit: state => (title, id) => uniqueFieldEditMixin(state.items, 'title', title, id),
    isUniqueAlias: state => title => uniqueFieldMixin(state.items, 'alias', title),
    isUniqueAliasEdit: state => (title, id) => uniqueFieldEditMixin(state.items, 'alias', title, id),
    getItemsByType: state => type => state.items.filter(item => item.type === type)
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
};
