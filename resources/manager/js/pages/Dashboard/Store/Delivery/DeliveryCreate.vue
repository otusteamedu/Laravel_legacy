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

                        <v-input title="Заголовок"
                                 icon="title"
                                 name="title"
                                 :vField="$v.title"
                                 :module="storeModule"
                                 :vRules="{ required: true, unique: true, minLength: true }" />

                        <v-input title="Стоимость"
                                 icon="attach_money"
                                 name="cost"
                                 :vDelay="true"
                                 :vField="$v.cost"
                                 :maxlength="5"
                                 :module="storeModule"
                                 :vRules="{ numeric: true }" />

                        <v-switch :value="publish"
                                  :module="storeModule" />

                    </md-card-content>
                </md-card>
            </div>
            <div class="md-layout-item md-medium-size-50 md-small-size-100">
                <md-card>
                    <card-icon-header icon="description" title="" />
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

    import { required, minLength, numeric } from 'vuelidate/lib/validators'

    import { pageTitle } from '@/mixins/base'
    import { createMethod } from '@/mixins/crudMethods'

    export default {
        name: 'DeliveryCreate',
        mixins: [ pageTitle, createMethod ],
        data() {
            return {
                redirectRoute: { name: 'manager.store.deliveries' },
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
            this.clearFieldsAction();
            this.indexAction()
                .then(() => {
                    this.setPageTitle('Новый способ доставки');
                    this.responseData = true;
                })
                .catch(() => this.$router.push(this.redirectRoute));
        }
    }
</script>
