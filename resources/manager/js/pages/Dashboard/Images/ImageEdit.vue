<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card class="mt-0">
                    <md-card-content class="md-between">
                        <md-button class="md-info md-just-icon"
                                   @click="$router.go(-1) ? $router.go(-1) : $router.push(redirectRoute)">
                            <md-icon>arrow_back</md-icon>
                            <md-tooltip md-direction="right">Назад</md-tooltip>
                        </md-button>
                        <div>
                            <slide-y-down-transition v-show="controlSaveVisibilities && $v.$anyDirty">
                                <control-button @click="onUpdate"/>
                            </slide-y-down-transition>
                            <control-button title="Удалить" icon="delete" color="md-danger" @click="onDelete"/>
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
                        <v-textarea icon="title"
                                    name="description"
                                    :vField="$v.description"
                                    :differ="true"
                                    :value="description"
                                    :module="storeModule" />

                        <div class="space-30"></div>
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

                        <v-select v-if="topicList.length" title="Темы" placeholder="Выберите темы"
                                  :multiple="true"
                                  name="topics"
                                  :vField="$v.topics"
                                  :differ="true"
                                  :value="topics"
                                  :options="topicList"
                                  :module="storeModule" />

                        <v-select v-if="colorList.length" title="Цвета" placeholder="Выберите цвета"
                                  :multiple="true"
                                  name="colors"
                                  :vField="$v.colors"
                                  :differ="true"
                                  :value="colors"
                                  :options="colorList"
                                  :module="storeModule" />

                        <v-select v-if="interiorList.length" title="Интерьеры" placeholder="Выберите интерьеры"
                                  :multiple="true"
                                  name="interiors"
                                  :vField="$v.interiors"
                                  :differ="true"
                                  :value="interiors"
                                  :options="interiorList"
                                  :module="storeModule" />

                        <v-select v-if="tagList.length" title="Теги" placeholder="Выберите теги"
                                  :multiple="true"
                                  name="tags"
                                  :vField="$v.tags"
                                  :differ="true"
                                  :value="tags"
                                  :options="tagList"
                                  :module="storeModule" />

                        <v-select v-if="ownerList.length" title="Владельцы" placeholder="Выберите владельца"
                                  name="owner_id"
                                  :vField="$v.owner"
                                  :differ="true"
                                  :value="owner"
                                  :options="ownerList"
                                  :defaultValue="0"
                                  defaultTitle="Свое"
                                  :module="storeModule" />

                        <v-image name="image"
                                 :vField="$v.image"
                                 :imgDefault="item.path"
                                 :module="storeModule" />

                        <v-switch :vField="$v.publish"
                                  :differ="true"
                                  :value="publish"
                                  :module="storeModule" />

                    </md-card-content>
                </md-card>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'

    import { pageTitle } from '@/mixins/base'
    import { updateMethod, deleteMethod } from '@/mixins/crudMethods'

    import VSelect from "@/custom_components/VForm/VSelect";

    export default {
        name: 'ImageEdit',
        components: { VSelect },
        mixins: [
            pageTitle,
            updateMethod,
            deleteMethod
        ],
        props: {
            id: {
                type: [ Number, String ],
                required: true
            },
            page: {
                type: Number,
                default: null
            },
            result: []
        },
        data() {
            return {
                storeModule: 'images',
                responseData: false,
                controlSaveVisibilities: false,
                redirectRoute: { name: 'manager.images' }
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
            tags: {
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
                image: state => state.fields.image,
                publish: state => state.fields.publish,
                topics: state => state.fields.topics,
                colors: state => state.fields.colors,
                interiors: state => state.fields.interiors,
                owner: state => state.fields.owner_id,
                tags: state => state.fields.tags,
                description: state => state.fields.description,
            }),
            ...mapState({
                ownerList: state => state.subCategories.itemsByType.owners,
                tagList: state => state.subCategories.itemsByType.tags
            }),
            topicList () {
                return this.$store.getters['categories/getItemsByType']('topics');
            },
            colorList () {
                return this.$store.getters['categories/getItemsByType']('colors');
            },
            interiorList () {
                return this.$store.getters['categories/getItemsByType']('interiors');
            }
        },
        methods: {
            ...mapActions({
                getItemAction: 'images/getItem',
                clearFieldsAction: 'images/clearFields',
                getCategoriesAction: 'categories/getItems',
                getSubcategoriesAction: 'subCategories/getItemsWithType',
                setPreviousPageAction: 'images/setPreviousPage'
            }),
            onUpdate () {
                return this.update({
                    sendData: {
                        formData: {
                            image: this.image,
                            publish: +this.publish,
                            topics: this.topics,
                            colors: this.colors,
                            interiors: this.interiors,
                            owner_id: this.owner,
                            tags: this.tags,
                            description: this.description
                        },
                        id: this.id
                    },
                    title: this.item.article,
                    successText: 'Изображение обновлено!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                });
            },
            onDelete () {
                return this.delete({
                    payload: this.id,
                    title: this.item.article,
                    alertText: `изображение «${this.item.article}»`,
                    successText: 'Изображение удалено!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                })
            }
        },
        async created() {
            await this.clearFieldsAction();
            await this.getItemAction(this.id)
                .then(() => this.getCategoriesAction())
                .then(() => this.getSubcategoriesAction('tags'))
                .then(() => this.getSubcategoriesAction('owners'))
                .then(() => {
                    this.setPageTitle(`Изображение «${this.item.article}»`);
                    this.responseData = true;
                })
                .then(() => {
                    this.$v.$reset();
                    this.controlSaveVisibilities = true;
                })
                .catch(() => {
                    this.$router.go(-1) ? this.$router.go(-1) : this.$router.push(this.redirectRoute)
                });
            await this.setPreviousPageAction(this.page);
        }
    }
</script>
