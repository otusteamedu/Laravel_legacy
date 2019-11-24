<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card class="mt-0">
                    <md-card-content class="md-between">
                        <md-button class="md-info md-just-icon" @click="$router.go(-1)">
                            <md-icon>arrow_back</md-icon>
                            <md-tooltip md-direction="right">Назад</md-tooltip>
                        </md-button>
                        <div>
                            <slide-y-down-transition v-show="controlSaveVisibilities && $v.$anyDirty">
                                <control-button @click="onUpdate('auto-close')"/>
                            </slide-y-down-transition>
                            <control-button title="Удалить" icon="delete" color="md-danger" @click="onDelete('auto-close')"/>
                        </div>
                    </md-card-content>
                </md-card>
            </div>
        </div>
        <div class="md-layout">
            <div class="md-layout-item md-medium-size-50 md-small-size-100">
                <md-card>
                    <card-icon-header title="Информация" icon="info"/>
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
                    <card-icon-header icon="description" title=""/>
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
                            <div class="space-30"></div>
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
                        <vee-select v-if="topicList.length" title="Темы" placeholder="Выберите темы"
                                    :multiple="true"
                                    :value="itemTopicsField"
                                    :options="topicList"
                                    @selected="onTopicsChange" />
                        <vee-select v-if="colorList.length" title="Цвета" placeholder="Выберите цвета"
                                    :multiple="true"
                                    :value="itemColorsField"
                                    :options="colorList"
                                    @selected="onColorsChange" />
                        <vee-select v-if="placementList.length" title="Помещения" placeholder="Выберите помещения"
                                    :multiple="true"
                                    :value="itemPlacementsField"
                                    :options="placementList"
                                    @selected="onPlacementsChange" />
                        <vee-select v-if="ownerList.length" title="Владельцы" placeholder="Выберите владельца"
                                    :defaultValue="{ value: 0, title: 'Свое' }"
                                    :value="itemOwnerField"
                                    :options="ownerList"
                                    @selected="onOwnerChange" />
                        <vee-image :image="imageFile" :imageDefault="`/image/widen/400/${item.path}`"
                                   :vImage="$v.image"
                                   @remove="removeImage"
                                   @change="onFileChange"/>
                        <h4 class="card-title">Опубликовать</h4>
                        <md-switch :value="!itemPublishField" @change="onPublishChange"></md-switch>
                    </md-card-content>
                </md-card>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'

    import { SlideYDownTransition } from 'vue2-transitions'

    import VeeSelect from '@/custom_components/VeeForm/VeeSelect'

    import { pageTitle } from '@/mixins/actions'
    import { uploadImage } from '@/mixins/uploadImage'
    import { changeTopics, changeColors, changePlacements, changeOwner, changeDescription, changePublishEdit } from '@/mixins/changingFields'
    import { updateMethod, deleteMethod } from '@/mixins/crudMethods'

    export default {
        name: 'ImageEdit',
        components: {
            SlideYDownTransition,
            VeeSelect
        },
        mixins: [
            pageTitle,
            uploadImage,
            changeTopics,
            changeColors,
            changePlacements,
            changeOwner,
            changeDescription,
            changePublishEdit,
            updateMethod,
            deleteMethod
        ],
        props: {
            id: {
                type: [ Number, String ],
                required: true
            },
            result: []
        },
        data() {
            return {
                store_module: 'images',
                imageFile: '',
                responseData: false,
                controlSaveVisibilities: false
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
                topicList: state => state.items.topics,
                colorList: state => state.items.colors,
                placementList: state => state.items.placements,
                ownerList: state => state.items.owners,
            })
        },
        methods: {
            ...mapActions('images', [
                'getItem',
                'updateItem',
                'deleteItem',
                'clearFields'
            ]),
            ...mapActions('categories', {
                getCategoryList: 'getItems'
            }),
            onUpdate () {
                this.update({
                    sendData: {
                        formData: {
                            image: this.itemImageField,
                            publish: +this.itemPublishField,
                            topics: this.itemTopicsField,
                            colors: this.itemColorsField,
                            placements: this.itemPlacementsField,
                            owner: +this.itemOwnerField,
                            description: this.itemDescriptionField
                        },
                        id: this.id
                    },
                    title: this.item.article,
                    redirectName: 'admin.images',
                    successText: 'Изображение обновлено!'
                });
            },
            onDelete () {
                this.delete({
                    id: this.id,
                    title: this.item.article,
                    alertText: `изображение «${this.item.article}»`,
                    successText: 'Изображение удалено!',
                    redirectName: 'admin.images'
                })
            }
        },
        async created() {
            await this.clearFields();
            await this.getItem(this.id)
                .then(() => this.getCategoryList('topics'))
                .then(() => this.getCategoryList('colors'))
                .then(() => this.getCategoryList('placements'))
                .then(() => this.getCategoryList('owners'))
                .then(() => {
                    this.setPageTitle(`Изображение «${this.item.article}»`);
                    this.responseData = true;
                })
                .then(() => {
                    this.$v.$reset();
                    this.controlSaveVisibilities = true;
                })
                .catch(() => {
                    this.$router.go(-1) ? this.$router.go(-1) : this.$router.push({ name: 'admin.images' })
                });
        }
    }
</script>
