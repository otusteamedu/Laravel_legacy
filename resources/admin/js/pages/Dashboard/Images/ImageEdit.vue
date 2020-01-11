<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card class="mt-0">
                    <md-card-content class="md-between">
                        <md-button class="md-info md-just-icon"
                                   @click="$router.go(-1) ? $router.go(-1) : $router.push({ name: 'manager.images' })">
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
                        <h3 class="mt-0"><small>{{ item.format }}</small></h3>
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
                                    @input="onFieldChange('description', $event)"
                                    :value="itemDescriptionField"
                                    maxlength="1000"
                                />
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
                        <vee-select v-if="topics.length" title="Темы" placeholder="Выберите темы"
                                    :multiple="true"
                                    :value="itemTopicsField"
                                    :options="topics"
                                    @selected="onSelectChange('topics', $event)" />
                        <vee-select v-if="colors.length" title="Цвета" placeholder="Выберите цвета"
                                    :multiple="true"
                                    :value="itemColorsField"
                                    :options="colors"
                                    @selected="onSelectChange('colors', $event)" />
                        <vee-select v-if="interiors.length" title="Интерьеры" placeholder="Выберите интерьеры"
                                    :multiple="true"
                                    :value="itemInteriorsField"
                                    :options="interiors"
                                    @selected="onSelectChange('interiors', $event)" />
                        <vee-select v-if="tags.length" title="Теги" placeholder="Выберите теги"
                                    :multiple="true"
                                    :value="itemTagsField"
                                    :options="tags"
                                    @selected="onSelectChange('tags', $event)" />
                        <vee-select v-if="owners.length" title="Владельцы" placeholder="Выберите владельца"
                                    :defaultValue="{ value: 0, title: 'Свое' }"
                                    :value="itemOwnerField"
                                    :options="owners"
                                    @selected="onSelectChange('owner', $event)" />
                        <vee-image :image="imageFile" :imageDefault="item.path"
                                   :vImage="$v.image"
                                   @remove="onImageRemove('imageFile', updateImageFieldAction, 'image')"
                                   @change="onImageChange('image', 'imageFile',  updateImageFieldAction, $event)"/>
                        <h4 class="card-title">Опубликовать</h4>
                        <md-switch :value="!itemPublishField" @change="onPublishChange" />
                    </md-card-content>
                </md-card>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'

    import VeeSelect from '@/custom_components/VeeForm/VeeSelect'
    import { pageTitle } from '@/mixins/base'
    import { uploadImage } from '@/mixins/uploadImage'
    import { changeSelect, changeField, changePublishEdit } from '@/mixins/changingFields'
    import { updateMethod, deleteMethod } from '@/mixins/crudMethods'

    export default {
        name: 'ImageEdit',
        components: {
            VeeSelect
        },
        mixins: [
            pageTitle,
            uploadImage,
            changeSelect,
            changeField,
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
                storeModule: 'images',
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
            interiors: {
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
                itemInteriorsField: state => state.fields.interiors,
                itemOwnerField: state => state.fields.owner_id,
                itemTagsField: state => state.fields.tags,
                itemDescriptionField: state => state.fields.description,
            }),
            ...mapState({
                owners: state => state.subCategories.itemsByType.owners,
                tags: state => state.subCategories.itemsByType.tags
            }),
            topics () {
                return this.$store.getters['categories/getItemsByType']('topics');
            },
            colors () {
                return this.$store.getters['categories/getItemsByType']('colors');
            },
            interiors () {
                return this.$store.getters['categories/getItemsByType']('interiors');
            }
        },
        methods: {
            ...mapActions({
                showAction: 'images/show',
                clearFieldsAction: 'images/clearFields',
                updateImageFieldAction: 'images/updateImageField',
                indexCategoryAction: 'categories/index',
                indexSubcategoryAction: 'subCategories/indexByType'
            }),
            onUpdate () {
                return this.update({
                    sendData: {
                        formData: {
                            image: this.itemImageField,
                            publish: +this.itemPublishField,
                            topics: this.itemTopicsField,
                            colors: this.itemColorsField,
                            interiors: this.itemInteriorsField,
                            owner_id: +this.itemOwnerField,
                            tags: this.itemTagsField,
                            description: this.itemDescriptionField
                        },
                        id: this.id
                    },
                    title: this.item.article,
                    successText: 'Изображение обновлено!',
                    storeModule: this.storeModule,
                    redirectRoute: { name: 'manager.images' }
                });
            },
            onDelete () {
                return this.delete({
                    payload: this.id,
                    title: this.item.article,
                    alertText: `изображение «${this.item.article}»`,
                    successText: 'Изображение удалено!',
                    storeModule: this.storeModule,
                    redirectRoute: { name: 'manager.images' }
                })
            }
        },
        async created() {
            await this.clearFieldsAction();
            await this.showAction(this.id)
                .then(() => this.indexCategoryAction())
                .then(() => this.indexSubcategoryAction('tags'))
                .then(() => this.indexSubcategoryAction('owners'))
                .then(() => {
                    this.setPageTitle(`Изображение «${this.item.article}»`);
                    this.responseData = true;
                })
                .then(() => {
                    this.$v.$reset();
                    this.controlSaveVisibilities = true;
                })
                .catch(() => {
                    this.$router.go(-1) ? this.$router.go(-1) : this.$router.push({ name: 'manager.images' })
                });
        }
    }
</script>
