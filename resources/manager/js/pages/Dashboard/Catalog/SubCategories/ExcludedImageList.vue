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

    import { pageTitle } from '@/mixins/base'
    import { subCategoryImageAddMethod } from '@/mixins/crudMethods'

    import ImageListTable from "@/custom_components/Tables/ImageListTable";
    import ImageTableActions from "@/custom_components/Tables/ImageTableActions";


    export default {
        name: 'ExcludedImageList',
        mixins: [
            pageTitle,
            subCategoryImageAddMethod
        ],
        components: {
            ImageListTable,
            ImageTableActions
        },
        props: {
            id: {
                type: [ Number, String ],
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
                redirectRoute: {
                    name: 'manager.catalog.subcategories.images',
                    params: { category_type: this.category_type, id: this.id }
                },
                responseData: false,
                selected: []
            }
        },
        computed: {
            ...mapState({
                category: state => state.subCategories.item,
                items: state => state.images.items,
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
                publishAction: 'images/publish',
                updatePaginationAction: 'images/updatePaginationFields',
                getExcludedImagesAction: 'subCategories/getExcludedImages',
                getCategoryWithExcludedImagesAction: 'subCategories/getItemWithExcludedImages'
            }),
            onPublishChange(id) {
                this.publishAction(id);
            },
            onImagesAdd() {
                return this.addImages({
                    type: this.category_type,
                    id: this.id,
                    selected: this.selected,
                    redirectRoute: this.redirectRoute
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
                const paginationData = Object.assign({ query }, this.paginationData);

                if (currentPageFirst) {
                    paginationData.current_page = 1;
                }

                this.getExcludedImagesAction({ id: this.id, type: this.category_type, paginationData });
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

                return this.getExcludedImagesAction({ id: this.id, type: this.category_type, paginationData })
            }
        },
        created() {
            this.getCategoryWithExcludedImagesAction({
                type: this.category_type,
                id: this.id,
                paginationData: this.paginationData
            })
                .then(() => {
                    this.setPageTitle(`Для категории «${this.category.title}»`);
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
