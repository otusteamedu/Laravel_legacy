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

                        <v-input title="Имя"
                                 icon="person"
                                 name="name"
                                 :vField="$v.name"
                                 :module="storeModule"
                                 :vRules="{ required: true, minLength: true }" />

                        <v-input title="Email"
                                 icon="mail"
                                 name="email"
                                 :vField="$v.email"
                                 :vDelay="true"
                                 :module="storeModule"
                                 :vRules="{ required: true, unique: true, email: true, minLength: true }" />

                        <v-input title="Пароль"
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

                        <v-switch title="Активен"
                                  :value="publish"
                                  :module="storeModule" />

                    </md-card-content>
                </md-card>
            </div>
            <template v-if="roleList.length">
                <div class="md-layout-item md-medium-size-50 md-small-size-100">
                    <md-card>
                        <card-icon-header icon="business_center" title="Роли" />
                        <md-card-content>

                            <v-select v-if="roleList.length" title="Роль" placeholder="Выберите роль"
                                      name="roles"
                                      :value="roles"
                                      :vField="$v.roles"
                                      :options="roleList"
                                      nameField="display_name"
                                      indexName="name"
                                      :module="storeModule" />
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

    import VSelect from '@/custom_components/VForm/VSelect'

    import { pageTitle } from '@/mixins/base'
    import { createMethod } from '@/mixins/crudMethods'

    import config from '@/config'

    export default {
        name: 'UserCreate',
        components: { VSelect },
        mixins: [ pageTitle,  createMethod ],
        data () {
            return {
                responseData: false,
                redirectRoute: { name: 'manager.users' },
                storeModule: 'users',
                defaultRole: config.DEFAULT_ROLE
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
                indexRolesAction: 'roles/index',
                updateFieldAction: 'users/updateField'
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
            this.clearFieldsAction();
            this.indexAction()
                .then(() => this.indexRolesAction())
                .then(() => {
                    this.updateFieldAction({ field: 'roles', value: this.defaultRole})
                    this.setPageTitle('Новый Пользователь');
                    this.responseData = true;
                })
                .catch(() => this.$router.push(this.redirectRoute));
        }
    }
</script>
