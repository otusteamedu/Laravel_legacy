<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card class="mt-0">
                    <md-card-content class="md-between">
                        <router-button-link
                            title="В администрирование"
                            route="manager.settings.administration"
                        />
                        <slide-y-down-transition v-show="!$v.$invalid">
                            <control-button @click="onCreate('auto-close')" />
                        </slide-y-down-transition>
                    </md-card-content>
                </md-card>
            </div>
        </div>
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card>
                    <card-icon-header />
                    <md-card-content>
                        <vee-input name="Наименование" :vField="$v.displayName" icon="title"
                                   @input="onFieldChange('displayName', $event)"
                                   :vRules="{
                                    required: true,
                                    unique: true,
                                    minLength: true
                                }"/>
                        <vee-input name="Ключ" :vField="$v.keyName" icon="code"
                                   @input="onFieldChange('keyName', $event, true)"
                                   :vRules="{
                                    required: true,
                                    unique: true,
                                    key: true,
                                    minLength: true
                                }"/>
                        <field-wrap v-if="types.length" title="Тип" placeholder="Выберите тип настройки">
                            <md-select v-model="type">
                                <md-option v-for="(item, index) in types" :value="item.name" :key="index">
                                    {{ item.display_name }}
                                </md-option>
                            </md-select>
                        </field-wrap>
                        <field-wrap v-if="settingGroups.length" title="Группа" placeholder="Выберите группу настройки">
                            <md-select v-model="group">
                                <md-option :value="defaultGroup.value">{{ defaultGroup.title }}</md-option>
                                <md-option v-for="settingGroup in settingGroups" :value="settingGroup.id" :key="settingGroup.id">
                                    {{ settingGroup.title }}
                                </md-option>
                            </md-select>
                        </field-wrap>
                    </md-card-content>
                </md-card>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapActions, mapState, mapGetters } from 'vuex'

    import { required, minLength } from 'vuelidate/lib/validators'

    import FieldWrap from '@/custom_components/Form/FieldWrap'
    import VeeSelect from '@/custom_components/VeeForm/VeeSelect'
    import { pageTitle } from '@/mixins/base'
    import { changeField, changeSelect } from '@/mixins/changingFields'
    import { createMethod } from '@/mixins/crudMethods'
    import { validationDelay } from "@/mixins/validations";

    export default {
        name: 'SettingCreate',
        components: {
            VeeSelect, FieldWrap
        },
        mixins: [ pageTitle, changeField, changeSelect, createMethod, validationDelay ],
        data () {
            return {
                type: '',
                group: '',
                defaultGroup: {
                    title: 'Нет группы',
                    value: 0
                },
                storeModule: 'settings',
                responseData: false,
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
                        : !this.isUniqueDisplayName
                }
            },
            keyName: {
                required,
                touch: false,
                minLength: minLength(2),
                isUnique (value) {
                    return (value.trim() === '') && !this.$v.keyName.$dirty
                        ? true
                        : !this.isUniqueKeyName
                },
                testKey (value) {
                    return value.trim() === ''
                        ? true
                        : (/^([a-z0-9]+[_]?)+[a-z0-9]$/).test(value);
                }
            },
            type: {
                required
            },
            group: {
                touch: false
            }
        },
        computed: {
            ...mapState({
                keyName: state => state.settings.fields.key_name,
                displayName: state => state.settings.fields.display_name,
                types: state => state.settings.types,
                settingGroups: state => state.settingGroups.items
            }),
            isUniqueKeyName() {
                return !!this.$store.getters['settings/isUniqueKeyName'](this.keyName);
            },
            isUniqueDisplayName() {
                return !!this.$store.getters['settings/isUniqueDisplayName'](this.displayName);
            },
            ...mapGetters({
                firstTypeName: 'settings/firstTypeName'
            })
        },
        methods: {
            ...mapActions({
                indexWithTypesAction: 'settings/indexWithTypes',
                clearFieldsAction: 'settings/clearFields',
                indexGroupsAction: 'settingGroups/index'
            }),
            onCreate() {
                return this.create({
                    sendData: {
                        key_name : this.keyName,
                        display_name : this.displayName,
                        type : this.type,
                        group_id : this.group
                    },
                    title: this.displayName,
                    successText: 'Настройка создана!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                })
            }
        },
        created() {
            this.indexWithTypesAction()
                .then(() => this.indexGroupsAction())
                .then(() => {
                    if(!this.settingGroups.length) this.$router.push(this.redirectRoute);
                    this.setPageTitle('Новая настройка');
                    this.clearFieldsAction();
                    this.type = this.firstTypeName;
                    this.group = this.defaultGroup.value;
                    this.responseData = true;
                })
                .catch(() => this.$router.push(this.redirectRoute));
        }
    }
</script>
