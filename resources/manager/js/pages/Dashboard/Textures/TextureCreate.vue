<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card>
                    <md-card-content class="md-between">
                        <router-button-link route="manager.textures" title="К списку фактур" />
                        <slide-y-down-transition v-show="!$v.$invalid">
                            <control-button @click="onCreate()" />
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
                        <div class="md-layout md-gutter">
                            <div class="md-layout-item">
                                <v-input title="Наименование"
                                         icon="title"
                                         name="name"
                                         :module="storeModule"
                                         :vField="$v.name"
                                         :vRules="{ required: true, unique: true, minLength: true }" />
                            </div>
                            <div class="md-layout-item">
                                <v-input title="Цена"
                                         icon="attach_money"
                                         name="price"
                                         :maxlength="8"
                                         :module="storeModule"
                                         :vField="$v.price"
                                         :vRules="{ required: true, numeric: true }" />
                            </div>
                            <div class="md-layout-item">
                                <v-input title="Ширина"
                                         icon="straighten"
                                         name="width"
                                         :maxlength="8"
                                         :module="storeModule"
                                         :vField="$v.width"
                                         :vRules="{ required: true, numeric: true }" />
                            </div>
                        </div>
                        <div class="md-layout md-gutter mt-2">
                            <div class="md-layout-item">
                                <v-image title="Миниатюра"
                                         name="thumb"
                                         :vField="$v.thumb"
                                         :vRules="{ required: true }"
                                         :module="storeModule" />
                            </div>
                            <div class="md-layout-item">
                                <v-image title="Образец"
                                         name="sample"
                                         :vField="$v.sample"
                                         :vRules="{ required: true }"
                                         :module="storeModule" />
                            </div>
                            <div class="md-layout-item">
                                <v-image title="Фон"
                                         name="background"
                                         :vField="$v.background"
                                         :vRules="{ required: true }"
                                         :module="storeModule" />
                            </div>
                        </div>
                        <div class="mt-5">
                            <text-editor :value="description"
                                         :module="storeModule" />
                        </div>
                        <div class="mt-5">
                            <v-switch :value="publish"
                                      :module="storeModule" />
                        </div>
                    </md-card-content>
                </md-card>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'

    import { required, numeric, minLength } from 'vuelidate/lib/validators'

    import { pageTitle } from '@/mixins/base'
    import { changePublish } from '@/mixins/changingFields'
    import { createMethod } from '@/mixins/crudMethods'

    import TextEditor from '@/custom_components/Editors/TextEditor'

    export default {
        name: 'TextureCreate',
        mixins: [
            pageTitle,
            changePublish,
            createMethod
        ],
        components: { 'text-editor': TextEditor },
        data() {
            return {
                storeModule: 'textures',
                responseData: false,
                redirectRoute: { name: 'manager.textures' }
            }
        },
        validations: {
            name: {
                required,
                touch: false,
                minLength: minLength(2),
                isUnique (value) {
                    return (value.trim() === '') && !this.$v.name.$dirty
                        ? true
                        : !this.isUniqueName
                }
            },
            price: {
                required,
                numeric,
                touch: false
            },
            width: {
                required,
                numeric,
                touch: false
            },
            thumb: {
                required,
                touch: false
            },
            sample: {
                required,
                touch: false
            },
            background: {
                required,
                touch: false
            }
        },
        computed: {
            ...mapState('textures', {
                name: state => state.fields.name,
                price: state => state.fields.price,
                width: state => state.fields.width,
                thumb: state => state.fields.thumb,
                sample: state => state.fields.sample,
                background: state => state.fields.background,
                publish: state => state.fields.publish,
                description: state => state.fields.description
            }),
            isUniqueName() {
                return !!this.$store.getters['textures/isUniqueName'](this.name);
            },
        },
        methods: {
            ...mapActions('textures', {
                getItemsAction: 'getItems',
                clearFieldsAction: 'clearFields'
            }),
            onCreate() {
                return this.create({
                    sendData: {
                        name: this.name,
                        price: this.price,
                        width: this.width,
                        thumb: this.thumb,
                        sample: this.sample,
                        background: this.background,
                        description: this.description,
                        publish: +this.publish
                    },
                    title: this.name,
                    successText: 'Фактура создана!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                })
            }
        },
        created() {
            this.clearFieldsAction();
            this.getItemsAction()
                .then(() => {
                    this.setPageTitle('Новая фактура');
                    this.responseData = true;
                })
                .catch(() => this.$router.push(this.redirectRoute));

        }
    }
</script>
