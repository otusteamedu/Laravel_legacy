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
                        <vee-input name="Заголовок" :vField="$v.title" icon="code"
                                   @input="onFieldChange('title', $event)"
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
        name: 'SettingGroupCreate',
        mixins: [ pageTitle, changeField, createMethod ],
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
                    return (value.trim() === '') && !this.$v.title.$dirty
                        ? true
                        : !this.isUniqueTitle
                },
            },
            description: {
                touch: false
            }
        },
        computed: {
            ...mapState('settingGroups', {
                title: state => state.fields.title,
                description: state => state.fields.description
            }),
            isUniqueTitle() {
                return !!this.$store.getters['settingGroups/isUniqueTitle'](this.title);
            }
        },
        methods: {
            ...mapActions('settingGroups', {
                indexAction: 'index',
                clearFieldsAction: 'clearFields',
            }),
            onCreate() {
                return this.create({
                    sendData: {
                        title : this.title,
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
            this.indexAction()
                .then(() => {
                    this.setPageTitle('Новая группа');
                    this.clearFieldsAction();
                    this.responseData = true;
                })
                .catch(() => this.$router.push(this.redirectRoute));
        }
    }
</script>
