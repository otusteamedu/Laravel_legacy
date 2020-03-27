<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card>
                    <md-card-content class="md-between">
                        <router-button-link
                            title="К списку привилегий"
                            route="manager.permissions"
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
                                 icon="title"
                                 name="display_name"
                                 :vField="$v.displayName"
                                 :module="storeModule"
                                 :vRules="{ required: true, unique: true, minLength: true }" />

                        <v-input title="Алиас"
                                 icon="code"
                                 name="name"
                                 :vField="$v.name"
                                 :module="storeModule"
                                 :vRules="{ required: true, unique: true, alias: true, minLength: true }" />

                        <div class="space-30"></div>
                    </md-card-content>
                </md-card>
            </div>
            <div class="md-layout-item md-medium-size-50 md-small-size-100">
                <md-card>
                    <md-card-header class="md-card-header-icon md-card-header-green">
                    </md-card-header>
                    <md-card-content>

                        <v-textarea name="description"
                                    :vField="$v.description"
                                    :module="storeModule" />

                        <div class="space-30"></div>

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
    import { createMethod } from '@/mixins/crudMethods'

    export default {
        name: 'PermissionCreate',
        mixins: [ pageTitle, createMethod ],
        data() {
            return {
                responseData: false,
                redirectRoute: { name: 'manager.permissions' },
                storeModule: 'permissions'
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
            }
        },
        computed: {
            ...mapState('permissions', {
                name: state => state.fields.name,
                displayName: state => state.fields.display_name,
                description: state => state.fields.description
            }),
            isUniqueName() {
                return !!this.$store.getters['permissions/isUniqueName'](this.name);
            },
            isUniqueDisplayName() {
                return !!this.$store.getters['permissions/isUniqueDisplayName'](this.displayName);
            }
        },
        methods: {
            ...mapActions('permissions', {
                indexAction: 'index',
                clearFieldsAction: 'clearFields',
            }),
            onCreate() {
                return this.create({
                    sendData: {
                        name: this.name,
                        display_name: this.displayName,
                        description: this.description
                    },
                    title: this.displayName,
                    successText: 'Привилегия создана!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                })
            }
        },
        created() {
            this.indexAction()
                .then(() => {
                    this.setPageTitle('Новая Привилегия');
                    this.clearFieldsAction();
                    this.responseData = true;
                })
                .catch(() => this.$router.push(this.redirectRoute));
        }
    }
</script>
