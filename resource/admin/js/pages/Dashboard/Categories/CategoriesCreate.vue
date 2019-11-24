<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card class="mt-0">
                    <md-card-content class="md-between">
                        <router-link :to="{ name: `admin.categories.${category_type}` }">
                            <md-button class="md-info md-just-icon">
                                <md-icon>arrow_back</md-icon>
                                <md-tooltip md-direction="right">Назад</md-tooltip>
                            </md-button>
                        </router-link>
                        <div>
                            <slide-y-down-transition v-if="!$v.$invalid">
                                <md-button class="md-success md-just-icon" @click.native="onCreate('auto-close')">
                                    <md-icon>check</md-icon>
                                    <md-tooltip md-direction="left">Создать категорию</md-tooltip>
                                </md-button>
                            </slide-y-down-transition>
                        </div>
                    </md-card-content>
                </md-card>
            </div>
        </div>
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-50 md-small-size-100">
                <md-card>
                    <md-card-header class="md-card-header-icon md-card-header-green">
                        <div class="card-icon">
                            <md-icon>settings</md-icon>
                        </div>
                        <h3 class="title">Установки</h3>
                    </md-card-header>
                    <md-card-content>
                        <h4 class="card-title">Заголовок</h4>
                        <div class="form-group">
                            <md-field :class="[{'md-error': (!$v.title.required || !$v.title.minLength || !$v.title.isUnique) && $v.title.$dirty}, {'md-valid': $v.title.required && $v.title.minLength && $v.title.isUnique}]">
                                <md-input name="title" @input="onTitleChange" maxlength="50"></md-input>
                                <slide-y-down-transition v-if="$v.title.$dirty">
                                    <md-icon class="error" v-show="!$v.title.required || !$v.title.minLength || !$v.title.isUnique">close</md-icon>
                                </slide-y-down-transition>
                                <slide-y-down-transition>
                                    <md-icon class="success" v-show="$v.title.required && $v.title.minLength && $v.title.isUnique">done</md-icon>
                                </slide-y-down-transition>
                            </md-field>
                            <div class="under-input-notice" v-if="$v.title.$dirty">
                                <slide-y-down-transition>
                                    <div class="text-danger" v-if="!$v.title.required">{{ $langLib({ field_name: 'Заголовок' }).REQUIRED }}</div>
                                </slide-y-down-transition>
                                <slide-y-down-transition>
                                    <div class="text-danger" v-if="!$v.title.isUnique">{{ $langLib({ field_name: 'Заголовок' }).UNIQUE }}</div>
                                </slide-y-down-transition>
                                <slide-y-down-transition>
                                    <div class="text-danger" v-if="!$v.title.minLength">{{ $langLib({ field_name: 'Заголовок', min: $v.title.$params.minLength.min }).MIN_STRING }}</div>
                                </slide-y-down-transition>
                            </div>
                        </div>
                        <h4 class="card-title">Алиас</h4>
                        <div class="form-group">
                            <md-field :class="[{'md-error': (!$v.alias.required || !$v.alias.minLength || !$v.alias.isUnique || !$v.alias.testAlias) && $v.alias.$dirty}, {'md-valid': $v.alias.required && $v.alias.minLength && $v.alias.isUnique && $v.alias.testAlias}]">
                                <md-input name="alias" @input="onAliasChange" maxlength="50"></md-input>
                                <slide-y-down-transition v-if="$v.alias.$dirty">
                                    <md-icon class="error" v-show="!$v.alias.required || !$v.alias.minLength || !$v.alias.isUnique || !$v.alias.testAlias">close</md-icon>
                                </slide-y-down-transition>
                                <slide-y-down-transition>
                                    <md-icon class="success" v-show="$v.alias.required && $v.alias.minLength && $v.alias.isUnique && $v.alias.testAlias">done</md-icon>
                                </slide-y-down-transition>
                            </md-field>
                            <div class="under-input-notice" v-if="$v.alias.$dirty">
                                <slide-y-down-transition>
                                    <div class="text-danger" v-if="!$v.alias.required">{{ $langLib({ field_name: 'Алиас' }).REQUIRED }}</div>
                                </slide-y-down-transition>
                                <slide-y-down-transition>
                                    <div class="text-danger" v-if="!$v.alias.isUnique">{{ $langLib({ field_name: 'Алиас' }).UNIQUE }}</div>
                                </slide-y-down-transition>
                                <slide-y-down-transition>
                                    <div class="text-danger" v-if="!$v.alias.minLength">{{ $langLib({ field_name: 'Алиас', min: $v.alias.$params.minLength.min }).MIN_STRING }}</div>
                                </slide-y-down-transition>
                                <slide-y-down-transition>
                                    <div class="text-danger" v-if="!$v.alias.testAlias">{{ $langLib({ field_name: 'Алиас' }).KEBAB_CASE_ALPHA_EN }}</div>
                                </slide-y-down-transition>
                            </div>
                        </div>
                        <div v-if="category_type === 'colors'">
                            <h4 class="card-title">Цвет</h4>
                            <div class="md-color-sample mt-2" :style="'background-color: ' + alias"></div>
                        </div>
                        <h4 class="card-title">Изображение</h4>
                        <div class="form-group">
                            <div class="file-input">
                                <div v-if="!imageRegular">
                                    <div class="image-container">
                                        <img :src="regularImg" title="">
                                    </div>
                                </div>
                                <div v-else class="image-container">
                                    <img :src="imageRegular"/>
                                </div>
                                <div class="button-container">
                                    <md-button class="md-danger md-just-icon" @click="removeImage" v-if="imageRegular">
                                        <md-icon>undo</md-icon>
                                        <md-tooltip md-direction="top">Отменить</md-tooltip>
                                    </md-button>
                                    <md-button class="md-success md-just-icon md-fileinput">
                                        <template>
                                            <md-icon>add_photo_alternate</md-icon>
                                            <md-tooltip md-direction="top">Выберите изображение</md-tooltip>
                                        </template>
                                        <input type="file" name="image" @change="onFileChange">
                                    </md-button>
                                </div>
                            </div>
                            <div class="under-input-notice" v-if="$v.image.$dirty">
                                <slide-y-down-transition>
                                    <div class="text-danger" v-if="!$v.image.required || !$v.image.isValid">{{ $langLib({ field_name: 'Изображение' }).REQUIRED }}</div>
                                </slide-y-down-transition>
                            </div>
                        </div>
                        <h4 class="card-title">Опубликовать</h4>
                        <md-switch :value="!publish" @change="onPublishChange"></md-switch>
                    </md-card-content>
                </md-card>
            </div>
            <div class="md-layout-item md-medium-size-50 md-small-size-100">
                <md-card>
                    <md-card-header class="md-card-header-icon md-card-header-green">
                        <div class="card-icon">
                            <md-icon>timeline</md-icon>
                        </div>
                        <h3 class="title">SEO</h3>
                    </md-card-header>
                    <md-card-content>
                        <h4 class="card-title">Описание</h4>
                        <div class="form-group">
                            <md-field>
                                <md-textarea name="description" @input="onDescriptionChange" maxlength="250"></md-textarea>
                            </md-field>
                        </div>
                        <h4 class="card-title">Ключевые слова</h4>
                        <div class="form-group">
                            <md-field>
                                <md-input name="keywords" @input="onKeywordsChange" maxlength="100"></md-input>
                            </md-field>
                            <div class="space-30"></div>
                        </div>
                    </md-card-content>
                </md-card>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex'

    import swal from 'sweetalert2'
    import { required, minLength } from 'vuelidate/lib/validators'
    import { SlideYDownTransition } from 'vue2-transitions'

    const touchMap = new WeakMap();

    export default {
        name: 'CategoryCreate',
        components: {
            SlideYDownTransition
        },
        props: {
            category_type: {
                type: String,
                required: true
            },
            page_title: {
                type: String,
                required: true
            },
            regularImg: {
                type: String,
                default: '/img/image_placeholder.jpg'
            },
            result: []
        },
        data () {
            return {
                responseData: false,
                imageRegular: '',
                imageValid: false
            }
        },
        validations: {
            title: {
                required,
                touch: false,
                minLength: minLength(2),
                isUnique (value) {
                    if (value.trim() === '') return true;
                    if(this.$v.title.$dirty) {
                        return !this.isUniqueTitle;
                    }
                    return true;
                }
            },
            alias: {
                required,
                touch: false,
                testAlias (value) {
                    if (value.trim() === '') return true;
                    if(this.$v.alias.$dirty) {
                        return (/^([a-z0-9]+[-]?)+[a-z0-9]$/).test(value);
                    }
                    return true;
                },
                minLength: minLength(2),
                isUnique (value) {
                    if (value.trim() === '') return true;
                    if(this.$v.alias.$dirty) {
                        return !this.isUniqueAlias;
                    }
                    return true;
                }
            },
            image: {
                required,
                isValid() {
                    return !this.isImageValid;
                },
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
            },
            isImageValid () {
                return !this.imageValid;
            }
        },
        methods: {
            onFileChange (e) {
                this.$v.image.$touch();
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
                this.$store.dispatch(`categories/updateImageField`, e.target.files[0]);
            },
            createImage (file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => vm.imageRegular = e.target.result;
                reader.readAsDataURL(file);
                this.imageValid = true;
            },
            removeImage () {
                this.$v.image.$reset();
                this.imageRegular = '';
                this.imageValid = false;
            },
            onTitleChange (value) {
                this.setValidationDelay(this.$v.title);
                this.$store.dispatch('categories/updateTitleField', value.trim());
            },
            onAliasChange (value) {
                this.setValidationDelay(this.$v.alias);
                this.$store.dispatch('categories/updateAliasField', value.trim());
            },
            onPublishChange () {
                this.$store.dispatch('categories/updatePublishField');
            },
            onDescriptionChange (value) {
                this.$v.description.$touch();
                this.$store.dispatch('categories/updateDescriptionField', value.trim());
            },
            onKeywordsChange (value) {
                this.$v.keywords.$touch();
                this.$store.dispatch('categories/updateKeywordsField', value.trim());
            },
            onCreate () {
                this.$store.dispatch('categories/createItem', {
                    category_type: this.category_type,
                    formData: {
                        title: this.title,
                        alias: this.alias,
                        image: this.image,
                        publish: +this.publish,
                        description: this.description,
                        keywords: this.keywords
                    }
                })
                    .then(() => {
                        swal.fire({
                            title: 'Категория создана!',
                            text: `«${this.title}»`,
                            timer: 2000,
                            showConfirmButton: false,
                            type: 'success'
                        });
                        this.$router.push({ name: `admin.categories.${this.category_type}` });
                    });
            },
            setValidationDelay (v) {
                v.$reset();
                if (touchMap.has(v)) {
                    clearTimeout(touchMap.get(v));
                }
                touchMap.set(v, setTimeout(v.$touch, 1000));
            }
        },
        created () {
            this.$store.dispatch('categories/getItems', this.category_type)
                .then(() => {
                    this.$store.dispatch('setPageTitle', this.page_title);
                    this.$store.dispatch('categories/clearFields');
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
    .md-field.md-has-textarea:not(.md-autogrow) .md-count {
        bottom: -30px;
    }
</style>