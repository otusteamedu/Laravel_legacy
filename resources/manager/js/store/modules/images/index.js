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
    searchItems: [],
    fileProgress: 0,
    pagination: {
        per_page: 20,
        total: 0,
        current_page: 1,
        from: 0,
        to: 0,
        sort_by: 'id',
        sort_order: 'asc'
    },
    previousPage: null
};

const mutations = {
    UPDATE_ITEMS(state, payload) {
        state.items = payload;
    },
    SET_PAGINATION(state, payload) {
        for (let field in state.pagination) {
            if (payload[field]) {
                state.pagination[field] = +payload[field];
            }
        }
    },
    RESET_PAGINATION(state, payload) {
        state.pagination = {
            per_page: 20,
            total: 0,
            current_page: 1,
            from: 0,
            to: 0,
            sort_by: 'id',
            sort_order: 'asc'
        }
    },
    SET_PREVIOUS_PAGE(state, payload) {
        state.previousPage = payload;
    },
    UPDATE_PAGINATION_FIELDS(state, payload) {
        for(let field in payload) {
            state.pagination[field] = payload[field];
        }
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
    index(context, payload) {
        const form = new FormData();
        for(let field in payload) {
            form.append(field, payload[field]);
        }

        return axiosAction('post', context, {
            url: '/api/manager/images/paginate',
            data: form,
            thenContent: response => {
                context.commit('SET_PAGINATION', response.data);
                payload['query']
                    ? context.commit('SET_SEARCHED_DATA', response.data.data, { root: true })
                    : context.commit('UPDATE_ITEMS', response.data.data);
            }
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
    store(context, payload) {
        const form = new FormData();
        for(const image of payload.files) {
            form.append('images[]', image);
        }
        for(let field in payload.paginationData) {
            form.append(field, payload.paginationData[field]);
        }

        return axiosAction('post', context, {
            url: '/api/manager/images',
            data: form,
            config: {
                onUploadProgress: (imageUpload) => {
                    context.commit('CHANGE_FILE_PROGRESS', Math.round( ( imageUpload.loaded / imageUpload.total) * 100 ))
                }
            },
            thenContent: response => {
                context.commit('CHANGE_FILE_PROGRESS', 0);
                context.commit('SET_PAGINATION', response.data);
                context.commit('UPDATE_ITEMS', response.data.data);
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
                context.commit('DELETE_SEARCHED_DATA_ITEM', id, { root: true });
            }
        })
    },
    publish(context, itemId) {
        return axiosAction('get', context, {
            url: `/api/manager/images/${itemId}/publish`,
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
    },
    updatePaginationFields(context, payload) {
        context.commit('UPDATE_PAGINATION_FIELDS', payload);
    },
    resetPagination(context) {
        context.commit('RESET_PAGINATION');
    },
    setPreviousPage(context, payload) {
        context.commit('SET_PREVIOUS_PAGE', payload);
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
