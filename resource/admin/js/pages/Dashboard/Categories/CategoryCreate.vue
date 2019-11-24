<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card class="mt-0">
                    <md-card-content class="md-between">
                        <router-button-link :route="`admin.categories.${category_type}`" />
                        <slide-y-down-transition v-show="!$v.$invalid">
                            <control-button @click="onCreate" />
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
                        <vee-input name="Заголовок" :vField="$v.title" @input="onFieldChange('title', $event)"
                                    :vRules="{
                                        required: true,
                                        unique: true,
                                        minLength: true
                                    }"/>
                        <vee-input name="Алиас" :vField="$v.alias" @input="onFieldChange('alias', $event, true)"
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
                        <vee-image :image="imageFile" :vImage="$v.image" :vRules="{ required: true }"
                                   @remove="onImageRemove('imageFile', updateImageField)"
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
                        <vee-textarea name="Описание" :vField="$v.description" @input="onFieldChange('description', $event)" />
                        <vee-textarea name="Ключевые слова" :vField="$v.keywords" @input="onFieldChange('keywords', $event)" :max="100"/>
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
    import { changeField, changePublish } from '@/mixins/changingFields'
    import { validationDelay } from '@/mixins/validations'
    import { createMethod } from '@/mixins/crudMethods'

    export default {
        name: 'CategoryCreate',
        props: {
            category_type: {
                type: String,
                required: true
            },
            page_title: {
                type: String,
                required: true
            },
            result: []
        },
        mixins: [
            pageTitle,
            uploadImage,
            changeField,
            changePublish,
            validationDelay,
            createMethod
        ],
        data () {
            return {
                store_module: 'categories',
                responseData: false,
                imageFile: ''
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
            alias: {
                required,
                touch: false,
                testAlias (value) {
                    return value.trim() === ''
                        ? true
                        : (/^([a-z0-9]+[-]?)+[a-z0-9]$/).test(value);
                },
                minLength: minLength(2),
                isUnique (value) {
                    return (value.trim() === '') && !this.$v.alias.$dirty
                        ? true
                        : !this.isUniqueAlias
                },
            },
            image: {
                required,
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
                publish: state => state.fields.publish,
                description: state => state.fields.description,
                keywords: state => state.fields.keywords
            }),
            isUniqueTitle () {
                return !!this.$store.getters['categories/isUniqueTitle'](this.category_type, this.title);
            },
            isUniqueAlias () {
                return !!this.$store.getters['categories/isUniqueAlias'](this.category_type, this.alias);
            }
        },
        methods: {
            ...mapActions('categories', [
                'getItems',
                'clearFields',
                'createItem',
                'updateImageField'
            ]),
            onCreate () {
                this.create({
                    sendData: {
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
                    successText: 'Категория создана!',
                    redirectName: `admin.categories.${this.category_type}`
                })
            }
        },
        created () {
            this.getItems(this.category_type)
                .then(() => {
                    this.setPageTitle(this.page_title);
                    this.clearFields();
                    this.responseData = true;
                })
                .catch(() => this.$router.push({ name: `admin.categories.${this.category_type}` }));
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
