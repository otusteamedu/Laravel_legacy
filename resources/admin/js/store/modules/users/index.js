import { uniqueFieldEditMixin, uniqueFieldMixin } from "../../mixins/getters";

import { axiosAction } from "../../mixins/actions";

const state = {
    fields: {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        roles: [],
        orders: '',
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
    UPDATE_NAME_FIELD(state, payload) {
        state.fields.name = payload;
    },
    UPDATE_EMAIL_FIELD(state, payload) {
        state.fields.email = payload;
    },
    UPDATE_ROLES_FIELD(state, payload) {
        state.fields.roles = payload;
    },
    UPDATE_PASSWORD_FIELD(state, payload) {
        state.fields.password = payload;
    },
    UPDATE_PASSWORD_CONFIRMATION_FIELD(state, payload) {
        state.fields.password_confirmation = payload;
    },
    UPDATE_PUBLISH_FIELD(state) {
        state.fields.publish = +!state.fields.publish;
    },
    UPDATE_OLD_PASSWORD_FIELD(state, payload) {
        state.fields.old_password = payload;
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
            // if (state.fields[field] instanceof Array) {
            //     state.fields[field] = payload[field]
            //     payload[field].forEach(item => { state.fields[field].push(item.id); });
            // } else {
            //     state.fields[field] = payload[field] === null ? '' : payload[field];
            // }
            state.fields[field] = payload[field] === null ? '' : payload[field];
        }
    },
    DELETE_ITEM(state, payload) {
        state.items = state.items.filter(item => item.id !== payload);
    }
};

const actions = {
    index(context) {
        return axiosAction('get', context, {
            url: '/api/manager/users',
            thenContent: response => context.commit('UPDATE_ITEMS', response.data)
        })
    },
    show(context, payload) {
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
    updateNameField(context, value) {
        context.commit('UPDATE_NAME_FIELD', value);
    },
    updateEmailField(context, value) {
        context.commit('UPDATE_EMAIL_FIELD', value);
    },
    updatePasswordField(context, value) {
        context.commit('UPDATE_PASSWORD_FIELD', value);
    },
    updatePasswordConfirmationField(context, value) {
        context.commit('UPDATE_PASSWORD_CONFIRMATION_FIELD', value);
    },
    updateRolesField(context, value) {
        context.commit('UPDATE_ROLES_FIELD', value);
    },
    updatePublishField(context) {
        context.commit('UPDATE_PUBLISH_FIELD');
    },
    updateOldPasswordField(context, value) {
        context.commit('UPDATE_OLD_PASSWORD_FIELD', value);
    },
    clearFields(context) {
        context.commit('CLEAR_FIELDS');
    },
    // sendPasswordChange(context, payload) {
    //     let form = new FormData();
    //     form.append('password', payload.password);
    //     return axios.post(`/api/manager/users/${payload.id}/password-change`, form)
    //         .then(response => {
    //             console.log(response.data);
    //             context.commit('CLEAR_ERRORS', null, {root: true});
    //         })
    //         .catch(error => {
    //             context.commit('UPDATE_ERRORS', error.response, {root: true});
    //             throw Error;
    //         });
    // }
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
