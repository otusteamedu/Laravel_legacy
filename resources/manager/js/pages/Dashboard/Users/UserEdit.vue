<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card>
                    <md-card-content class="md-between">
                        <router-button-link
                            title="К списку пользователей"
                            route="manager.users"
                        />
                        <div>
                            <slide-y-down-transition v-show="controlSaveVisibilities && $v.$anyDirty && !$v.$invalid">
                                <control-button title="Сохранить" @click="onUpdate" />
                            </slide-y-down-transition>
                            <control-button title="Удалить" @click="onDelete" icon="delete" class="md-danger" />
                        </div>
                    </md-card-content>
                </md-card>
            </div>
        </div>
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-50 md-small-size-100">
                <md-card>
                    <card-icon-header />
                    <md-card-content>

                        <v-input title="Имя"
                                 icon="person"
                                 name="name"
                                 :value="name"
                                 :vField="$v.name"
                                 :differ="true"
                                 :module="storeModule"
                                 :vRules="{ required: true, minLength: true }" />

                        <v-input title="Email"
                                 icon="mail"
                                 name="email"
                                 :value="email"
                                 :vField="$v.email"
                                 :differ="true"
                                 :vDelay="true"
                                 :module="storeModule"
                                 :vRules="{ required: true, unique: true, email: true, minLength: true }" />

                        <v-switch title="Активен"
                                  :value="publish"
                                  :vField="$v.publish"
                                  :differ="true"
                                  :module="storeModule" />

                    </md-card-content>
                </md-card>
            </div>
            <div class="md-layout-item md-medium-size-50 md-small-size-100">
                <template v-if="roleList.length">
                    <md-card>
                        <card-icon-header icon="business_center" title="Роли" />
                        <md-card-content>

                            <v-select v-if="roleList.length" title="Роль" placeholder="Выберите роль"
                                      name="roles"
                                      :options="roleList"
                                      :value="roles"
                                      :vField="$v.roles"
                                      :differ="true"
                                      nameField="display_name"
                                      :module="storeModule" />

                        </md-card-content>
                    </md-card>
                    <div class="space-1"></div>
                </template>
                <md-card>
                    <card-icon-header v-if="!changePassword" icon="lock" title="Смена пароля" />
                    <card-icon-header v-else icon="lock_open" title="Смена пароля" color="md-card-header-danger"/>
                    <md-card-content>
                        <md-button v-if="!changePassword" class="md-success" @click.native="onChangePassword">Сменить пароль</md-button>
                        <div class="form-group" v-else>

                            <v-input title="Действующий пароль"
                                     icon="lock"
                                     name="old_password"
                                     type="password"
                                     :vField="$v.oldPassword"
                                     :module="storeModule"
                                     :vRules="{ required: true }" />

                            <v-input title="Новый пароль"
                                     icon="lock"
                                     name="password"
                                     type="password"
                                     :vField="$v.password"
                                     :module="storeModule"
                                     :vRules="{ required: true, minLength: true }" />

                            <v-input title="Подтверждение пароля"
                                     icon="lock"
                                     name="password_confirmation"
                                     type="password"
                                     :vField="$v.passwordConfirmation"
                                     :module="storeModule"
                                     :vRules="{ required: true, sameAsPassword: true }" />

                            <div class="mt-2">
                                <md-button class="md-danger" @click.native="cancelOldPasswordChange">Отменить</md-button>
                            </div>
                        </div>
                    </md-card-content>
                </md-card>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapState} from 'vuex'

    import { required, minLength, sameAs, requiredIf, email } from 'vuelidate/lib/validators'

    import VSelect from '@/custom_components/VForm/VSelect'

    import { pageTitle } from '@/mixins/base'
    import { updateMethod, deleteMethod } from '@/mixins/crudMethods'

    export default {
        name: 'UserEdit',
        components: { VSelect },
        mixins: [
            pageTitle,
            updateMethod,
            deleteMethod
        ],
        props: {
            id: {
                type: [ String, Number ],
                required: true
            }
        },
        data () {
            return {
                responseData: false,
                selectedRoles: [],
                changePassword: false,
                redirectRoute: { name: 'manager.users' },
                storeModule: 'users',
                controlSaveVisibilities: false
            }
        },
        validations: {
            name: {
                required,
                touch: false,
                minLength: minLength(2)
            },
            email: {
                email,
                required,
                touch: false,
                isUnique (value) {
                    return (value.trim() === '') && !this.$v.email.$dirty
                        ? true
                        : !this.isUniqueEmailEdit
                }
            },
            publish: {
                touch: false
            },
            roles: {
                required,
                touch: false
            },
            oldPassword: {
                required: requiredIf(function () {
                    return this.isPasswordChange
                }),
                touch: false
            },
            password: {
                required: requiredIf(function () {
                    return this.isPasswordChange
                }),
                minLength: minLength(6),
                touch: false
            },
            passwordConfirmation: {
                required: requiredIf(function () {
                    return this.isPasswordChange
                }),
                sameAsPassword: sameAs('password'),
                touch: false,
            }
        },
        computed: {
            ...mapState({
                name: state => state.users.fields.name,
                email: state => state.users.fields.email,
                publish: state => state.users.fields.publish,
                roles: state => state.users.fields.roles,
                oldPassword: state => state.users.fields.old_password,
                password: state => state.users.fields.password,
                passwordConfirmation: state => state.users.fields.password_confirmation,
                roleList: state => state.roles.items
            }),
            isUniqueEmailEdit() {
                return !!this.$store.getters['users/isUniqueEmailEdit'](this.email, this.id);
            },
            isPasswordChange() {
                return this.changePassword;
            }
        },
        methods: {
            ...mapActions({
                getItemsAction: 'users/getItems',
                getItemAction: 'users/getItem',
                getRolesAction: 'roles/getItems',
                updateField: 'users/updateField'
            }),
            onChangePassword() {
                this.changePassword = true;
            },
            cancelOldPasswordChange() {
                this.changePassword = false;
                this.updateField('old_password', '');
                this.updateField('password', '');
                this.updateField('password_confirmation', '');
                this.$v.oldPassword.$reset();
                this.$v.password.$reset();
                this.$v.passwordConfirmation.$reset();
            },
            onUpdate() {
                const formData = this.changePassword
                    ? {
                        name: this.name,
                        email: this.email,
                        roles: this.roles,
                        publish: this.publish,
                        password: this.password,
                        old_password: this.oldPassword,
                        password_confirmation: this.passwordConfirmation
                    }
                    : {
                        name: this.name,
                        email: this.email,
                        roles: this.roles,
                        publish: this.publish
                    };
                return this.update({
                    sendData: {
                        formData,
                        id: this.id
                    },
                    title: this.name,
                    successText: 'Пользователь обновлен!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                });
            },
            onDelete() {
                return this.delete({
                    payload: this.id,
                    title: this.name,
                    alertText: `пользователя «${this.name}»`,
                    successText: 'Пользователь удален!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                })
            }
        },
        created() {
            this.getItemsAction()
                .then(() => this.getRolesAction())
                .then(() => this.getItemAction(this.id))
                .then(() => {
                    this.setPageTitle(this.name);
                    this.selectedRoles = this.roles;
                    this.responseData = true;
                })
                .then(() => {
                    this.$v.$reset();
                    this.controlSaveVisibilities = true;
                })
                .catch(() => this.$router.push(this.redirectRoute));
        }
    }
</script>
