<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card class="mt-0">
                    <md-card-content class="md-between">
                        <router-link :to="redirectRoute">
                            <md-button class="md-info md-just-icon">
                                <md-icon>arrow_back</md-icon>
                                <md-tooltip md-direction="right">В Администрирование</md-tooltip>
                            </md-button>
                        </router-link>
                        <div>
                            <slide-y-down-transition v-if="controlSaveVisibilities && $v.$anyDirty && !$v.$invalid">
                                <md-button class="md-success md-just-icon" @click.native="onUpdate('auto-close')">
                                    <md-icon>check</md-icon>
                                    <md-tooltip md-direction="left">Сохранить</md-tooltip>
                                </md-button>
                            </slide-y-down-transition>
                            <md-button class="md-danger md-just-icon" @click.native="onDelete('auto-close')">
                                <md-icon>delete</md-icon>
                                <md-tooltip md-direction="left">Удалить</md-tooltip>
                            </md-button>
                        </div>
                    </md-card-content>
                </md-card>
            </div>
        </div>
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card>
                    <md-card-header class="md-card-header-icon md-card-header-green">
                        <div class="card-icon">
                            <md-icon>settings</md-icon>
                        </div>
                        <h3 class="title">Установки</h3>
                    </md-card-header>
                    <md-card-content>
                        <vee-input name="Наименование" :vField="$v.displayName" icon="title"
                                   @input="onFieldChange('displayName', $event)"
                                   :value="displayName"
                                   :vRules="{
                                    required: true,
                                    unique: true,
                                    minLength: true
                                }"/>
                        <vee-input name="Ключ" :vField="$v.keyName" icon="code"
                                   @input="onFieldChange('keyName', $event, true)"
                                   :value="keyName"
                                   :vRules="{
                                    required: true,
                                    unique: true,
                                    key: true,
                                    minLength: true
                                }"/>
                        <vee-select title="Группа" placeholder="Выберите группу настройки"
                                    :value="group"
                                    :options="settingGroups"
                                    :defaultValue="defaultGroup"
                                    @selected="onSelectChange('group', $event)" />
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

    import FieldWrap from '@/custom_components/Form/FieldWrap'
    import VeeSelect from '@/custom_components/VeeForm/VeeSelect'
    import { pageTitle } from '@/mixins/base'
    import { changeField, changeSelect } from '@/mixins/changingFields'
    import { updateMethod, deleteMethod } from '@/mixins/crudMethods'
    import { validationDelay } from "@/mixins/validations";

    export default {
        name: 'SettingEdit',
        components: {
            VeeSelect, FieldWrap
        },
        mixins: [ pageTitle, changeField, changeSelect, updateMethod, deleteMethod, validationDelay ],
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
