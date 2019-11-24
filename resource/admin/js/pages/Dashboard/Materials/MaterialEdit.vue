<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card>
                    <md-card-content class="md-between">
                        <router-button-link route="admin.materials" title="К списку материалов" />
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
                                           :imageDefault="thumb_path"
                                           @remove="onImageRemove('thumbImage', updateThumbField, 'thumb')"
                                           @change="onImageChange('thumb', 'thumbImage', updateThumbField, $event)"/>
                            </div>
                            <div class="md-layout-item">
                                <vee-image title="Образец" :image="sampleImage" :vImage="$v.sample" :vRules="{ required: true }"
                                           :imageDefault="sample_path"
                                           @remove="onImageRemove('sampleImage', updateSampleField, 'sample')"
                                           @change="onImageChange('sample', 'sampleImage', updateSampleField, $event)"/>
                            </div>
                            <div class="md-layout-item">
                                <vee-image title="Фон" :image="backgroundImage" :vImage="$v.background" :vRules="{ required: true }"
                                           :imageDefault="background_path"
                                           @remove="onImageRemove('backgroundImage', updateBackgroundField, 'background')"
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
    import { changeField, changePublishEdit } from '@/mixins/changingFields'
    import { validationDelay } from '@/mixins/validations'
    import { updateMethod, deleteMethod } from '@/mixins/crudMethods'

    export default {
        name: 'MaterialEdit',
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
                store_module: 'materials',
                responseData: false,
                thumbImage: '',
                sampleImage: '',
                backgroundImage: '',
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
            }
        },
        computed: {
            ...mapState('materials', {
                name: state => state.fields.name,
                price: state => state.fields.price,
                width: state => state.fields.width,
                thumb_path: state => state.fields.thumb_path,
                sample_path: state => state.fields.sample_path,
                background_path: state => state.fields.background_path,
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
                return !!this.$store.getters['materials/isUniqueNameEdit'](this.name, this.id);
            },
        },
        methods: {
            ...mapActions('materials', [
                'getItem',
                'getItems',
                'clearFields',
                'updateThumbField',
                'updateSampleField',
                'updateBackgroundField',
                'updateItem',
                'deleteItem'
            ]),
            onUpdate () {
                this.update({
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
                    redirectName: 'admin.materials',
                    successText: 'Материал обновлен!'
                });
            },
            onDelete () {
                this.delete({
                    id: this.id,
                    title: this.name,
                    alertText: `материал «${this.name}»`,
                    successText: 'Материал удален!',
                    redirectName: 'admin.materials'
                })
            }
        },
        created() {
            this.getItems()
                .then(() => this.getItem(this.id))
                .then(() => {
                    this.setPageTitle(`Материал «${this.name}»`);
                    this.responseData = true;
                })
                .then(() => {
                    this.$v.$reset();
                })
                .catch(() => this.$router.push({name: 'admin.materials'}));

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
