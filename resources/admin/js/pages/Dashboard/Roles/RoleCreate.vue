<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card>
                    <md-card-content class="md-between">
                        <router-button-link
                            title="К списку ролей"
                            route="manager.roles"
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
                        <vee-input name="Алиас" :vField="$v.name" icon="code"
                                   @input="onFieldChange('name', $event)"
                                   :vRules="{
                                    required: true,
                                    unique: true,
                                    alias: true,
                                    minLength: true
                                }"/>
                        <vee-input name="Имя" :vField="$v.displayName" icon="title"
                                   @input="onFieldChange('displayName', $event)"
                                   :vRules="{
                                    required: true,
                                    unique: true,
                                    minLength: true
                                }"/>
                        <vee-textarea name="Описание" :vField="$v.description"
                                      @input="onFieldChange('description', $event)" />
                        <div class="space-30"></div>
                    </md-card-content>
                </md-card>
            </div>
            <div class="md-layout-item md-medium-size-50 md-small-size-100">
                <md-card>
                    <card-icon-header icon="vpn_key" title="Разрешения" />
                    <md-card-content>
                        <md-switch v-for="permission in permissionList"
                                   :key="permission.id"
                                   :value="permission.id"
                                   v-model="selectedPermissions"
                        >
                            {{ permission.display_name }}
                        </md-switch>
                    </md-card-content>
                </md-card>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex'

    import { required, minLength } from 'vuelidate/lib/validators'

    import { pageTitle } from '@/mixins/base'
    import { changeField } from '@/mixins/changingFields'
    import { createMethod } from '@/mixins/crudMethods'

    export default {
        name: 'RoleCreate',
        mixins: [ pageTitle, changeField, createMethod ],
        data() {
            return {
                responseData: false,
                redirectRoute: { name: 'manager.roles' },
                storeModule: 'roles',
                selectedPermissions: []
            }
        },
        validations: {
            name: {
                required,
                touch: false,
                minLength: minLength(2),
                isUnique (value) {
                    return (value.trim() === '') && !this.$v.name.$dirty
                        ? true
                        : !this.isUniqueName
                },
                testAlias (value) {
                    return value.trim() === ''
                        ? true
                        : (/^([a-z0-9]+[-]?)+[a-z0-9]$/).test(value);
                }
            },
            displayName: {
                required,
                touch: false,
                minLength: minLength(2),
                isUnique (value) {
                    return (value.trim() === '') && !this.$v.displayName.$dirty
                        ? true
                        : !this.isUniqueDisplayName
                }
            },
            description: {
                touch: false
            },
            permissions: {
                touch: false
            }
        },
        computed: {
            ...mapState({
                name: state => state.roles.fields.name,
                displayName: state => state.roles.fields.display_name,
                description: state => state.roles.fields.description,
                permissionList: state => state.permissions.items
            }),
            isUniqueName() {
                return !!this.$store.getters['roles/isUniqueName'](this.name);
            },
            isUniqueDisplayName() {
                return !!this.$store.getters['roles/isUniqueDisplayName'](this.displayName);
            }
        },
        methods: {
            ...mapActions({
                indexAction: 'roles/index',
                clearFieldsAction: 'roles/clearFields',
                indexPermissionsAction: 'permissions/index'
            }),
            onCreate() {
                return this.create({
                    sendData: {
                        name: this.name,
                        display_name: this.displayName,
                        description: this.description,
                        permissions: this.selectedPermissions
                    },
                    title: this.displayName,
                    successText: 'Роль создана!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                })
            }
        },
        created() {
            this.indexAction()
                .then(() => this.indexPermissionsAction())
                .then(() => {
                    this.setPageTitle('Новая Роль');
                    this.clearFieldsAction();
                    this.responseData = true;
                })
                .catch(() => this.$router.push(this.redirectRoute));
        }
    }
</script>
