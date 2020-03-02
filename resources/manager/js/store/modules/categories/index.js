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
    items: []
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
    showImages(context, payload) {
        const form = new FormData();
        for(let field in payload.data) {
            form.append(field, payload.data[field]);
        }

        return axiosAction('post', context, {
            url: `/api/manager/catalog/categories/${payload.id}/images`,
            data: form,
            thenContent: response => {
                context.commit('images/SET_PAGINATION', response.data, { root: true });
                payload.data['query']
                    ? context.commit('SET_SEARCHED_DATA', response.data.data, { root: true })
                    : context.commit('images/UPDATE_ITEMS', response.data.data, { root: true });
            }
        })
    },
    showWithImages(context, payload) {
        const form = new FormData();
        for(let field in payload.data) {
            form.append(field, payload.data[field]);
        }
        return axiosAction('post', context, {
            url: `/api/manager/catalog/categories/${payload.id}/with-images`,
            data: form,
            thenContent: response => {
                context.commit('images/SET_PAGINATION', response.data['paginateData'], { root: true });
                context.commit('UPDATE_ITEM', response.data.item);
                context.commit('images/UPDATE_ITEMS', response.data['paginateData'].data, { root: true });
            }
        })
    },
    // showQuerySearchImages(context, payload) {
    //     const form = new FormData();
    //     for(let field in payload.data) {
    //         form.append(field, payload.data[field]);
    //     }
    //
    //     return axiosAction('post', context, {
    //         url: `/api/manager/catalog/categories/${payload.id}/images/search`,
    //         data: form,
    //         thenContent: response => {
    //             context.commit('images/SET_PAGINATION', response.data, { root: true });
    //             context.commit('SET_SEARCHED_DATA', response.data.data, { root: true });
    //         }
    //     })
    // },
    showExcludedImages(context, payload) {
        const form = new FormData();

        for(let field in payload.data) {
            form.append(field, payload.data[field]);
        }

        return axiosAction('post', context, {
            url: `/api/manager/catalog/categories/${payload.id}/images/excluded`,
            data: form,
            thenContent: response => {
                context.commit('images/SET_PAGINATION', response.data, { root: true });
                payload.data['query']
                    ? context.commit('SET_SEARCHED_DATA', response.data.data, { root: true })
                    : context.commit('images/UPDATE_ITEMS', response.data.data, { root: true });
            }
        })
    },
    showWithExcludedImages(context, payload) {
        const form = new FormData();

        for(let field in payload.data) {
            form.append(field, payload.data[field]);
        }

        return axiosAction('post', context, {
            url: `/api/manager/catalog/categories/${payload.id}/with-excluded-images`,
            data: form,
            thenContent: response => {
                context.commit('images/SET_PAGINATION', response.data['paginateData'], { root: true });
                context.commit('UPDATE_ITEM', response.data.item);
                context.commit('images/UPDATE_ITEMS', response.data['paginateData'].data, { root: true });
            }
        })
    },
    // showQuerySearchExcludedImages(context, payload) {
    //     const form = new FormData();
    //
    //     for(let field in payload.data) {
    //         form.append(field, payload.data[field]);
    //     }
    //
    //     return axiosAction('post', context, {
    //         url: `/api/manager/catalog/categories/${payload.id}/images/excluded/search`,
    //         data: form,
    //         thenContent: response => {
    //             context.commit('images/SET_PAGINATION', response.data, { root: true });
    //             context.commit('SET_SEARCHED_DATA', response.data.data, { root: true });
    //         }
    //     })
    // },
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
    uploadImages(context, payload) {
        const form = new FormData();
        for(let file of payload.files) {
            form.append('images[]', file);
        }
        for(let field in payload.paginationData) {
            form.append(field, payload.paginationData[field]);
        }

        return axiosAction('post', context, {
            url: `/api/manager/catalog/categories/${payload.id}/upload`,
            data: form,
            config: {
                onUploadProgress: (imageUpload) => {
                    context.commit('images/CHANGE_FILE_PROGRESS', Math.round((imageUpload.loaded / imageUpload.total) * 100), {root: true});
                }
            },
            thenContent: response => {
                context.commit('images/CHANGE_FILE_PROGRESS', 0, { root: true });
                context.commit('images/SET_PAGINATION', response.data, { root: true });
                context.commit('images/UPDATE_ITEMS', response.data.data, { root: true });
            }
        })
    },
    removeImage(context, payload) {
        const form = new FormData();
        for(let field in payload.paginationData) {
            form.append(field, payload.paginationData[field]);
        }

        return axiosAction('post', context, {
            url: `/api/manager/catalog/categories/${payload.category_id}/images/${payload.image_id}/remove`,
            data: form,
            thenContent: response => {
                context.commit('images/SET_PAGINATION', response.data, { root: true });
                payload.paginationData['query']
                    ? context.commit('SET_SEARCHED_DATA', response.data.data, { root: true })
                    : context.commit('images/UPDATE_ITEMS', response.data.data, { root: true });
            }
        })
    },
    addSelectedImages(context, payload) {
        return axiosAction('post', context, {
            url: `/api/manager/catalog/categories/${payload.category_id}/images/add`,
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
