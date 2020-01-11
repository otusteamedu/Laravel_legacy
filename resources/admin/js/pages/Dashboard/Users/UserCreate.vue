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
                        <slide-y-down-transition v-show="!$v.$invalid">
                            <control-button @click="onCreate('auto-close')" />
                        </slide-y-down-transition>
                    </md-card-content>
                </md-card>
            </div>
        </div>
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-50 md-small-size-100">
                <md-card>
                    <card-icon-header />
                    <md-card-content>
                        <vee-input name="Имя" :vField="$v.name" icon="person"
                                   @input="onFieldChange('name', $event)"
                                   :vRules="{
                                        required: true,
                                        minLength: true
                                    }"/>
                        <vee-input name="Email" :vField="$v.email" icon="mail" type="email"
                                   @input="onFieldChange('email', $event, true)"
                                   :vRules="{
                                        required: true,
                                        unique: true,
                                        email: true
                                    }"/>
                        <vee-input name="Пароль" :vField="$v.password" icon="lock" type="password"
                                   @input="onFieldChange('password', $event)"
                                   :vRules="{
                                        required: true,
                                        minLength: true
                                    }"/>
                        <vee-input name="Подтвердить пароль" :vField="$v.passwordConfirmation" icon="lock" type="password"
                                   @input="onFieldChange('passwordConfirmation', $event)"
                                   :vRules="{
                                        sameAsPassword: true
                                    }"/>
                        <h4 class="card-title">Активен</h4>
                        <md-switch :value="!publish" @change="onPublishChange" />
                    </md-card-content>
                </md-card>
            </div>
            <template v-if="roleList.length">
                <div class="md-layout-item md-medium-size-50 md-small-size-100">
                    <md-card>
                        <card-icon-header icon="business_center" title="Роли" />
                        <md-card-content>
                            <vee-select title="Роли" placeholder="Выберите роль"
                                        :options="roleList"
                                        nameField="name"
                                        @selected="onSelectChange('roles', $event)" />
                        </md-card-content>
                    </md-card>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex'

    import { required, sameAs, minLength, email } from 'vuelidate/lib/validators'

    import VeeSelect from '@/custom_components/VeeForm/VeeSelect'

    import { pageTitle } from '@/mixins/base'
    import { changeSelect, changeField, changePublish } from '@/mixins/changingFields'
    import { validationDelay } from '@/mixins/validations'
    import { createMethod } from '@/mixins/crudMethods'

    export default {
        name: 'UserCreate',
        components: {
            VeeSelect
        },
        mixins: [
            pageTitle,
            changeSelect,
            changeField,
            changePublish,
            validationDelay,
            createMethod
        ],
        data () {
            return {
                responseData: false,
                selectedRoles: [],
                redirectRoute: { name: 'manager.users' },
                storeModule: 'users',
            }
        },
        validations: {
            name: {
                required,
                touch: false,
                minLength: minLength(2)
            },
            email: {
                required,
                email,
                touch: false,
                isUnique (value) {
                    return (value.trim() === '') && !this.$v.email.$dirty
                        ? true
                        : !this.isUniqueEmail
                }
            },
            password: {
                required,
                touch: false,
                minLength: minLength(6)
            },
            passwordConfirmation: {
                required,
                sameAsPassword: sameAs('password'),
                touch: false
            },
            roles: {
                required,
                touch: false
            }
        },
        computed: {
            ...mapState({
                name: state => state.users.fields.name,
                email: state => state.users.fields.email,
                publish: state => state.users.fields.publish,
                roles: state => state.users.fields.roles,
                password: state => state.users.fields.password,
                passwordConfirmation: state => state.users.fields.password_confirmation,
                roleList: state => state.roles.items
            }),
            isUniqueEmail() {
                return !!this.$store.getters['users/isUniqueEmail'](this.email);
            }
        },
        methods: {
            ...mapActions({
                indexAction: 'users/index',
                clearFieldsAction: 'users/clearFields',
                showRolesAction: 'roles/index'
            }),
            onCreate() {
                return this.create({
                    sendData: {
                        name: this.name,
                        email: this.email,
                        password: this.password,
                        password_confirmation: this.passwordConfirmation,
                        publish: this.publish,
                        roles: this.roles
                    },
                    title: this.name,
                    successText: 'Пользователь создан!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                })
            }
        },
        created() {
            this.indexAction()
                .then(() => this.showRolesAction())
                .then(() => {
                    this.setPageTitle('Новый Пользователь');
                    this.clearFieldsAction();
                    this.responseData = true;
                })
                .catch(() => this.$router.push(this.redirectRoute));

        }
    }
</script>
