<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card>
                    <md-card-content class="md-between">
                        <router-button-link :route="redirectRoute.name" title="К списку доставок" />
                        <slide-y-down-transition v-show="!$v.$invalid">
                            <control-button title="Создать доставку" @click="onCreate"/>
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
                        <vee-input name="Заголовок"
                            :vField="$v.title"
                            @input="onFieldChange('title', $event)"
                            :vRules="{
                                required: true,
                                unique: true,
                                minLength: true
                            }"/>
                        <vee-input name="Стоимость" :vField="$v.cost"
                            @input="onFieldChange('cost', $event)"
                            :maxlength="7"
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
                            @input="onFieldChange('description', $event)"
                        />
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
    import { createMethod } from '@/mixins/crudMethods'

    export default {
        name: 'DeliveryCreate',
        mixins: [ pageTitle, changeField, changePublish, createMethod ],
        data() {
            return {
                redirectRoute: { name: 'manager.store.delivery' },
                responseData: false,
                storeModule: 'deliveries'
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
                }
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
            isUniqueTitle() {
                return !!this.$store.getters['deliveries/isUniqueTitle'](this.title);
            }
        },
        methods: {
            ...mapActions('deliveries', {
                indexAction: 'index',
                clearFieldsAction: 'clearFields',
            }),
            onCreate() {
                return this.create({
                    sendData: {
                        title: this.title,
                        cost: +this.cost,
                        publish: +this.publish,
                        description: this.description
                    },
                    title: this.title,
                    successText: 'Способ доставки создан!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                })
            }
        },
        created() {
            this.indexAction()
                .then(() => {
                    this.setPageTitle('Новый способ доставки');
                    this.clearFieldsAction();
                    this.responseData = true;
                })
                .catch(() => this.$router.push(this.redirectRoute));
        }
    }
</script>
