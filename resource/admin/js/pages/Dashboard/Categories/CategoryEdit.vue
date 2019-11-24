<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card class="mt-0">
                    <md-card-content class="md-between">
                        <router-button-link :route="`admin.categories.${category_type}`" />
                        <div>
                            <slide-y-down-transition v-show="$v.$anyDirty && !$v.$invalid">
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
                        <vee-input name="Заголовок" :vField="$v.title" @input="onFieldChange('title', $event)"
                                    :value="title"
                                    :vRules="{
                                        required: true,
                                        unique: true,
                                        minLength: true
                                    }"/>
                        <vee-input name="Алиас" :vField="$v.alias" @input="onFieldChange('alias', $event, true)"
                                    :value="alias"
                                    :vRules="{
                                        required: true,
                                        unique: true,
                                        minLength: true,
                                        alias: true
                                    }"/>
                        <div v-if="category_type === 'colors'">
                            <h4 class="card-title">Цвет</h4>
                            <div class="md-color-sample mt-2" :style="'background-color: ' + alias"></div>
                        </div>
                        <vee-image :image="imageFile" :imageDefault="`/image/widen/400/${imagePath}`"
                                   :vImage="$v.image"
                                   @remove="onImageRemove('imageFile', updateImageField, 'image')"
                                   @change="onImageChange('image', 'imageFile', updateImageField, $event)"/>
                        <h4 class="card-title">Опубликовать</h4>
                        <md-switch :value="!publish" @change="onPublishChange"></md-switch>
                    </md-card-content>
                </md-card>
            </div>
            <div class="md-layout-item md-medium-size-50 md-small-size-100">
                <md-card>
                    <card-icon-header icon="timeline" title="SEO" />
                    <md-card-content>
                        <vee-textarea name="Описание" :vField="$v.description" :value="description"
                                      @input="onFieldChange('description', $event)" />
                        <vee-textarea name="Ключевые слова" :vField="$v.keywords" :value="keywords"
                                      @input="onFieldChange('keywords', $event)" :max="100"/>
                        <div class="space-30"></div>
                    </md-card-content>
                </md-card>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'

    import { required, minLength } from 'vuelidate/lib/validators'

    import { pageTitle } from '@/mixins/actions'
    import { uploadImage } from '@/mixins/uploadImage'
    import { changeField, changePublishEdit } from '@/mixins/changingFields'
    import { validationDelay } from '@/mixins/validations'
    import { updateMethod, deleteMethod } from '@/mixins/crudMethods'

    export default {
        name: 'CategoryEdit',
        props: {
            id: {
                type: [ Number, String ],
                required: true
            },
            category_type: {
                type: String,
                required: true
            },
            result: []
        },
        mixins: [
            pageTitle,
            uploadImage,
            changeField,
            changePublishEdit,
            validationDelay,
            updateMethod,
            deleteMethod
        ],
        data () {
            return {
                imageFile: '',
                responseData: false,
                store_module: 'categories'
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
                }
            },
            alias: {
                required,
                touch: false,
                minLength: minLength(2),
                isUnique (value) {
                    return (value.trim() === '') && !this.$v.alias.$dirty
                        ? true
                        : !this.isUniqueAliasEdit
                },
                testAlias (value) {
                    return value.trim() === ''
                        ? true
                        : (/^([a-z0-9]+[-]?)+[a-z0-9]$/).test(value);
                }
            },
            image: {
                touch: false
            },
            publish: {
                touch: false
            },
            description: {
                touch: false
            },
            keywords: {
                touch: false
            }
        },
        computed: {
            ...mapState('categories', {
                title: state => state.fields.title,
                alias: state => state.fields.alias,
                image: state => state.fields.image,
                imagePath: state => state.fields.image_path,
                publish: state => state.fields.publish,
                description: state => state.fields.description,
                keywords: state => state.fields.keywords
            }),
            isUniqueTitleEdit () {
                return !!this.$store.getters['categories/isUniqueTitleEdit'](this.category_type, this.title, this.id);
            },
            isUniqueAliasEdit () {
                return !!this.$store.getters['categories/isUniqueAliasEdit'](this.category_type, this.alias, this.id);
            }
        },
        methods: {
            ...mapActions('categories', [
                'getItem',
                'getItems',
                'updateItem',
                'deleteItem',
                'updateImageField'
            ]),
            onUpdate () {
                this.update({
                    sendData: {
                        category_id: this.id,
                        category_type: this.category_type,
                        formData: {
                            title: this.title,
                            alias: this.alias,
                            image: this.image,
                            publish: +this.publish,
                            description: this.description,
                            keywords: this.keywords
                        }
                    },
                    title: this.title,
                    redirectName: `admin.categories.${this.category_type}`,
                    successText: 'Категория обновлена!'
                });
            },
            onDelete () {
                this.delete({
                    id: { category_id: this.id, category_type: this.category_type },
                    title: this.title,
                    alertText: `категорию «${this.title}»`,
                    successText: 'Категория удалена!',
                    redirectName: `admin.categories.${this.category_type}`
                })
            }
        },
        created() {
            this.getItems(this.category_type)
                .then(() => this.getItem({ category_id: this.id, category_type: this.category_type }))
                .then(() => {
                    this.setPageTitle(this.title);
                    this.responseData = true;
                })
                .catch(() => this.$router.push({name: `admin.categories.${this.category_type}`}));
        }
    }
</script>

<style lang="scss">
    .md-color-sample {
        flex: none;
        width: 100%;
        height: 120px;
        border-radius: 3px;
        will-change: background-color;
        background-color: gray;
        box-shadow: 0 12px 20px -10px rgba(153, 153, 153, 0.14), 0 4px 20px 0px rgba(153, 153, 153, 0.2), 0 7px 8px -5px rgba(153, 153, 153, 0.12);
    }
</style>
