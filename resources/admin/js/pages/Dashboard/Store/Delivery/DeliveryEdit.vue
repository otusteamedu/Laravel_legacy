<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card>
                    <md-card-content class="md-between">
                        <router-button-link :route="redirectRoute.name" title="К списку доставок" />
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
                        <vee-input name="Заголовок"
                                   :vField="$v.title"
                                   @input="onFieldChange('title', $event)"
                                   :value="title"
                                   :vRules="{
                                        required: true,
                                        unique: true,
                                        minLength: true
                                   }"/>
                        <vee-input name="Стоимость"
                                   :vField="$v.cost"
                                   @input="onFieldChange('cost', $event)"
                                   :value="cost"
                                   :vRules="{
                                        numeric: true
                                   }"/>
                        <h4 class="card-title">Опубликовать</h4>
                        <md-switch :value="!publish" @change="onPublishChange" />
                    </md-card-content>
                </md-card>
            </div>
            <div class="md-layout-item md-medium-size-50 md-small-size-100">
                <md-card>
                    <card-icon-header icon="description" title="" />
                    <md-card-content>
                        <vee-textarea name="Описание"
                                      :vField="$v.description"
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

    import { required, minLength, numeric } from 'vuelidate/lib/validators'

    import { pageTitle } from '@/mixins/base'
    import { changeField, changePublish } from '@/mixins/changingFields'
    import { updateMethod, deleteMethod } from '@/mixins/crudMethods'

    export default {
        name: 'DeliveryEdit',
        mixins: [pageTitle, changeField, changePublish, updateMethod, deleteMethod],
        props: {
            id: {
                type: [ String, Number ],
                required: true
            }
        },
        data() {
            return {
                redirectRoute: { name: 'manager.store.delivery' },
                responseData: false,
                storeModule: 'deliveries',
                controlSaveVisibilities: false
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
            cost: {
                numeric,
                touch: false
            },
            description: {
                touch: false
            }
        },
        computed: {
            ...mapState('deliveries', {
                title: state => state.fields.title,
                cost: state => state.fields.cost,
                publish: state => state.fields.publish,
                description: state => state.fields.description
            }),
            isUniqueTitleEdit() {
                return !!this.$store.getters['deliveries/isUniqueTitleEdit'](this.title, this.id);
            }
        },
        methods: {
            ...mapActions('deliveries', {
                indexAction: 'index',
                showAction: 'show'
            }),
            onUpdate() {
                return this.update({
                    sendData: {
                        formData: {
                            title: this.title,
                            cost: +this.cost,
                            publish: +this.publish,
                            description: this.description
                        },
                        id: this.id
                    },
                    title: this.displayName,
                    successText: 'Способ доставки обновлен!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                });
            },
            onDelete() {
                return this.delete({
                    payload: this.id,
                    title: this.title,
                    alertText: `способ доставки «${this.displayName}»`,
                    successText: 'Способ доставки удален!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                })
            }
        },
        created() {
            this.indexAction()
                .then(() => this.showAction(this.id))
                .then(() => {
                    this.setPageTitle(this.title);
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
