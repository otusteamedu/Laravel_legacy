<template>
    <div v-if="responseData">

        <div class="md-layout">
            <div class="md-layout-item">
                <md-card class="mt-0">
                    <md-card-content class="md-between">
                        <router-button-link
                            route="manager.catalog.categories.images"
                            :params="{ category_type, id }"
                        />
                        <div v-if="selected.length">
                            <control-button title="Добавить изображения"
                                            icon="add"
                                            @click="onImagesAdd" />
                        </div>
                    </md-card-content>
                </md-card>
            </div>
        </div>

        <div class="md-layout">
            <div class="md-layout-item">
                <md-card>
                    <card-icon-header title="Каталог изображений" icon="image" />
                    <md-card-content>
                        <image-list-table v-if="items.length"
                                          :items="items"
                                          @search="handleSearch"
                                          @changePage="changePage"
                                          @changeSort="changeSort"
                                          @publish="onPublishChange">

                            <template #first-column="{ item }">
                                <md-table-cell md-label="#" md-sort-by="id" style="width: 50px">
                                    {{ item.id }}
                                </md-table-cell>
                            </template>

                            <template #actions-column="{ item }">
                                <md-table-cell md-label="Выбрать">
                                    <md-checkbox v-model="selected" :value="item.id" />
                                </md-table-cell>
                            </template>

                        </image-list-table>
                        <template v-else>
                            <div class="alert alert-info">
                                <span><h3>Пока нет других изображений!</h3></span>
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

    import { categoryPage } from '@/mixins/categories'
    import { pageTitle } from '@/mixins/base'
    import { imageAddMethod } from '@/mixins/crudMethods'

    import ImageListTable from "@/custom_components/Tables/ImageListTable";
    // import ImageTableActions from "@/custom_components/Tables/ImageTableActions";

    export default {
        name: 'ExcludedImageList',
        mixins: [
            categoryPage,
            pageTitle,
            // deleteMethod,
            imageAddMethod
        ],
        components: {
            ImageListTable,
            // ImageTableActions
        },
        props: {
            id: {
                type: [Number, String],
                required: true
            },
            category_type: {
                type: String,
                default: null
            },
        },
        data () {
            return {
                storeModule: 'images',
                responseData: false,
                selected: [],
                loading: false
            }
        },
        computed: {
            ...mapState({
                category: state => state.categories.item,
                items: state => state.images.items,
                title: state => state.categories.fields.title,
                pagination: state => state.images.pagination,
                searchQuery: state => state.searchQuery,
                searchedData: state => state.searchedData

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
                indexAction: 'images/index',
                publishAction: 'images/publish',
                updatePaginationAction: 'images/updatePaginationFields',
                showExcludedImagesAction: 'categories/showExcludedImages',
                showWithExcludedImagesAction: 'categories/showWithExcludedImages'
            }),
            onDelete (item) {
                return this.delete({
                    storeModule: this.storeModule,
                    payload: item.id,
                    title: item.id,
                    alertText: `изображение «${item.id}»`,
                    successText: 'Изображение удалено!'
                });
            },
            onPublishChange(id) {
                this.publishAction(id);
            },
            onImagesAdd() {
                return this.addImages({
                    category: this.category,
                    selected: this.selected
                })
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
                const data = Object.assign({ query }, this.paginationData);
                if (currentPageFirst) {
                    data.current_page = 1;
                }
                this.showExcludedImagesAction({ id: this.id, data });
            },
            handleSearch (query) {
                query
                    ? this.search(query, true)
                    : this.rebootImageList(true)
            },
            rebootImageList (currentPageFirst = false) {
                const data = Object.assign({}, this.paginationData);
                if (currentPageFirst) {
                    data.current_page = 1;
                }

                return this.showExcludedImagesAction({ id: this.id, data })
            }
        },
        created() {
            this.showWithExcludedImagesAction({ id: this.id, data: this.paginationData })
                .then(() => {
                    this.setPageTitle('Каталог изображений');
                    this.responseData = true;
                })
                .catch(() => this.$router.push(this.redirectRoute));
        }
    }
</script>

<style lang="scss" scoped>
    .md-file-input {
        display: none;
    }

    .md-between {
        display: flex;
        justify-content: space-between;
    }
</style>
