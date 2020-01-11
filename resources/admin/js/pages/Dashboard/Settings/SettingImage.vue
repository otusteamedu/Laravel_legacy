<template>
    <div class="md-layout">
        <div class="md-layout-item">
            <h4 class="card-title">{{ title }}</h4>
            <div class="form-group">
                <div class="file-input">
                    <div v-if="!imageData">
                        <div class="image-container">
                            <img v-if="value" :src="`/image/widen/400/${value}`" alt="">
                            <img v-else src="/img/image_placeholder.jpg" alt="">
                        </div>
                    </div>
                    <div v-else class="image-container">
                        <img :src="imageData" alt="" />
                    </div>
                    <div class="button-container">
                        <md-button class="md-success md-just-icon md-fileinput">
                            <template>
                                <md-icon>add_photo_alternate</md-icon>
                                <md-tooltip md-direction="top">Выберите изображение</md-tooltip>
                            </template>
                            <input :type="type" :name="name" @change="onFileChange" />
                        </md-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'setting-image',
        props: {
            title: String,
            name: String,
            value: {
                type: String,
                default: ''
            },
            onSave: Function,
            type: {
                default: 'file',
                type: String
            }
        },
        data () {
            return {
                imageData: '',
                imagePlaceholder: '/img/image_placeholder.jpg'
            }
        },
        methods: {
            onFileChange(e) {
                const files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
                this.onSave({
                    key_name: this.name,
                    value: e.target.files[0]
                });
            },
            createImage(file) {
                const reader = new FileReader();
                const vm = this;

                reader.onload = (e) => {
                    vm.imageData = e.target.result;
                };
                reader.readAsDataURL(file);
            },
        }
    }
</script>
