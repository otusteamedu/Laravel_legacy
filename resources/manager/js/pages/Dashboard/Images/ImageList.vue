<template>
    <div v-if="responseData">

        <div class="md-layout">
            <div class="md-layout-item">
                <md-card class="mt-0">
                    <md-card-content class="md-between">
                        <router-button-link v-if="category_type === 'images'"
                            route="manager.dashboard"
                        />
                        <router-button-link v-else
                            route="manager.catalog.categories.list"
                            :params="{ category_type }"
                        />
                        <div>
                            <router-button-link v-if="category_type !== 'images'"
                                icon="add"
                                color="md-success"
                                title="Добавить изображения"
                                route="manager.catalog.categories.images.excluded"
                                :params="{ id }" />
                            <upload-button @change="fileInputChange" />
                        </div>
                    </md-card-content>
                </md-card>
            </div>
        </div>

        <div class="md-layout">
            <div class="md-layout-item">
                <div class="md-layout-item md-progress-bar__container">
                    <md-progress-bar v-if="fileProgress" class="md-info" :md-value="fileProgress" />
                </div>
                <md-card>
                    <card-icon-header title="Каталог изображений" icon="image" />
                    <md-card-content>
                        <image-list-table v-if="items.length"
                                          :items="items"
                                          @publish="onPublishChange">

                            <template #actions-column="{ item }">
                                <md-table-cell v-if="item" md-label="Действия">
                                    <image-table-actions :item="item"
                                                         :remove="isCategoryPage"
                                                         @remove="onRemove"
                                                         @delete="onDelete"/>
                                </md-table-cell>
                            </template>

                        </image-list-table>

                        <template v-else>
                            <div class="alert alert-info">
                                <span><h3>Пока нет изображений!</h3></span>
                            </div>
                        </template>
                    </md-card-content>
                </md-card>
            </div>
        </div>

    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'

    import { pageTitle } from '@/mixins/base'
    import { deleteMethod, uploadMethod } from '@/mixins/crudMethods'

    import ImageListTable from "@/custom_components/Tables/ImageListTable";
    import ImageTableActions from "@/custom_components/Tables/ImageTableActions";

    export default {
        name: 'ImageList',
        mixins: [
            pageTitle,
            deleteMethod,
            uploadMethod
        ],
        components: {
            ImageListTable,
            ImageTableActions
        },
        props: {
            category_type: {
                type: String,
                default: 'images'
            },
            id: {
                type: [ Number, String ],
                default: null
            }
        },
        data () {
            return {
                responseData: false,
                storeModule: 'images'
            }
        },
        computed: {
            ...mapState({
                category: state => state.categories.item,
                items: state => state.images.items,
                fileProgress: state => state.images.fileProgress
            }),
            isCategoryPage() {
                return this.category_type !== 'images';
            }
        },
        methods: {
            ...mapActions('images', {
                indexAction: 'index',
                publishAction: 'publish'
            }),
            ...mapActions({
                removeImage: 'categories/removeImage',
                getCategoryWithImages: 'categories/showWithImages'
            }),
            init (category_type) {
                if (category_type !== 'images') {
                    this.getCategoryWithImages(this.id)
                        .then(() => {
                            this.setPageTitle(`Изображения категории «${this.category.title}»`);
                            this.responseData = true;
                        })
                        .catch(() => this.$router.push({
                            name: 'manager.catalog.categories.list',
                            params: {category_type: this.category_type}
                        }));
                } else {
                    this.indexAction()
                        .then(() => {
                            this.setPageTitle('Изображения');
                            this.responseData = true;
                        })
                        .catch(() => this.$router.push({ name: 'manager.dashboard' }));
                }
            },
            fileInputChange (event) {
                this.upload({
                    uploadFiles: event.target.files,
                    type: this.category_type,
                    id: this.id
                });
            },
            onRemove (id) {
                this.removeImage({
                    category_id: this.id,
                    image_id: id
                })
            },
            onDelete (item) {
                this.delete({
                    payload: item.id,
                    title: item.id,
                    alertText: `изображение «${item.id}»`,
                    successText: 'Изображение удалено!',
                    storeModule: this.storeModule
                });
            },
            onPublishChange (id) {
                this.publishAction(id);
            }
        },
        created () {
            this.init(this.category_type);
        }
    }
</script>

<style lang="scss" scoped>
    .md-between {
        display: flex;
        justify-content: space-between;
    }
    .md-progress-bar__container {
        height: 4px;
    }
</style>
