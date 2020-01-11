import { axiosAction } from "../../mixins/actions";

const state = {
    fields: {
        image: '',
        publish: '',
        topics: [],
        colors: [],
        interiors: [],
        tags: [],
        owner_id: '',
        description: ''
    },
    item: {},
    items: [],
    fileProgress: 0
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
    UPDATE_TOPICS_FIELD(state, payload) {
        state.fields.topics = payload;
    },
    UPDATE_COLORS_FIELD(state, payload) {
        state.fields.colors = payload;
    },
    UPDATE_INTERIORS_FIELD(state, payload) {
        state.fields.interiors = payload;
    },
    UPDATE_OWNER_FIELD(state, payload) {
        state.fields.owner_id = payload;
    },
    UPDATE_TAGS_FIELD(state, payload) {
        state.fields.tags = payload;
    },
    UPDATE_DESCRIPTION_FIELD(state, payload) {
        state.fields.description = payload === null ? '' : payload;
    },
    UPDATE_IMAGE_FIELD(state, payload) {
        state.fields.image = payload;
    },
    UPDATE_PUBLISH_FIELD(state) {
        state.fields.publish = +!state.fields.publish;
    },
    CLEAR_FIELDS(state) {
        for(let field in state.fields) {
            if(state.fields[field] instanceof Array) {
                state.fields[field] = [];
            } else if (state.fields[field] instanceof Object) {
                state.fields[field] = {};
            } else {
                state.fields[field] = '';
            }
        }
        state.item = {};
        state.items = [];
    },
    UPDATE_FIELDS(state, payload) {
        for(let field in state.fields) {
            state.fields[field] = payload[field] === null ? '' : payload[field];
        }
    },
    CHANGE_FILE_PROGRESS(state, payload) {
        state.fileProgress = payload;
    }
};

const actions = {
    index(context) {
        return axiosAction('get', context, {
            url: '/api/manager/images',
            thenContent: response => context.commit('UPDATE_ITEMS', response.data)
        })
    },
    show(context, id) {
        return axiosAction('get', context, {
            url: `/api/manager/images/${id}`,
            thenContent: response => {
                context.commit('UPDATE_ITEM', response.data);
                context.commit('UPDATE_FIELDS', response.data);
            }
        })
    },
    store(context, images) {
        const form = new FormData();
        for(let image of images) {
            form.append('images[]', image);
        }
        return axiosAction('post', context, {
            url: '/api/manager/images',
            data: form,
            uploadProgress: {
                onUploadProgress: (imageUpload) => {
                    context.commit('CHANGE_FILE_PROGRESS', Math.round( ( imageUpload.loaded / imageUpload.total) * 100 ))
                }
            },
            thenContent: response => {
                context.commit('CHANGE_FILE_PROGRESS', 0);
                context.commit('UPDATE_ITEMS', response.data);
            }
        })
    },
    update(context, payload) {
        const form = new FormData();
        const fields = payload.formData;
        for(let field in fields) {
            if (fields[field] instanceof Array) {
                for(let value of fields[field]) {
                    form.append(`${field}[]`, value);
                }
            } else if (field !== 'image') {
                form.append(field, fields[field]);
            }
            if (field === 'image' && fields[field]) {
                form.append(field, fields[field]);
            }
        }
        return axiosAction('post', context, {
            url: `/api/manager/images/${payload.id}`,
            data: form
        })
    },
    destroy(context, id) {
        return axiosAction('delete', context, {
            url: `/api/manager/images/${id}`,
            thenContent: response => {
                context.commit('DELETE_ITEM', id);
                context.commit('DELETE_SEARCHED_DATA_ITEM', id, { root: true })
            }
        })
    },
    publish(context, itemId) {
        return axiosAction('get', context, {
            url: `/api/manager/images/${itemId}/publish`,
            thenContent: response => context.commit('CHANGE_PUBLISH', response.data)
        })
    },
    updatePublishField(context) {
        context.commit('UPDATE_PUBLISH_FIELD');
    },
    updateTopicsField(context, value) {
        context.commit('UPDATE_TOPICS_FIELD', value);
    },
    updateColorsField(context, value) {
        context.commit('UPDATE_COLORS_FIELD', value);
    },
    updateInteriorsField(context, value) {
        context.commit('UPDATE_INTERIORS_FIELD', value);
    },
    updateOwnerField(context, value) {
        context.commit('UPDATE_OWNER_FIELD', value);
    },
    updateTagsField(context, value) {
        context.commit('UPDATE_TAGS_FIELD', value);
    },
    updateDescriptionField(context, value) {
        context.commit('UPDATE_DESCRIPTION_FIELD', value);
    },
    updateImageField(context, value) {
        context.commit('UPDATE_IMAGE_FIELD', value);
    },
    clearFields(context) {
        context.commit('CLEAR_FIELDS');
    }
};

const getters = {
    fileProgress: state => state.fileProgress
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
};
