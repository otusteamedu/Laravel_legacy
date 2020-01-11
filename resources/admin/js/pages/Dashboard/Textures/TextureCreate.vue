<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card>
                    <md-card-content class="md-between">
                        <router-button-link route="manager.textures" title="К списку фактур" />
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
                        <div class="md-layout md-gutter">
                            <div class="md-layout-item">
                                <vee-input name="Наименование" icon="title" :vField="$v.name"
                                    @input="onFieldChange('name', $event, true)"
                                    :vRules="{
                                        required: true,
                                        unique: true,
                                        minLength: true
                                    }"/>
                            </div>
                            <div class="md-layout-item">
                                <vee-input name="Цена" icon="attach_money" :vField="$v.price" :max="8"
                                    @input="onFieldChange('price', $event)"
                                    :vRules="{
                                        required: true,
                                        numeric: true
                                    }"/>
                            </div>
                            <div class="md-layout-item">
                                <vee-input name="Ширина" icon="straighten" :vField="$v.width" :max="8"
                                    @input="onFieldChange('width', $event)"
                                    :vRules="{
                                        required: true,
                                        numeric: true
                                    }"/>
                            </div>
                        </div>
                        <div class="md-layout md-gutter mt-2">
                            <div class="md-layout-item">
                                <vee-image title="Миниатюра" :image="thumbImage" :vImage="$v.thumb" :vRules="{ required: true }"
                                           @remove="onImageRemove('thumbImage', updateThumbFieldAction)"
                                           @change="onImageChange('thumb', 'thumbImage', updateThumbFieldAction, $event)"/>
                            </div>
                            <div class="md-layout-item">
                                <vee-image title="Образец" :image="sampleImage" :vImage="$v.sample" :vRules="{ required: true }"
                                           @remove="onImageRemove('sampleImage', updateSampleFieldAction)"
                                           @change="onImageChange('sample', 'sampleImage', updateSampleFieldAction, $event)"/>
                            </div>
                            <div class="md-layout-item">
                                <vee-image title="Фон" :image="backgroundImage" :vImage="$v.background" :vRules="{ required: true }"
                                           @remove="onImageRemove('backgroundImage', updateBackgroundFieldAction)"
                                           @change="onImageChange('background', 'backgroundImage', updateBackgroundFieldAction, $event)"/>
                            </div>
                        </div>
                        <div class="mt-5">
                            <h4 class="card-title">Описание</h4>
                            <ckeditor :editor="editor" :config="editorConfig" :value="description"
                                      @input="onFieldChange('description', $event)" />
                        </div>
                        <div class="mt-5">
                            <h4 class="card-title">Опубликовать</h4>
                            <md-switch :value="!publish" @change="onPublishChange" />
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
    import { ckEditor } from '@/mixins/ckEditor'
    import { uploadImage } from '@/mixins/uploadImage'
    import { changeField, changePublish } from '@/mixins/changingFields'
    import { validationDelay } from '@/mixins/validations'
    import { createMethod } from '@/mixins/crudMethods'

    export default {
        name: 'TextureCreate',
        mixins: [
            pageTitle,
            ckEditor,
            uploadImage,
            changeField,
            changePublish,
            validationDelay,
            createMethod
        ],
        props: {
            regularImg: {
                type: String,
                default: '/img/image_placeholder.jpg'
            },
            result: [],
        },
        data() {
            return {
                storeModule: 'textures',
                responseData: false,
                thumbImage: '',
                sampleImage: '',
                backgroundImage: '',
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
                indexAction: 'index',
                clearFieldsAction: 'clearFields',
                updateThumbFieldAction: 'updateThumbField',
                updateSampleFieldAction: 'updateSampleField',
                updateBackgroundFieldAction: 'updateBackgroundField'
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
            this.indexAction()
                .then(() => {
                    this.setPageTitle('Новая фактура');
                    this.clearFieldsAction();
                    this.responseData = true;
                })
                .catch(() => this.$router.push(this.redirectRoute));

        }
    }
</script>

<style lang="scss">
    .ck.ck-editor__main > .ck-editor__editable {
        height: 300px;

        &:focus {
            border: 1px solid var(--ck-color-input-border);
            box-shadow: var(--ck-inner-shadow), 0 0;
            outline: none;
        }
    }

    .ck input.ck-input.ck-input-text:focus {
        border: 0;
        box-shadow: none;
    }
</style>
