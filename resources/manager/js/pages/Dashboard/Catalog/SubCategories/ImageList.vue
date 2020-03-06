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
                                          @search="handleSearch"
                                          @changePage="changePage"
                                          @changeSort="changeSort"
                                          @publish="onPublishChange">

                            <template #actions-column="{ item }">
                                <md-table-cell v-if="item" md-label="Действия">
                                    <image-table-actions :item="item"
                                                         :remove="true"
                                                         :page="pagination.current_page"
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
                storeModule: 'images',
                redirectRoute: {
                    name: 'manager.catalog.subcategories.list',
                    params: {category_type: this.category_type}
                }
            }
        },
        computed: {
            ...mapState({
                searchQuery: state => state.searchQuery,
                searchedData: state => state.searchedData,
                category: state => state.subCategories.item,
                items: state => state.images.items,
                fileProgress: state => state.images.fileProgress,
                pagination: state => state.images.pagination,
                previousPage: state => state.images.previousPage
            }),
            paginationData () {
                return {
                    current_page: this.pagination.current_page,
                    per_page: this.pagination.per_page,
                    sort_by: this.pagination.sort_by,
                    sort_order: this.pagination.sort_order
                }
            }
        },
        methods: {
            ...mapActions({
                publishAction: 'images/publish',
                resetPaginationAction: 'images/resetPagination',
                updatePaginationAction: 'images/updatePaginationFields',
                setPreviousPageAction: 'images/setPreviousPage',
                removeImageAction: 'subCategories/removeImage',
                getItemWithImagesAction: 'subCategories/getItemWithImages',
                getImagesAction: 'subCategories/getImages'
            }),
            init (category_type) {
                this.getItemWithImagesAction({
                    type: category_type,
                    id: this.id,
                    paginationData: this.paginationData
                })
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
                    storeModule: 'subCategories',
                    paginationData: this.paginationData
                });
            },
            onRemove (id) {
                const paginationData = this.preparePaginationData();

                this.removeImageAction({
                    type: this.category_type,
                    category_id: this.id,
                    image_id: id,
                    paginationData
                })
                    .then(() => this.checkGoToPreviousPage()
                            ? this.goToPreviousPage()
                            : this.rebootImageList(true));
            },
            onDelete (item) {
                const paginationData = this.preparePaginationData();

                this.delete({
                    payload: item.id,
                    title: item.id,
                    alertText: `изображение «${item.id}»`,
                    successText: 'Изображение удалено!',
                    storeModule: this.storeModule,
                    categoryId: this.id || null,
                    paginationData
                })
                    .then(() => this.checkGoToPreviousPage()
                        ? this.goToPreviousPage()
                        : this.rebootImageList(true));
            },
            changePage (item) {
                this.changePaginationSetting({ current_page: item });
            },
            changeSort (sortOrder) {
                this.changePaginationSetting({ sort_order: sortOrder });
            },
            changePaginationSetting (settingObject) {
                this.updatePaginationAction(settingObject);
                !!this.searchQuery && this.searchedData.length
                    ? this.search(this.searchQuery)
                    : this.rebootImageList();
            },
            search (query, currentPageFirst = false) {
                const paginationData = Object.assign({ query }, this.paginationData);

                if (currentPageFirst) {
                    paginationData.current_page = 1;
                }

                this.getImagesAction({ id: this.id, type: this.category_type, paginationData })
            },
            handleSearch (query) {
                query
                    ? this.search(query, true)
                    : this.rebootImageList(true)
            },
            rebootImageList (currentPageFirst = false) {
                const paginationData = Object.assign({}, this.paginationData);

                if (currentPageFirst) {
                    paginationData.current_page = 1;
                }

                return this.getImagesAction({ id: this.id, type: this.category_type, paginationData });
            },
            preparePaginationData () {
                return this.searchQuery
                    ? Object.assign({ query: this.searchQuery}, this.paginationData)
                    : Object.assign({}, this.paginationData);
            },
            paginationReset() {
                this.resetPaginationAction();

                if (this.previousPage) {
                    this.updatePaginationAction({ current_page: this.previousPage });
                }
            },
            onPublishChange (id) {
                this.publishAction(id);
            },
            checkGoToPreviousPage () {
                return this.checkItemsLength() ? this.pagination.current_page > 1 : false;
            },
            checkItemsLength () {
                return !this.items.length || this.isSearchDataEmpty;
            },
            goToPreviousPage () {
                this.changePaginationSetting({ current_page: this.pagination.current_page - 1 })
            },
            isSearchDataEmpty () {
                return !!this.searchQuery && !this.searchedData.length;
            }
        },
        created () {
            this.init(this.category_type);
        },
        beforeDestroy() {
            this.paginationReset();
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
