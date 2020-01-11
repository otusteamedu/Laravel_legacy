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
                        <vee-input name="Заголовок" :vField="$v.title" icon="code"
                                   @input="onFieldChange('title', $event)"
                                   :value="title"
                                   :vRules="{
                                        required: true,
                                        unique: true,
                                        minLength: true
                                    }"/>
                        <vee-textarea name="Описание" :vField="$v.description"
                                      :value="description"
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
    import { updateMethod, deleteMethod } from '@/mixins/crudMethods'

    export default {
        name: 'SettingGroupEdit',
        mixins: [pageTitle, changeField, updateMethod, deleteMethod],
        props: {
            id: {
                type: [ Number, String ],
                required: true
            }
        },
        data () {
            return {
                responseData: false,
                controlSaveVisibilities: false,
                redirectRoute: {
                    name: 'manager.settings.administration',
                    params: { activeTab: 'Группы' }
                },
                storeModule: 'settingGroups'
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
                        : !this.isUniqueTitleEdit
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
            isUniqueTitleEdit() {
                return !!this.$store.getters['settingGroups/isUniqueTitleEdit'](this.title, this.id);
            }
        },
        methods: {
            ...mapActions('settingGroups', {
                indexAction: 'index',
                showAction: 'show'
            }),
            onUpdate() {
                return this.update({
                    sendData: {
                        formData: {
                            title : this.title,
                            description : this.description
                        },
                        id: this.id
                    },
                    title: this.title,
                    successText: 'Группа обновлена!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                });
            },
            onDelete () {
                return this.delete({
                    payload: this.id,
                    title: this.title,
                    alertText: `группу «${this.title}»`,
                    successText: 'Группа удалена!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                })
            },
        },
        created() {
            this.indexAction()
                .then(() => this.showAction(this.id))
                .then(() => {
                    this.setPageTitle(`Группа «${this.title}»`);
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
