<template>
    <div>
        <h4 class="card-title">{{ title }}</h4>
        <div class="form-group">
            <div class="file-input">
                <div v-if="!imageData">
                    <div class="image-container">
                        <img v-if="imgDefault" :src="`/image/widen/400/${imgDefault}`" alt="">
                        <img v-else :src="imagePlaceholder" alt="">
                    </div>
                </div>
                <div v-else class="image-container">
                    <img :src="imageData" alt="" />
                </div>
                <div class="button-container">
                    <md-button class="md-danger md-just-icon" @click="onFileChange($event, 'remove')" v-if="imageData">
                        <md-icon>undo</md-icon>
                        <md-tooltip md-direction="top">Отменить</md-tooltip>
                    </md-button>
                    <md-button class="md-success md-just-icon md-fileinput">
                        <template>
                            <md-icon>add_photo_alternate</md-icon>
                            <md-tooltip md-direction="top">Выберите изображение</md-tooltip>
                        </template>
                        <input type="file" @change="onFileChange($event)">
                    </md-button>
                </div>
            </div>
            <div class="under-input-notice" v-if="vField && vRules && vField.$error">
                <input-notification-require v-if="!vField.required && vRules.required" :name="title" />
            </div>
        </div>
    </div>
</template>

<script>
    import { InputNotificationRequire } from '@/custom_components/InputNotifications'

    export default {
        name: "VImage",
        components: {
            InputNotificationRequire
        },
        props: {
            title: {
                type: String,
                default: 'Изображение'
            },
            name: {
                type: String,
                default: 'image'
            },
            vField: {
                type: Object,
                default: null
            },
            imgDefault: {
                type: String,
                default: null
            },
            vRules: {
                type: Object,
                default: null
            },
            module: {
                type: String,
                default: null
            }
        },
        data() {
            return {
                imageData: '',
                imagePlaceholder: '/img/image_placeholder.jpg'
            }
        },
        computed: {
            storeModule() {
                return this.module ? `${this.module}/` : '';
            }
        },
        methods: {
            onFileChange (e, action = 'change') {
                switch(action) {
                    case 'change':
                        this.addImage(e);
                        break;

                    case 'remove':
                        this.removeImage();
                        break;

                    default:
                        break;
                }
            },

            addImage (e) {
                let files = e.target.files || e.dataTransfer.files;

                if (!files.length)
                    return;

                this.createImage(files[0]);

                if (this.vField)
                    this.vField.$touch();

                this.fileAction(files[0]);
            },

            removeImage () {
                this.imageData = '';

                if (this.vField && this.imgDefault)
                    this.vField.$reset();

                this.fileAction('');
            },

            createImage (file) {
                const reader = new FileReader();
                const vm = this;

                reader.onload = (e) => {
                    vm.imageData = e.target.result;
                };

                reader.readAsDataURL(file);
            },

            fileAction (value) {
                this.$store.dispatch(`${this.storeModule}updateField`, { field: this.name, value });
            }
        }
    }
</script>
