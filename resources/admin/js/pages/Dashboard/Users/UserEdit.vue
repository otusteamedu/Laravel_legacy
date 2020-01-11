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
                            <control-button title="Удалить" @click="onDelete()" icon="delete" class="md-danger" />
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
                        <vee-input name="Имя" :vField="$v.name" @input="onFieldChange('name', $event)"
                                   :value="name"
                                   :vRules="{
                                        required: true,
                                        minLength: true
                                    }"/>
                        <vee-input name="Email" :vField="$v.email" @input="onFieldChange('email', $event, true)"
                                   :value="email"
                                   :vRules="{
                                        required: true,
                                        email: true,
                                        unique: true
                                    }"/>
                        <h4 class="card-title">Активировать</h4>
                        <md-switch :value="!publish" @change="onPublishChange" />
                    </md-card-content>
                </md-card>
            </div>
            <div class="md-layout-item md-medium-size-50 md-small-size-100">
                <template v-if="roleList.length">
                    <md-card>
                        <card-icon-header icon="business_center" title="Роли" />
                        <md-card-content>
                            <vee-select title="Роли" placeholder="Выберите роль"
                                        :value="roles"
                                        :options="roleList"
                                        nameField="name"
                                        @selected="onSelectChange('roles', $event)" />
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
                            <vee-input name="Действующий пароль" :vField="$v.oldPassword" @input="onFieldChange('oldPassword', $event)"
                                       type="password"
                                       :vRules="{
                                        required: true,
                                        minLength: true
                                    }"/>
                            <vee-input name="Новый пароль" :vField="$v.password" @input="onFieldChange('password', $event)"
                                       type="password"
                                       :vRules="{
                                        required: true,
                                        minLength: true
                                    }"/>
                            <vee-input name="Подтверждене пароля" :vField="$v.passwordConfirmation" @input="onFieldChange('passwordConfirmation', $event)"
                                       type="password"
                                       :vRules="{
                                        sameAsPassword: true
                                    }"/>
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

    import VeeSelect from '@/custom_components/VeeForm/VeeSelect'

    import { pageTitle } from '@/mixins/base'
    import { changeSelect, changeField, changePublishEdit } from '@/mixins/changingFields'
    import { validationDelay } from '@/mixins/validations'
    import { updateMethod, deleteMethod } from '@/mixins/crudMethods'

    export default {
        name: 'UserEdit',
        components: {
            VeeSelect
        },
        mixins: [
            pageTitle,
            changeSelect,
            changeField,
            changePublishEdit,
            validationDelay,
            updateMethod,
            deleteMethod
        ],
        props: {
            id: {
                type: String,
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
                minLength: minLength(6),
                touch: false
            },
            password: {
                required: requiredIf(function () {
                    return this.isPasswordChange
                }),
                touch: false,
                minLength: minLength(6)
            },
            passwordConfirmation: {
                sameAsPassword: sameAs('password')
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
                indexAction: 'users/index',
                showAction: 'users/show',
                showRolesAction: 'roles/index'
            }),
            onChangePassword() {
                this.changePassword = true;
            },
            cancelOldPasswordChange() {
                this.changePassword = false;
                this.onFieldChange('oldPassword', '');
                this.onFieldChange('password', '');
                this.onFieldChange('passwordConfirmation', '');
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
            this.indexAction()
                .then(() => this.showRolesAction())
                .then(() => this.showAction(this.id))
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
