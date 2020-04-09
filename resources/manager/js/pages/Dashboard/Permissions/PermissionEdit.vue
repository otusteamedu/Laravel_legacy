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

                        <v-input title="Имя"
                                 icon="title"
                                 name="display_name"
                                 :vField="$v.displayName"
                                 :differ="true"
                                 :value="displayName"
                                 :module="storeModule"
                                 :vRules="{ required: true, unique: true, minLength: true }" />

                        <v-input title="Алиас"
                                 icon="code"
                                 name="name"
                                 :vField="$v.name"
                                 :differ="true"
                                 :value="name"
                                 :module="storeModule"
                                 :vRules="{ required: true, unique: true, alias: true, minLength: true }" />

                        <div class="space-30"></div>
                    </md-card-content>
                </md-card>
            </div>
            <div class="md-layout-item md-medium-size-50 md-small-size-100">
                <md-card>
                    <md-card-content>
                        <v-textarea name="description"
                                    :vField="$v.description"
                                    :differ="true"
                                    :value="description"
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
    import { updateMethod, deleteMethod } from '@/mixins/crudMethods'

    export default {
        name: 'PermissionEdit',
        mixins: [pageTitle, updateMethod, deleteMethod],
        props: {
            id: {
                type: [ Number, String ],
                required: true
            }
        },
        data() {
            return {
                responseData: false,
                controlSaveVisibilities: false,
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
            }
        },
        computed: {
            ...mapState('permissions', {
                name: state => state.fields.name,
                displayName: state => state.fields.display_name,
                description: state => state.fields.description
            }),
            isUniqueNameEdit() {
                return !!this.$store.getters['permissions/isUniqueNameEdit'](this.name, this.id);
            },
            isUniqueDisplayNameEdit() {
                return !!this.$store.getters['permissions/isUniqueDisplayNameEdit'](this.displayName, this.id);
            }
        },
        methods: {
            ...mapActions('permissions', {
                getItemsAction: 'getItems',
                getItemAction: 'getItem'
            }),
            onUpdate() {
                return this.update({
                    sendData: {
                        formData: {
                            name: this.name,
                            display_name: this.displayName,
                            description: this.description
                        },
                        id: this.id
                    },
                    title: this.displayName,
                    successText: 'Привилегия обновлена!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                });
            },
            onDelete() {
                return this.delete({
                    payload: this.id,
                    title: this.displayName,
                    alertText: `привилегию «${this.displayName}»`,
                    successText: 'Привилегия удалена!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                })
            }
        },
        created() {
            this.getItemsAction()
                .then(() => this.getItemAction(this.id))
                .then(() => {
                    this.setPageTitle(this.displayName);
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
