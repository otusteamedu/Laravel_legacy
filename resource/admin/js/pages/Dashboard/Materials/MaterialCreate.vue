<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card>
                    <md-card-content class="md-between">
                        <router-link :to="{ name: 'admin.materials' }">
                            <md-button class="md-info md-just-icon">
                                <md-icon>arrow_back</md-icon>
                                <md-tooltip md-direction="right">К списку Материалов</md-tooltip>
                            </md-button>
                        </router-link>
                        <div>
                            <slide-y-down-transition v-if="!$v.$invalid">
                                <md-button class="md-success md-just-icon" @click.native="onCreate('auto-close')">
                                    <md-icon>check</md-icon>
                                    <md-tooltip md-direction="left">Создать</md-tooltip>
                                </md-button>
                            </slide-y-down-transition>
                        </div>
                    </md-card-content>
                </md-card>
            </div>
        </div>
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card>
                    <md-card-header class="md-card-header-icon md-card-header-green">
                        <div class="card-icon">
                            <md-icon>settings</md-icon>
                        </div>
                        <h3 class="title">Установки</h3>
                    </md-card-header>
                    <md-card-content>
                        <div class="md-layout md-gutter">
                            <div class="md-layout-item">
                                <h4 class="card-title">Наименование</h4>
                                <div class="form-group">
                                    <md-field :class="[{'md-error': (!$v.name.required || !$v.name.minLength || !$v.name.isUnique) && $v.name.$dirty}, {'md-valid': $v.name.required && $v.name.minLength && $v.name.isUnique}]">
                                        <md-icon>title</md-icon>
                                        <md-input name="name" @input="onNameChange" maxLength="50"></md-input>
                                        <slide-y-down-transition v-if="$v.name.$dirty">
                                            <md-icon class="error" v-show="!$v.name.required || !$v.name.minLength || !$v.name.isUnique">close</md-icon>
                                        </slide-y-down-transition>
                                        <slide-y-down-transition>
                                            <md-icon class="success" v-show="$v.name.required && $v.name.minLength && $v.name.isUnique">done</md-icon>
                                        </slide-y-down-transition>
                                    </md-field>
                                    <div class="under-input-notice" v-if="$v.name.$dirty">
                                        <slide-y-down-transition>
                                            <div class="text-danger" v-if="!$v.name.required">{{ $langLib({ field_name: 'Наименование' }).REQUIRED }}</div>
                                        </slide-y-down-transition>
                                        <slide-y-down-transition>
                                            <div class="text-danger" v-if="!$v.name.isUnique">{{ $langLib({ field_name: 'Наименование' }).UNIQUE }}</div>
                                        </slide-y-down-transition>
                                        <slide-y-down-transition>
                                            <div class="text-danger" v-if="!$v.name.minLength">{{ $langLib({ field_name: 'Наименование', min: $v.name.$params.minLength.min }).MIN_STRING }}</div>
                                        </slide-y-down-transition>
                                    </div>
                                </div>
                            </div>
                            <div class="md-layout-item">
                                <h4 class="card-title">Цена</h4>
                                <div class="form-group">
                                    <md-field :class="[{'md-error': (!$v.price.required || !$v.price.testPrice) && $v.price.$dirty}, {'md-valid': $v.price.required && $v.price.testPrice}]">
                                        <md-icon>attach_money</md-icon>
                                        <md-input name="price" @input="onPriceChange"></md-input>
                                        <slide-y-down-transition v-if="$v.price.$dirty">
                                            <md-icon class="error" v-show="!$v.price.required || !$v.price.testPrice">close</md-icon>
                                        </slide-y-down-transition>
                                        <slide-y-down-transition>
                                            <md-icon class="success" v-show="$v.price.required && $v.price.testPrice">done</md-icon>
                                        </slide-y-down-transition>
                                    </md-field>
                                    <div class="under-input-notice" v-if="$v.price.$dirty">
                                        <slide-y-down-transition>
                                            <div class="text-danger" v-if="!$v.price.required">{{ $langLib({ field_name: 'Цена' }).REQUIRED }}</div>
                                        </slide-y-down-transition>
                                        <slide-y-down-transition>
                                            <div class="text-danger" v-if="!$v.price.testPrice">{{ $langLib({ field_name: 'Цена' }).NUM_DOT }}</div>
                                        </slide-y-down-transition>
                                    </div>
                                </div>
                            </div>
                            <div class="md-layout-item">
                                <h4 class="card-title">Ширина</h4>
                                <div class="form-group">
                                    <md-field :class="[{'md-error': (!$v.width.required || !$v.width.testWidth) && $v.width.$dirty}, {'md-valid': $v.width.required && $v.width.testWidth}]">
                                        <md-icon>straighten</md-icon>
                                        <md-input name="width" @input="onWidthChange"></md-input>
                                        <slide-y-down-transition v-if="$v.width.$dirty">
                                            <md-icon class="error" v-show="!$v.width.required || !$v.width.testWidth">close</md-icon>
                                        </slide-y-down-transition>
                                        <slide-y-down-transition>
                                            <md-icon class="success" v-show="$v.width.required && $v.width.testWidth">done</md-icon>
                                        </slide-y-down-transition>
                                    </md-field>
                                    <div class="under-input-notice" v-if="$v.width.$dirty">
                                        <slide-y-down-transition>
                                            <div class="text-danger" v-if="!$v.width.required">{{ $langLib({ field_name: 'Ширина' }).REQUIRED }}</div>
                                        </slide-y-down-transition>
                                        <slide-y-down-transition>
                                            <div class="text-danger" v-if="!$v.width.testWidth">{{ $langLib({ field_name: 'Ширина' }).NUM_DOT }}</div>
                                        </slide-y-down-transition>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md-layout md-gutter mt-2">
                            <div class="md-layout-item">
                                <h4 class="card-title">Миниатюра</h4>
                                <div class="form-group">
                                    <div class="file-input">
                                        <div v-if="!imageThumb">
                                            <div class="image-container">
                                                <img :src="regularImg" title="">
                                            </div>
                                        </div>
                                        <div class="image-container" v-else>
                                            <img :src="imageThumb"/>
                                        </div>
                                        <div class="button-container">
                                            <md-button class="md-danger md-just-icon" @click="removeImage('imageThumb')" v-if="imageThumb">
                                                <md-icon>undo</md-icon>
                                                <md-tooltip md-direction="top">Отменить</md-tooltip>
                                            </md-button>
                                            <md-button class="md-success md-just-icon md-fileinput">
                                                <template>
                                                    <md-icon>add_photo_alternate</md-icon>
                                                    <md-tooltip md-direction="top">Выберите изображение</md-tooltip>
                                                </template>
                                                <input type="file" name="thumb" @change="onThumbFileChange">
                                            </md-button>
                                        </div>
                                    </div>
                                    <div class="under-input-notice" v-if="$v.thumb.$dirty">
                                        <slide-y-down-transition>
                                            <div class="text-danger" v-if="!$v.thumb.required || !$v.thumb.isValid">{{ $langLib({ field_name: 'Миниатюра' }).REQUIRED }}</div>
                                        </slide-y-down-transition>
                                    </div>
                                </div>
                            </div>
                            <div class="md-layout-item">
                                <h4 class="card-title">Образец</h4>
                                <div class="form-group">
                                    <div class="file-input">
                                        <div v-if="!imageSample">
                                            <div class="image-container">
                                                <img :src="regularImg" title="">
                                            </div>
                                        </div>
                                        <div v-else class="image-container">
                                            <img :src="imageSample"/>
                                        </div>
                                        <div class="button-container">
                                            <md-button class="md-danger md-just-icon"
                                                       @click="removeImage('imageSample')" v-if="imageSample">
                                                <md-icon>undo</md-icon>
                                                <md-tooltip md-direction="top">Отменить</md-tooltip>
                                            </md-button>
                                            <md-button class="md-success md-just-icon md-fileinput">
                                                <template>
                                                    <md-icon>add_photo_alternate</md-icon>
                                                    <md-tooltip md-direction="top">Выберите изображение</md-tooltip>
                                                </template>
                                                <input type="file" name="sample" @change="onSampleFileChange">
                                            </md-button>
                                        </div>
                                    </div>
                                    <div class="under-input-notice" v-if="$v.sample.$dirty">
                                        <slide-y-down-transition>
                                            <div class="text-danger" v-if="!$v.sample.required || !$v.sample.isValid">{{ $langLib({ field_name: 'Образец' }).REQUIRED }}</div>
                                        </slide-y-down-transition>
                                    </div>
                                </div>
                            </div>
                            <div class="md-layout-item">
                                <h4 class="card-title">Фон</h4>
                                <div class="form-group">
                                    <div class="file-input">
                                        <div v-if="!imageBackground">
                                            <div class="image-container">
                                                <img :src="regularImg" title="">
                                            </div>
                                        </div>
                                        <div v-else class="image-container">
                                            <img :src="imageBackground"/>
                                        </div>
                                        <div class="button-container">
                                            <md-button class="md-danger md-just-icon" @click="removeImage('imageBackground')" v-if="imageBackground">
                                                <md-icon>undo</md-icon>
                                                <md-tooltip md-direction="top">Отменить</md-tooltip>
                                            </md-button>
                                            <md-button class="md-success md-just-icon md-fileinput">
                                                <template>
                                                    <md-icon>add_photo_alternate</md-icon>
                                                    <md-tooltip md-direction="top">Выберите изображение</md-tooltip>
                                                </template>
                                                <input type="file" name="background" @change="onBackgroundFileChange">
                                            </md-button>
                                        </div>
                                    </div>
                                    <div class="under-input-notice" v-if="$v.background.$dirty">
                                        <slide-y-down-transition>
                                            <div class="text-danger" v-if="!$v.background.required || !$v.background.isValid">{{ $langLib({ field_name: 'Фон' }).REQUIRED }}</div>
                                        </slide-y-down-transition>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <h4 class="card-title">Описание</h4>
                            <ckeditor :editor="editor" :config="editorConfig" :value="description" @input="onDescriptionChange"></ckeditor>
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
    import {mapState} from 'vuex'

    import swal from 'sweetalert2'
    import {required, minLength} from 'vuelidate/lib/validators'
    import {SlideYDownTransition} from 'vue2-transitions'
    import {Modal} from '@/components'

    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    const touchMap = new WeakMap();

    export default {
        name: 'MaterialCreate',
        components: {
            SlideYDownTransition,
            Modal
        },
        props: {
            regularImg: {
                type: String,
                default: '/img/image_placeholder.jpg'
            },
            result: [],
        },
        data() {
            return {
                responseData: false,
                imageRegular: '',
                imageThumb: '',
                imageSample: '',
                imageBackground: '',
                imageValid: false,
                thumbValid: false,
                sampleValid: false,
                backgroundValid: false,
                editor: ClassicEditor,
                editorConfig: {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|', 'undo', 'redo'],
                    heading: {
                        options: [
                            {model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph'},
                            {model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1'},
                            {model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2'},
                            {model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3'},
                            {model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4'},
                            {model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5'},
                            {model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6'}
                        ]
                    }
                }
            }
        },
        validations: {
            name: {
                required,
                touch: false,
                minLength: minLength(2),
                isUnique(value) {
                    if (value.trim() === '') return true;
                    if (this.$v.name.$dirty) {
                        return !this.isUniqueName;
                    }
                    return true;
                }
            },
            price: {
                required,
                touch: false,
                testPrice(value) {
                    if (value.trim() === '') return true;
                    if (this.$v.price.$dirty) {
                        return (/^[0-9]*[.]?[0-9]+$/).test(value);
                    }
                    return true;
                },
            },
            width: {
                required,
                touch: false,
                testWidth(value) {
                    if (value.trim() === '') return true;
                    if (this.$v.width.$dirty) {
                        return (/^[0-9]*[.]?[0-9]+$/).test(value);
                    }
                    return true;
                },
            },
            thumb: {
                required,
                isValid() {
                    return !this.isThumbValid;
                },
                touch: false
            },
            sample: {
                required,
                isValid() {
                    return !this.isSampleValid;
                },
                touch: false
            },
            background: {
                required,
                isValid() {
                    return !this.isBackgroundValid;
                },
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
            isThumbValid() {
                return !this.thumbValid;
            },
            isSampleValid() {
                return !this.sampleValid;
            },
            isBackgroundValid() {
                return !this.backgroundValid;
            },
            isUniqueName() {
                return !!this.$store.getters['materials/isUniqueName'](this.name);
            },
        },
        methods: {
            onThumbFileChange(e) {
                this.$v.thumb.$touch();
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0], 'imageThumb');
                this.$store.dispatch('materials/updateThumbField', files[0]);
            },
            onSampleFileChange(e) {
                this.$v.sample.$touch();
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0], 'imageSample');
                this.$store.dispatch('materials/updateSampleField', files[0]);
            },
            onBackgroundFileChange(e) {
                this.$v.background.$touch();
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0], 'imageBackground');
                this.$store.dispatch('materials/updateBackgroundField', files[0]);
            },
            createImage(file, imageType) {
                let reader = new FileReader();
                let vm = this;
                let image = imageType.replace('image', '').toLowerCase();

                reader.onload = (e) => {
                    if (imageType) {
                        vm[imageType] = e.target.result;
                    } else {
                        vm.imageRegular = e.target.result;
                    }
                };
                reader.readAsDataURL(file);
                if (imageType) {
                    this[image + 'Valid'] = true;
                } else {
                    this.imageValid = true;
                }
            },
            removeImage(imageType) {
                if (imageType) {
                    this[imageType] = '';
                    let image = imageType.replace('image', '').toLowerCase();
                    let imageUpperFirst = image[0].toUpperCase() + image.slice(1);
                    this.$v[image].$reset();
                    this.$store.dispatch(`materials/update${ imageUpperFirst }Field`, '');
                    this[image + 'Valid'] = false;
                } else {
                    this.imageRegular = '';
                    this.imageValid = false;
                }
            },
            onNameChange(value) {
                this.setValidationDelay(this.$v.name);
                this.$store.dispatch('materials/updateNameField', value.trim());
            },
            onPriceChange(value) {
                this.$v.price.$touch();
                this.$store.dispatch('materials/updatePriceField', value.trim());
            },
            onWidthChange(value) {
                this.$v.width.$touch();
                this.$store.dispatch('materials/updateWidthField', value.trim());
            },
            onDescriptionChange(value) {
                this.$store.dispatch('materials/updateDescriptionField', value);
            },
            onPublishChange() {
                this.$store.dispatch('materials/updatePublishField');
            },
            onCreate() {
                this.$store.dispatch('materials/createItem', {
                    name: this.name,
                    price: this.price,
                    width: this.width,
                    thumb: this.thumb,
                    sample: this.sample,
                    background: this.background,
                    description: this.description,
                    publish: +this.publish
                })
                    .then(() => {
                        swal.fire({
                            title: 'Материал создан!',
                            text: this.name,
                            timer: 2000,
                            showConfirmButton: false,
                            type: 'success'
                        });
                        this.$router.push({name: 'admin.materials'});
                    });
            },
            setValidationDelay(v) {
                v.$reset();
                if (touchMap.has(v)) {
                    clearTimeout(touchMap.get(v));
                }
                touchMap.set(v, setTimeout(v.$touch, 1000));
            }
        },
        created() {
            this.$store.dispatch('materials/getItems')
                .then(() => {
                    this.$store.dispatch('setPageTitle', 'Новый материал');
                    this.$store.dispatch('materials/clearFields');
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
