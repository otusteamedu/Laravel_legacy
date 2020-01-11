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
                        <vee-input name="Алиас" :vField="$v.name" icon="code"
                                   @input="onFieldChange('name', $event)"
                                   :value="name"
                                   :vRules="{
                                    required: true,
                                    unique: true,
                                    alias: true,
                                    minLength: true
                                }"/>
                        <vee-input name="Имя" :vField="$v.displayName" icon="title"
                                   @input="onFieldChange('displayName', $event)"
                                   :value="displayName"
                                   :vRules="{
                                    required: true,
                                    unique: true,
                                    minLength: true
                                }"/>
                        <vee-textarea name="Описание" :vField="$v.description" :value="description"
                                      @input="onFieldChange('description', $event)" />
                        <div class="space-30"></div>
                    </md-card-content>
                </md-card>
            </div>
            <div class="md-layout-item md-medium-size-50 md-small-size-100">
                <md-card v-if="permissionList">
                    <card-icon-header icon="vpn_key" title="Разрешения" />
                    <md-card-content>
                        <md-switch v-for="permission in permissionList"
                                   :key="permission.id"
                                   :value="permission.id"
                                   v-model="selectedPermissions"
                                   @change="onCheck()"
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
    import { updateMethod, deleteMethod } from '@/mixins/crudMethods'

    export default {
        name: 'RoleEdit',
        mixins: [ pageTitle, changeField, updateMethod, deleteMethod ],
        props: {
            id: {
                type: [ Number, String ],
                required: true
            }
        },
        data() {
            return {
                selectedPermissions: [],
                responseData: false,
                controlSaveVisibilities: false,
                redirectRoute: { name: 'manager.roles' },
                storeModule: 'roles'
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
                        : !this.isUniqueNameEdit
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
                        : !this.isUniqueDisplayNameEdit
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
                permissions: state => state.roles.fields.permissions,
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
                showAction: 'roles/show',
                clearFieldsAction: 'roles/clearFields',
                indexPermissionsAction: 'permissions/index',
            }),
            isDifferPermissions(a, b) {
                return !!a.filter(i => !b.includes(i)).concat(b.filter(i => !a.includes(i))).length;
            },
            onCheck() {
                this.isDifferPermissions(this.permissions, this.selectedPermissions)
                    ? this.$v.permissions.$touch()
                    : this.$v.permissions.$reset()
            },
            onUpdate() {
                return this.update({
                    sendData: {
                        formData: {
                            name: this.name,
                            display_name: this.displayName,
                            description: this.description,
                            permissions: this.selectedPermissions
                        },
                        id: this.id
                    },
                    title: this.displayName,
                    successText: 'Роль обновлена!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                });
            },
            onDelete() {
                return this.delete({
                    payload: this.id,
                    title: this.displayName,
                    alertText: `роль «${this.displayName}»`,
                    successText: 'Роль удалена!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                })
            }
        },
        created() {
            this.indexAction()
                .then(() => this.indexPermissionsAction())
                .then(() => this.showAction(this.id))
                .then(() => {
                    this.setPageTitle(this.displayName);
                    this.selectedPermissions = this.permissions.slice(0);
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
