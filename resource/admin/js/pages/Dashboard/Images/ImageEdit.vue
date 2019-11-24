<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card class="mt-0">
                    <md-card-content class="md-between">
                        <div>
                            <md-button class="md-info md-just-icon" @click="$router.go(-1)">
                                <md-icon>arrow_back</md-icon>
                                <md-tooltip md-direction="right">Назад</md-tooltip>
                            </md-button>
                        </div>
                        <div>
                            <slide-y-down-transition v-if="controlSaveVisibilities && $v.$anyDirty">
                                <md-button class="md-success md-just-icon" @click.native="onUpdate('auto-close')">
                                    <md-icon>check</md-icon>
                                    <md-tooltip md-direction="right">Сохранить</md-tooltip>
                                </md-button>
                            </slide-y-down-transition>
                            <md-button class="md-danger md-just-icon" @click.native="onDelete('auto-close')">
                                <md-icon>delete</md-icon>
                                <md-tooltip md-direction="left">Удалить</md-tooltip>
                            </md-button>
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
                            <md-icon>info</md-icon>
                        </div>
                        <h3 class="title">Информация</h3>
                    </md-card-header>
                    <md-card-content>
                        <h4 class="card-title mb-0">Артикул</h4>
                        <h3 class="mt-0"><small>{{ item.article }}</small></h3>
                        <h4 class="card-title mb-0">Форма</h4>
                        <h3 class="mt-0"><small>{{ item.proportion }}</small></h3>
                        <h4 class="card-title mb-0">Просмотры</h4>
                        <h3 class="mt-0"><small>{{ item.views }}</small></h3>
                        <h4 class="card-title mb-0">Лайки</h4>
                        <h3 class="mt-0"><small>{{ item.likes }}</small></h3>
                        <h4 class="card-title mb-0">Заказы</h4>
                        <h3 class="mt-0"><small>{{ item.orders }}</small></h3>
                    </md-card-content>
                </md-card>
                <md-card>
                    <md-card-content>
                        <h4 class="card-title">Описание</h4>
                        <div class="form-group">
                            <md-field>
                                <md-textarea
                                    name="description"
                                    @input="onDescriptionChange"
                                    :value="itemDescriptionField"
                                    maxlength="1000"></md-textarea>
                            </md-field>
                        </div>
                    </md-card-content>
                </md-card>
            </div>
            <div class="md-layout-item md-medium-size-50 md-small-size-100">
                <md-card>
                    <md-card-header class="md-card-header-icon md-card-header-green">
                        <div class="card-icon">
                            <md-icon>settings</md-icon>
                        </div>
                        <h3 class="title">Установки</h3>
                    </md-card-header>
                    <md-card-content>
                        <template v-if="topicList.length">
                            <h4 class="card-title">Темы</h4>
                            <md-field>
                                <label for="topics">Выберите темы</label>
                                <md-select v-model="selectedTopics" @md-selected="onSelectTopicsChange" name="topics" id="topics" multiple>
                                    <md-option v-for="(item, index) in topicList" :value="item.id" :key="index">
                                        {{ item.title }}
                                    </md-option>
                                </md-select>
                            </md-field>
                        </template>
                        <template v-if="colorList.length">
                            <h4 class="card-title">Цвета</h4>
                            <md-field>
                                <label for="colors">Выберите цвета</label>
                                <md-select v-model="selectedColors" @md-selected="onSelectColorsChange" name="colors" id="colors" multiple>
                                    <md-option v-for="(item, index) in colorList" :value="item.id" :key="index">
                                        {{ item.title }}
                                    </md-option>
                                </md-select>
                            </md-field>
                        </template>
                        <template v-if="placementList.length">
                            <h4 class="card-title">Помещения</h4>
                            <md-field>
                                <label for="placements">Выберите помещения</label>
                                <md-select v-model="selectedPlacements" @md-selected="onSelectPlacementsChange"
                                           name="placements" id="placements" multiple>
                                    <md-option :value="item.id" v-for="(item, index) in placementList" :key="index">
                                        {{ item.title }}
                                    </md-option>
                                </md-select>
                            </md-field>
                        </template>
                        <template v-if="ownerList.length">
                            <h4 class="card-title">Владельцы</h4>
                            <md-field>
                                <label for="owner">Выберите владельца</label>
                                <md-select v-model="selectedOwner" @md-selected="onSelectOwnerChange" name="owner"
                                           id="owner_id">
                                    <md-option value="0">Свое</md-option>
                                    <md-option :value="item.id" v-for="(item, index) in ownerList" :key="index">
                                        {{ item.title }}
                                    </md-option>
                                </md-select>
                            </md-field>
                        </template>
                        <h4 class="card-title">Изображение</h4>
                        <div class="form-group">
                            <div class="file-input">
                                <div v-if="!imageRegular">
                                    <div class="image-container">
                                        <img :src="'/image/widen/400/' + item.path" :alt="item.id">
                                    </div>
                                </div>
                                <div class="image-container" v-else>
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
                        </div>
                        <h4 class="card-title">Опубликовать</h4>
                        <md-switch :value="!itemPublishField" @change="onPublishChange"></md-switch>
                    </md-card-content>
                </md-card>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex'

    import swal from 'sweetalert2'
    import {SlideYDownTransition} from 'vue2-transitions'
    import {Modal} from '@/components'

    export default {
        name: 'ImageEdit',
        components: {
            SlideYDownTransition,
            Modal
        },
        props: {
            id: {
                type: [Number, String],
                required: true
            },
            result: []
        },
        data() {
            return {
                imageRegular: '',
                responseData: false,
                controlSaveVisibilities: false,
                selectedTopics: [],
                selectedColors: [],
                selectedPlacements: [],
                selectedOwner: ''
            }
        },
        validations: {
            image: {
                touch: false
            },
            publish: {
                touch: false
            },
            topics: {
                touch: false
            },
            colors: {
                touch: false
            },
            placements: {
                touch: false
            },
            owner: {
                touch: false
            },
            description: {
                touch: false
            }
        },
        computed: {
            ...mapState('images', {
                item: state => state.item,
                itemImageField: state => state.fields.image,
                itemPublishField: state => state.fields.publish,
                itemTopicsField: state => state.fields.topics,
                itemColorsField: state => state.fields.colors,
                itemPlacementsField: state => state.fields.placements,
                itemOwnerField: state => state.fields.owner,
                itemDescriptionField: state => state.fields.description,
            }),
            ...mapState('categories', {
                topicList: state => state.items['topics'],
                colorList: state => state.items['colors'],
                placementList: state => state.items['placements'],
                ownerList: state => state.items['owners'],
            })
        },
        methods: {
            onSelectTopicsChange() {
                this.$v.topics.$touch();
                this.$store.dispatch('images/updateTopicsField', this.selectedTopics);
            },
            onSelectColorsChange() {
                this.$v.colors.$touch();
                this.$store.dispatch('images/updateColorsField', this.selectedColors);
            },
            onSelectPlacementsChange() {
                this.$v.placements.$touch();
                this.$store.dispatch('images/updatePlacementsField', this.selectedPlacements);
            },
            onSelectOwnerChange() {
                this.$v.placements.$touch();
                this.$store.dispatch('images/updateOwnerField', this.selectedOwner);
            },
            onDescriptionChange(value) {
                this.$v.description.$touch();
                this.$store.dispatch('images/updateDescriptionField', value.trim());
            },
            onFileChange(e) {
                this.$v.image.$touch();
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
                this.$store.dispatch('images/updateImageField', e.target.files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;

                reader.onload = (e) => vm.imageRegular = e.target.result;
                reader.readAsDataURL(file);
            },
            removeImage() {
                this.imageRegular = '';
                this.$store.dispatch('images/updateImageField', '');
            },
            onUpdate() {
                this.$store.dispatch('images/updateItem', {
                    formData: {
                        image: this.itemImageField,
                        publish: +this.itemPublishField,
                        topics: this.itemTopicsField,
                        colors: this.itemColorsField,
                        placements: this.itemPlacementsField,
                        owner: this.itemOwnerField,
                        description: this.itemDescriptionField
                    },
                    id: this.id
                })
                    .then(() => {
                        swal.fire({
                            title: 'Изображение обновлено!',
                            text: `«${this.item.article}»`,
                            timer: 2000,
                            showConfirmButton: false,
                            type: 'success'
                        });
                        this.$router.go(-1) ? this.$router.go(-1) : this.$router.push({name: 'admin.images'});
                    });
            },
            onDelete() {
                swal.fire({
                    title: 'Вы уверены?',
                    text: `Данное действие удалит Изображение «${this.item.article}» безвозвратно!`,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'md-button md-success btn-fill',
                    cancelButtonClass: 'md-button md-danger btn-fill',
                    confirmButtonText: 'Удалить',
                    cancelButtonText: 'Отменить',
                    buttonsStyling: false
                }).then((result) => {
                    if (result.value) {
                        this.$store.dispatch('images/deleteItem', this.id)
                            .then(() => {
                                swal.fire({
                                    title: 'Изображение удалено!',
                                    text: `«${this.item.article}»`,
                                    timer: 2000,
                                    type: 'success',
                                    showConfirmButton: false
                                });
                                this.$router.go(-1) ? this.$router.go(-1) : this.$router.push({name: 'admin.images'});
                            });
                    }
                });
            },
            onPublishChange() {
                this.$v.publish.$touch();
                this.$store.dispatch('images/updatePublishField');
            }
        },
        async created() {
            await this.$store.dispatch('images/clearFields');
            await this.$store.dispatch('images/getItem', this.id)
                .then(() => this.$store.dispatch('categories/getItems', 'topics'))
                .then(() => this.$store.dispatch('categories/getItems', 'colors'))
                .then(() => this.$store.dispatch('categories/getItems', 'placements'))
                .then(() => this.$store.dispatch('categories/getItems', 'owners'))
                .then(() => {
                    this.$store.dispatch('setPageTitle', `Изображение «${this.item.article}»`);
                    this.selectedTopics = this.itemTopicsField;
                    this.selectedColors = this.itemColorsField;
                    this.selectedPlacements = this.itemPlacementsField;
                    this.selectedOwner = this.itemOwnerField;
                    this.responseData = true;
                })
                .then(() => {
                    this.$v.$reset();
                    this.controlSaveVisibilities = true;
                })
                .catch(() => {
                    this.$router.go(-1) ? this.$router.go(-1) : this.$router.push({name: 'admin.images'})
                });
        }
    }
</script>
