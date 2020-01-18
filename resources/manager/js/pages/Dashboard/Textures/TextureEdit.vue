<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card>
                    <md-card-content class="md-between">
                        <router-button-link route="manager.textures" title="К списку материалов" />
                        <div>
                            <slide-y-down-transition v-show="$v.$anyDirty && !$v.$invalid">
                                <control-button @click="onUpdate('auto-close')" />
                            </slide-y-down-transition>
                            <control-button title="Удалить" icon="delete" color="md-danger" @click="onDelete('auto-close')" />
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
                        <div class="md-layout md-gutter">
                            <div class="md-layout-item">
                                <v-input title="Наименование"
                                         icon="title"
                                         name="name"
                                         :value="name"
                                         :vField="$v.name"
                                         :differ="true"
                                         :module="storeModule"
                                         :vRules="{ required: true, unique: true, minLength: true }" />
                            </div>
                            <div class="md-layout-item">
                                <v-input title="Цена"
                                         icon="attach_money"
                                         name="price"
                                         :value="price"
                                         :maxlength="8"
                                         :vField="$v.price"
                                         :differ="true"
                                         :module="storeModule"
                                         :vRules="{ required: true, numeric: true }" />
                            </div>
                            <div class="md-layout-item">
                                <v-input title="Ширина"
                                         icon="straighten"
                                         name="width"
                                         :value="width"
                                         :maxlength="8"
                                         :vField="$v.width"
                                         :differ="true"
                                         :module="storeModule"
                                         :vRules="{ required: true, numeric: true }" />
                            </div>
                        </div>
                        <div class="md-layout md-gutter mt-2">
                            <div class="md-layout-item">
                                <v-image title="Миниатюра"
                                         name="thumb"
                                         :imgDefault="thumbPath"
                                         :vField="$v.thumb"
                                         :differ="true"
                                         :module="storeModule" />
                            </div>
                            <div class="md-layout-item">
                                <v-image title="Образец"
                                         name="sample"
                                         :imgDefault="samplePath"
                                         :vField="$v.sample"
                                         :differ="true"
                                         :module="storeModule" />
                            </div>
                            <div class="md-layout-item">
                                <v-image title="Фон"
                                         name="background"
                                         :imgDefault="backgroundPath"
                                         :vField="$v.background"
                                         :differ="true"
                                         :module="storeModule" />
                            </div>
                        </div>
                        <div class="mt-5">
                            <div class="mt-5">
                                <text-editor :value="description"
                                             :vField="$v.description"
                                             :differ="true"
                                             :module="storeModule" />
                            </div>
                        </div>
                        <div class="mt-5">
                            <v-switch :value="publish"
                                      :vField="$v.publish"
                                      :differ="true"
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

    import {required, numeric, minLength} from 'vuelidate/lib/validators'

    import { pageTitle } from '@/mixins/base'
    import { changePublishEdit } from '@/mixins/changingFields'
    import { updateMethod, deleteMethod } from '@/mixins/crudMethods'

    import TextEditor from '@/custom_components/Editors/TextEditor'

    export default {
        name: 'TextureEdit',
        mixins: [
            pageTitle,
            changePublishEdit,
            updateMethod,
            deleteMethod
        ],
        components: { 'text-editor': TextEditor },
        props: {
            id: {
                type: [ Number, String ],
                required: true
            },
            result: [],
        },
        data () {
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
                        : !this.isUniqueNameEdit
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
                touch: false
            },
            sample: {
                touch: false
            },
            background: {
                touch: false
            },
            description: {
                touch: false
            },
            publish: {
                touch: false
            }
        },
        computed: {
            ...mapState('textures', {
                name: state => state.fields.name,
                price: state => state.fields.price,
                width: state => state.fields.width,
                thumbPath: state => state.fields.thumb_path,
                samplePath: state => state.fields.sample_path,
                backgroundPath: state => state.fields.background_path,
                thumb: state => state.fields.thumb,
                sample: state => state.fields.sample,
                background: state => state.fields.background,
                description: state => state.fields.description,
                publish: state => state.fields.publish
            }),
            isUniqueNameEdit() {
                return !!this.$store.getters['textures/isUniqueNameEdit'](this.name, this.id);
            },
        },
        methods: {
            ...mapActions('textures', {
                showAction: 'show',
                indexAction: 'index',
                clearFieldsAction: 'clearFields'
            }),
            onUpdate () {
                return this.update({
                    sendData: {
                        formData: {
                            name : this.name,
                            price : this.price,
                            width : this.width,
                            thumb: this.thumb,
                            sample: this.sample,
                            background: this.background,
                            description: this.description,
                            publish: +this.publish
                        },
                        id: this.id
                    },
                    title: this.name,
                    successText: 'Фактура обновлена!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                });
            },
            onDelete () {
                this.delete({
                    payload: this.id,
                    title: this.name,
                    alertText: `фактура «${this.name}»`,
                    successText: 'Фактура удалена!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                })
            }
        },
        created() {
            this.indexAction()
                .then(() => this.showAction(this.id))
                .then(() => {
                    this.setPageTitle(`Фактура «${this.name}»`);
                    this.responseData = true;
                })
                .then(() => this.$v.$reset())
                .catch(() => this.$router.push(this.redirectRoute));
        }
    }
</script>
