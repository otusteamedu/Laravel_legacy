<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card>
                    <md-card-content class="md-between">
                        <router-button-link
                            title="В администрирование"
                            :route="redirectRoute.name"
                            :params="redirectRoute.params"
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

                        <v-input title="Заголовок"
                                 icon="title"
                                 name="title"
                                 :vField="$v.title"
                                 :module="storeModule"
                                 :vRules="{ required: true, unique: true, minLength: true }" />

                        <v-input title="Алиас"
                                 icon="code"
                                 name="alias"
                                 :vDelay="true"
                                 :vField="$v.alias"
                                 :module="storeModule"
                                 :vRules="{ required: true, unique: true, minLength: true, alias: true }" />

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
        name: 'SettingGroupCreate',
        mixins: [ pageTitle, createMethod ],
        data () {
            return {
                responseData: false,
                storeModule: 'settingGroups',
                redirectRoute: {
                    name: 'manager.settings.administration',
                    params: { activeTab: 'Группы' }
                }
            }
        },
        validations: {
            title: {
                required,
                touch: false,
                minLength: minLength(2),
                isUnique (value) {
                    return ((value.trim() === '') && !this.$v.title.$dirty) || !this.isUniqueTitle
                },
            },
            alias: {
                required,
                touch: false,
                testAlias (value) {
                    return value.trim() === '' || (/^([a-z0-9]+[-]?)+[a-z0-9]$/).test(value);
                },
                minLength: minLength(2),
                isUnique (value) {
                    return ((value.trim() === '') && !this.$v.alias.$dirty) || !this.isUniqueAlias
                },
            },
            description: {
                touch: false
            }
        },
        computed: {
            ...mapState('settingGroups', {
                title: state => state.fields.title,
                alias: state => state.fields.alias,
                description: state => state.fields.description
            }),
            isUniqueTitle() {
                return !!this.$store.getters['settingGroups/isUniqueTitle'](this.title);
            },
            isUniqueAlias () {
                return !!this.$store.getters['settingGroups/isUniqueAlias'](this.alias);
            }
        },
        methods: {
            ...mapActions('settingGroups', {
                getItemsAction: 'getItems',
                clearFieldsAction: 'clearFields',
            }),
            onCreate() {
                return this.create({
                    sendData: {
                        title : this.title,
                        alias: this.alias,
                        description : this.description
                    },
                    title: this.title,
                    successText: 'Группа создана!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                })
            }
        },
        created() {
            this.clearFieldsAction();
            this.getItemsAction()
                .then(() => {
                    this.setPageTitle('Новая группа');
                    this.responseData = true;
                })
                .catch(() => this.$router.push(this.redirectRoute));
        }
    }
</script>
