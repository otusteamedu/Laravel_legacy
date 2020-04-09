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
                                          @search="handleSearch"
                                          @changePage="changePage"
                                          @changeSort="changeSort"
                                          @publish="onPublishChange">

                            <template #actions-column="{ item }">
                                <md-table-cell v-if="item" md-label="Действия">
                                    <image-table-actions :item="item"
                                                         :remove="isCategoryPage"
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
                storeModule: 'images'
            }
        },
        computed: {
            ...mapState({
                searchQuery: state => state.searchQuery,
                searchedData: state => state.searchedData,
                category: state => state.categories.item,
                items: state => state.images.items,
                fileProgress: state => state.images.fileProgress,
                pagination: state => state.images.pagination,
                previousPage: state => state.images.previousPage
            }),
            isCategoryPage() {
                return this.category_type !== 'images';
            },
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
                getItemsAction: 'images/getItems',
                resetPagination: 'images/resetPagination',
                publishAction: 'images/publish',
                updatePaginationAction: 'images/updatePaginationFields',
                setPreviousPageAction: 'images/setPreviousPage',
                removeImageAction: 'categories/removeImage',
                getCategoryWithImagesAction: 'categories/getItemWithImages',
                getImagesAction: 'categories/getImages'
            }),
            async init () {
                return this.category_type === 'images'
                    ? await this.imageInit()
                    : await this.categoryInit();
            },
            imageInit () {
                this.getItemsAction(this.paginationData)
                    .then(() => {
                        this.setPageTitle('Изображения');
                        this.responseData = true;
                    })
                    .catch(() => this.$router.push({ name: 'manager.dashboard' }));
            },
            categoryInit () {
                this.getCategoryWithImagesAction({ id: this.id, paginationData: this.paginationData })
                    .then(() => {
                        this.setPageTitle(`Изображения категории «${this.category.title}»`);
                        this.responseData = true;
                    })
                    .catch(() => this.$router.push({
                        name: 'manager.catalog.categories.list',
                        params: { category_type: this.category_type }
                    }));
            },
            fileInputChange (event) {
                this.upload({
                    uploadFiles: event.target.files,
                    type: this.category_type,
                    id: this.id,
                    paginationData: this.paginationData
                });
            },
            onRemove (id) {
                const paginationData = this.preparePaginationData();

                this.removeImageAction({
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
            onPublishChange (id) {
                this.publishAction(id);
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

                this.category_type !== 'images'
                    ? this.getImagesAction({ id: this.id, paginationData })
                    : this.getItemsAction(paginationData);
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

                return this.category_type === 'images'
                    ? this.getItemsAction(paginationData)
                    : this.getImagesAction({ id: this.id, paginationData });
            },
            preparePaginationData () {
                return this.searchQuery
                    ? Object.assign({ query: this.searchQuery}, this.paginationData)
                    : Object.assign({}, this.paginationData);
            },
            paginationReset() {
                this.resetPagination();

                if (this.previousPage) {
                    this.updatePaginationAction({ current_page: this.previousPage });
                }
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
            this.paginationReset();
            this.init()
                .then(() => this.setPreviousPageAction(null));
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
