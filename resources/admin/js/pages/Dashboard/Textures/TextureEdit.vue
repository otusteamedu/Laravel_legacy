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
                                <vee-input name="Наименование" icon="title" :vField="$v.name" :value="name"
                                           @input="onFieldChange('name', $event, true)"
                                           :vRules="{
                                                required: true,
                                                unique: true,
                                                minLength: true
                                            }"/>
                            </div>
                            <div class="md-layout-item">
                                <vee-input name="Цена" icon="attach_money" :vField="$v.price" :value="price" :max="8"
                                           @input="onFieldChange('price', $event)"
                                           :vRules="{
                                                required: true,
                                                numeric: true
                                            }"/>
                            </div>
                            <div class="md-layout-item">
                                <vee-input name="Ширина" icon="straighten" :vField="$v.width" :value="width" :max="8"
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
                                           :imageDefault="thumbPath"
                                           @remove="onImageRemove('thumbImage', updateThumbFieldAction, 'thumb')"
                                           @change="onImageChange('thumb', 'thumbImage', updateThumbFieldAction, $event)"/>
                            </div>
                            <div class="md-layout-item">
                                <vee-image title="Образец" :image="sampleImage" :vImage="$v.sample" :vRules="{ required: true }"
                                           :imageDefault="samplePath"
                                           @remove="onImageRemove('sampleImage', updateSampleFieldAction, 'sample')"
                                           @change="onImageChange('sample', 'sampleImage', updateSampleFieldAction, $event)"/>
                            </div>
                            <div class="md-layout-item">
                                <vee-image title="Фон" :image="backgroundImage" :vImage="$v.background" :vRules="{ required: true }"
                                           :imageDefault="backgroundPath"
                                           @remove="onImageRemove('backgroundImage', updateBackgroundFieldAction, 'background')"
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
    import { changeField, changePublishEdit } from '@/mixins/changingFields'
    import { validationDelay } from '@/mixins/validations'
    import { updateMethod, deleteMethod } from '@/mixins/crudMethods'

    export default {
        name: 'TextureEdit',
        mixins: [
            pageTitle,
            ckEditor,
            uploadImage,
            changeField,
            changePublishEdit,
            validationDelay,
            updateMethod,
            deleteMethod
        ],
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
            isImageValid() {
                return !this.imageValid;
            },
            isUniqueNameEdit() {
                return !!this.$store.getters['textures/isUniqueNameEdit'](this.name, this.id);
            },
        },
        methods: {
            ...mapActions('textures', {
                showAction: 'show',
                indexAction: 'index',
                clearFieldsAction: 'clearFields',
                updateThumbFieldAction: 'updateThumbField',
                updateSampleFieldAction: 'updateSampleField',
                updateBackgroundFieldAction: 'updateBackgroundField'
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

<style lang="scss">
    .ck.ck-editor__main>.ck-editor__editable {
        height: 300px;
        &:focus {
            border: 1px solid var(--ck-color-input-border);
            box-shadow: var(--ck-inner-shadow),0 0;
            outline: none;
        }
    }
    .ck input.ck-input.ck-input-text:focus {
        border: 0;
        box-shadow: none;
    }
</style>
