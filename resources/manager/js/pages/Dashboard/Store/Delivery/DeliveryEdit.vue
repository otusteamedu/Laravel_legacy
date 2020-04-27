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
                            <control-button title="Удалить" @click="onDelete" icon="delete" class="md-danger" />
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

                        <v-input title="Заголовок"
                                 icon="title"
                                 name="title"
                                 :value="title"
                                 :vField="$v.title"
                                 :differ="true"
                                 :module="storeModule"
                                 :vRules="{ required: true, unique: true, minLength: true }" />

                        <v-input title="Алиас"
                                 icon="code"
                                 name="alias"
                                 :value="alias"
                                 :differ="true"
                                 :vDelay="true"
                                 :vField="$v.alias"
                                 :module="storeModule"
                                 :vRules="{ required: true, unique: true, minLength: true, alias: true }" />

                        <v-input title="Стоимость"
                                 icon="attach_money"
                                 name="price"
                                 :value="price"
                                 :vDelay="true"
                                 :vField="$v.price"
                                 :differ="true"
                                 :maxlength="5"
                                 :module="storeModule"
                                 :vRules="{ numeric: true }" />

                        <v-input title="Порядок"
                                 icon="sort"
                                 name="order"
                                 :value="order"
                                 :vDelay="true"
                                 :vField="$v.order"
                                 :maxlength="2"
                                 :module="storeModule"
                                 :vRules="{ numeric: true }" />

                        <v-switch :vField="$v.publish"
                                  :differ="true"
                                  :value="publish"
                                  :module="storeModule" />

                    </md-card-content>
                </md-card>
            </div>
            <div class="md-layout-item md-medium-size-50 md-small-size-100">
                <md-card>
                    <card-icon-header icon="description" title="" />
                    <md-card-content>

                        <v-textarea name="description"
                                    :value="description"
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
    import { updateMethod, deleteMethod } from '@/mixins/crudMethods'

    export default {
        name: 'DeliveryEdit',
        mixins: [pageTitle, updateMethod, deleteMethod],
        props: {
            id: {
                type: [ String, Number ],
                required: true
            }
        },
        data() {
            return {
                redirectRoute: { name: 'manager.store.deliveries' },
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
            alias: {
                required,
                touch: false,
                minLength: minLength(2),
                isUnique (value) {
                    return ((value.trim() === '') && !this.$v.alias.$dirty) || !this.isUniqueAliasEdit
                },
                testAlias (value) {
                    return value.trim() === '' || (/^([a-z0-9]+[-]?)+[a-z0-9]$/).test(value);
                }
            },
            price: {
                numeric,
                touch: false
            },
            order: {
                numeric,
                touch: false
            },
            publish: {
                touch: false
            },
            description: {
                touch: false
            }
        },
        computed: {
            ...mapState('deliveries', {
                title: state => state.fields.title,
                alias: state => state.fields.alias,
                price: state => state.fields.price,
                order: state => state.fields.order,
                publish: state => state.fields.publish,
                description: state => state.fields.description
            }),
            isUniqueTitleEdit() {
                return !!this.$store.getters['deliveries/isUniqueTitleEdit'](this.title, this.id);
            },
            isUniqueAliasEdit () {
                return !!this.$store.getters['deliveries/isUniqueAliasEdit'](this.alias, this.id);
            }
        },
        methods: {
            ...mapActions('deliveries', {
                getItemsAction: 'getItems',
                getItemAction: 'getItem'
            }),
            onUpdate() {
                return this.update({
                    sendData: {
                        formData: {
                            title: this.title,
                            alias: this.alias,
                            price: +this.price,
                            order: +this.order,
                            publish: +this.publish,
                            description: this.description
                        },
                        id: this.id
                    },
                    title: this.title,
                    successText: 'Способ доставки обновлен!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                });
            },
            onDelete() {
                return this.delete({
                    payload: this.id,
                    title: this.title,
                    alertText: `способ доставки «${this.title}»`,
                    successText: 'Способ доставки удален!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                })
            }
        },
        created() {
            this.getItemsAction()
                .then(() => this.getItemAction(this.id))
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
