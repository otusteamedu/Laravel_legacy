<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card class="mt-0">
                    <md-card-content class="md-between">
                        <router-button-link
                            :route="redirectRoute.name"
                            :params="redirectRoute.params"
                        />
                        <div>
                            <router-button-link
                                icon="add"
                                color="md-success"
                                title="Добавить изображения"
                                route="manager.catalog.subcategories.images.excluded"
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

                            <template #first-column="{ item }">
                                <md-table-cell md-label="#" md-sort-by="id" style="width: 50px">
                                    {{ item.id }}
                                </md-table-cell>
                            </template>

                            <template #actions-column="{ item }">
                                <md-table-cell v-if="item" md-label="Действия">
                                    <image-table-actions :item="item" @delete="onDelete"/>
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
                pagination: {
                    perPage: 50,
                    perPageOptions: [ 50, 200, 500, 1000 ],
                },
                responseData: false,
                storeModule: 'images',
                redirectRoute: {
                    name: 'manager.catalog.subcategories.list',
                    params: {category_type: this.category_type}
                }
            }
        },
        computed: {
            ...mapState({
                category: state => state.subCategories.item,
                items: state => state.images.items,
                fileProgress: state => state.images.fileProgress
            })
        },
        methods: {
            ...mapActions('images', {
                indexAction: 'index',
                publishAction: 'publish'
            }),
            ...mapActions({
                removeImage: 'subCategories/removeImage',
                getCategoryWithImages: 'subCategories/showWithImages'
            }),
            init (category_type) {
                this.getCategoryWithImages({ type: category_type, id: this.id })
                    .then(() => {
                        this.setPageTitle(`Изображения категории «${this.category.title}»`);
                        this.responseData = true;
                    })
                    .catch(() => this.$router.push(this.redirectRoute));
            },
            fileInputChange (event) {
                this.upload({
                    uploadFiles: event.target.files,
                    type: this.category_type,
                    id: this.id,
                    storeModule: 'subCategories'
                });
            },
            onRemove (id) {
                this.removeImage({
                    type: this.category_type,
                    id: this.id,
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
