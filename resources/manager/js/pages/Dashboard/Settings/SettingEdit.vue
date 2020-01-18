<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card class="mt-0">
                    <md-card-content class="md-between">
                        <router-button-link
                            title="В администрирование"
                            :route="redirectRoute.name"
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
            <div class="md-layout-item">
                <md-card>
                    <card-icon-header />
                    <md-card-content>
                        <v-input title="Наименование"
                                 icon="title"
                                 name="display_name"
                                 :value="displayName"
                                 :vField="$v.displayName"
                                 :differ="true"
                                 :module="storeModule"
                                 :vRules="{ required: true, unique: true, minLength: true }" />

                        <v-input title="Ключ"
                                 icon="code"
                                 name="key_name"
                                 :value="keyName"
                                 :vField="$v.keyName"
                                 :vDelay="true"
                                 :differ="true"
                                 :module="storeModule"
                                 :vRules="{ required: true, unique: true, key: true, minLength: true }" />

                        <v-select v-if="settingGroups.length" title="Группа" placeholder="Выберите группу настройки"
                                  name="group_id"
                                  :value="group"
                                  :vField="$v.group"
                                  :differ="true"
                                  :options="settingGroups"
                                  :defaultTitle="defaultGroup.title"
                                  :defaultValue="defaultGroup.value"
                                  :module="storeModule" />

                        <h4 class="card-title mb-0">Тип</h4>
                        <h3 class="mt-0"><small>{{ type }}</small></h3>

                    </md-card-content>
                </md-card>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex'

    import { required, minLength } from 'vuelidate/lib/validators'

    import VSelect from '@/custom_components/VForm/VSelect'
    import { pageTitle } from '@/mixins/base'
    import { updateMethod, deleteMethod } from '@/mixins/crudMethods'

    export default {
        name: 'SettingEdit',
        components: { VSelect },
        mixins: [ pageTitle, updateMethod, deleteMethod ],
        props: {
            id: {
                type: [ Number, String ],
                required: true
            },
        },
        data () {
            return {
                defaultGroup: {
                    title: 'Нет группы',
                    value: 0
                },
                storeModule: 'settings',
                responseData: false,
                controlSaveVisibilities: false,
                redirectRoute: { name: 'manager.settings.administration' }
            }
        },
        validations: {
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
            keyName: {
                required,
                touch: false,
                minLength: minLength(2),
                isUnique (value) {
                    return (value.trim() === '') && !this.$v.keyName.$dirty
                        ? true
                        : !this.isUniqueKeyNameEdit
                },
                testKey (value) {
                    return value.trim() === ''
                        ? true
                        : (/^([a-z0-9]+[_]?)+[a-z0-9]$/).test(value);
                }
            },
            group: {
                touch: false
            }
        },
        computed: {
            ...mapState({
                keyName: state => state.settings.fields.key_name,
                displayName: state => state.settings.fields.display_name,
                type: state => state.settings.fields.type,
                group: state => state.settings.fields.group_id,
                types: state => state.settings.types,
                settingGroups: state => state.settingGroups.items
            }),
            isUniqueKeyNameEdit() {
                return !!this.$store.getters['settings/isUniqueKeyNameEdit'](this.keyName, this.id);
            },
            isUniqueDisplayNameEdit() {
                return !!this.$store.getters['settings/isUniqueDisplayNameEdit'](this.displayName, this.id);
            }
        },
        methods: {
            ...mapActions({
                indexWithTypesAction: 'settings/indexWithTypes',
                showAction: 'settings/show',
                indexGroupsAction: 'settingGroups/index'
            }),
            onUpdate() {
                return this.update({
                    sendData: {
                        formData: {
                            key_name : this.keyName,
                            display_name : this.displayName,
                            group_id : this.group
                        },
                        id: this.id
                    },
                    title: this.displayName,
                    successText: 'Настройка обновлена!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                });
            },

            onDelete () {
                return this.delete({
                    payload: this.id,
                    title: this.displayName,
                    alertText: `настройку «${this.name}»`,
                    successText: 'Настройка удалена!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                })
            },
        },
        created() {
            this.indexWithTypesAction()
                .then(() => this.showAction(this.id))
                .then(() => this.indexGroupsAction())
                .then(() => {
                    if(!this.settingGroups.length) this.$router.push(this.redirectRoute);
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
