<template>
    <div>
        <h4 class="card-title">{{ title }}</h4>
        <div class="form-group">
            <div class="file-input">
                <div v-if="!image">
                    <div class="image-container">
                        <img :src="imageDefault" alt="">
                    </div>
                </div>
                <div v-else class="image-container">
                    <img :src="image" alt=""/>
                </div>
                <div class="button-container">
                    <md-button class="md-danger md-just-icon" @click="removeImage" v-if="image">
                        <md-icon>undo</md-icon>
                        <md-tooltip md-direction="top">Отменить</md-tooltip>
                    </md-button>
                    <md-button class="md-success md-just-icon md-fileinput">
                        <template>
                            <md-icon>add_photo_alternate</md-icon>
                            <md-tooltip md-direction="top">Выберите изображение</md-tooltip>
                        </template>
                        <input type="file" @change="onFileChange">
                    </md-button>
                </div>
            </div>
            <div class="under-input-notice" v-if="vImage.$error">
                <input-notification-require v-if="!vImage.required && vRules.required" :name="title" />
            </div>
        </div>
    </div>
</template>

<script>
    import { InputNotificationRequire } from '@/custom_components/InputNotifications'

    export default {
        name: "VeeImage",
        components: {
            InputNotificationRequire
        },
        props: {
            vImage: {
                type: Object,
                required: true
            },
            image: {
                type: String,
                default: ''
            },
            imageDefault: {
                type: String,
                default: '/img/image_placeholder.jpg'
            },
            vRules: {
                type: Object,
                default: null
            },
            title: {
                type: String,
                default: 'Изображение'
            }
        },
        methods: {
            removeImage () {
                this.$emit('remove');
            },
            onFileChange (event) {
                this.$emit('change', event);
            }
        }
    }
</script>
