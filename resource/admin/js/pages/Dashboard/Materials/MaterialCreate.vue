<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card>
                    <md-card-content class="md-between">
                        <router-button-link route="admin.materials" title="К списку материалов" />
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
                                           @remove="onImageRemove('thumbImage', updateThumbField)"
                                           @change="onImageChange('thumb', 'thumbImage', updateThumbField, $event)"/>
                            </div>
                            <div class="md-layout-item">
                                <vee-image title="Образец" :image="sampleImage" :vImage="$v.sample" :vRules="{ required: true }"
                                           @remove="onImageRemove('sampleImage', updateSampleField)"
                                           @change="onImageChange('sample', 'sampleImage', updateSampleField, $event)"/>
                            </div>
                            <div class="md-layout-item">
                                <vee-image title="Фон" :image="backgroundImage" :vImage="$v.background" :vRules="{ required: true }"
                                           @remove="onImageRemove('backgroundImage', updateBackgroundField)"
                                           @change="onImageChange('background', 'backgroundImage', updateBackgroundField, $event)"/>
                            </div>
                        </div>
                        <div class="mt-5">
                            <h4 class="card-title">Описание</h4>
                            <ckeditor :editor="editor" :config="editorConfig" :value="description"
                                      @input="onFieldChange('description', $event)"></ckeditor>
                        </div>
                        <div class="mt-5">
                            <h4 class="card-title">Опубликовать</h4>
                            <md-switch :value="!publish" @change="onPublishChange"></md-switch>
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

    import { pageTitle } from '@/mixins/actions'
    import { ckEditor } from '@/mixins/ckEditor'
    import { uploadImage } from '@/mixins/uploadImage'
    import { changeField, changePublish } from '@/mixins/changingFields'
    import { validationDelay } from '@/mixins/validations'
    import { createMethod } from '@/mixins/crudMethods'

    export default {
        name: 'MaterialCreate',
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
                store_module: 'materials',
                responseData: false,
                thumbImage: '',
                sampleImage: '',
                backgroundImage: ''
            }
        },
        validations: {
            name: {
                required,
                touch: false,
                minLength: minLength(2),
                isUnique (value) {
                    return (value.trim() === '') && !this.$v.title.$dirty
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
            ...mapState('materials', {
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
                return !!this.$store.getters['materials/isUniqueName'](this.name);
            },
        },
        methods: {
            ...mapActions('materials', [
                'getItems',
                'clearFields',
                'updateThumbField',
                'updateSampleField',
                'updateBackgroundField',
                'createItem'
            ]),
            onCreate() {
                this.create({
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
                    successText: 'Материал создан!',
                    redirectName: 'admin.materials'
                })
            }
        },
        created() {
            this.getItems()
                .then(() => {
                    this.setPageTitle('Новый материал');
                    this.clearFields();
                    this.responseData = true;
                })
                .catch(() => this.$router.push({name: 'admin.materials'}));

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
