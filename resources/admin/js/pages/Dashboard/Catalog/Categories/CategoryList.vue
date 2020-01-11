<template>
    <div class="md-layout" v-if="responseData">
        <div class="md-layout-item">
            <md-card class="mt-0">
                <md-card-content class="md-between">
                    <router-button-link route="manager.catalog" title="В каталог" />
                    <router-button-link
                        route="manager.catalog.categories.create"
                        :params="{ category_type }"
                        icon="add"
                        color="md-success"
                        title="Создать категорию" />
                </md-card-content>
            </md-card>
            <div class="space-1"></div>
            <md-card>
                <card-icon-header :title="tableTitle" icon="assignment" />
                <md-card-content>
                    <template v-if="items.length">
                        <md-table :value="queriedData"
                                  :md-sort.sync="currentSort"
                                  :md-sort-order.sync="currentSortOrder"
                                  :md-sort-fn="customSort"
                                  class="paginated-table table-striped table-hover"
                        >
                            <md-table-toolbar class="mb-3">
                                <md-field>
                                    <label for="pages">На странице</label>
                                    <md-select v-model="pagination.perPage" name="pages">
                                        <md-option
                                            v-for="item in pagination.perPageOptions"
                                            :key="item"
                                            :label="item"
                                            :value="item">
                                            {{ item }}
                                        </md-option>
                                    </md-select>
                                </md-field>

                                <md-field>
                                    <md-input
                                        type="search"
                                        clearable
                                        style="width: 200px"
                                        placeholder="Поиск"
                                        v-model="searchQuery">
                                    </md-input>
                                </md-field>
                            </md-table-toolbar>
                            <md-table-row slot="md-table-row" slot-scope="{ item }">
                                <md-table-cell md-label="#" md-sort-by="id" style="width: 50px">{{ item.id }}</md-table-cell>
                                <md-table-cell v-if="category_type !== 'colors'" md-label="Превью">
                                    <img
                                        class="md-table-thumb img-raised rounded"
                                        :src="`/image/widen/300/${item.image_path}`"
                                        :alt="item.title"
                                    >
                                </md-table-cell>
                                <md-table-cell v-else md-label="Превью">
                                    <div class="tm-palette img-raised rounded-circle" :style="'background: ' + item.alias"></div>
                                </md-table-cell>
                                <md-table-cell md-label="Заголовок" md-sort-by="title"><h4>{{ item.title }}</h4></md-table-cell>
                                <md-table-cell md-label="Алиас" md-sort-by="alias">{{ item.alias }}</md-table-cell>
                                <md-table-cell md-label="Изображения" md-sort-by="images_count">{{ item.images_count }}</md-table-cell>
                                <md-table-cell md-label="Опубликован">
                                    <md-switch :value="!item.publish" @change="onPublishChange(item)" />
                                </md-table-cell>
                                <md-table-cell md-label="Действия">
                                    <router-button-link title="Изображения" icon="collections"
                                        route="manager.catalog.categories.images"
                                        :params="{ id: item.id }" />
                                    <router-button-link title="Редактировать" icon="edit" color="md-success"
                                        route="manager.catalog.categories.edit"
                                        :params="{ id: item.id }" />
                                    <control-button title="Удалить" icon="delete" color="md-danger"
                                        @click="onDelete(item)" />
                                </md-table-cell>
                            </md-table-row>
                        </md-table>
                        <md-card-actions md-alignment="space-between">
                            <div class="">
                                <p class="card-category">{{from + 1}} - {{to}} / {{total}}</p>
                            </div>
                            <pagination class="pagination-no-border pagination-success"
                                        v-model="pagination.currentPage"
                                        :per-page="pagination.perPage"
                                        :total="total">
                            </pagination>
                        </md-card-actions>
                    </template>
                    <template v-else>
                        <div class="alert alert-info">
                            <span><h3>{{ pageTitle }} не созданы!</h3></span>
                        </div>
                    </template>
                </md-card-content>
            </md-card>
        </div>
    </div>
</template>
<script>
    import { mapActions, mapState } from 'vuex'

    import { categoryPage, tableTitle } from '@/mixins/categories'
    import { pageTitle } from '@/mixins/base'
    import { deleteMethod } from '@/mixins/crudMethods'
    import { tableExtension } from '@/mixins/tableExtension'

    export default {
        name: 'CategoryList',
        mixins: [
            categoryPage,
            tableTitle,
            pageTitle,
            deleteMethod,
            tableExtension
        ],
        data () {
            return {
                responseData: false
            }
        },
        computed: {
            ...mapState('categories', {
                items: state => state.items,
            })
        },
        methods: {
            ...mapActions('categories', {
                indexByTypeAction: 'indexByType',
                publishAction: 'publish',
                clearFieldsAction: 'clearFields'
            }),
            async init (category_type) {
                this.responseData = false;
                await this.setPageTitle('');
                await this.clearFieldsAction();
                await this.indexByTypeAction(category_type)
                    .then(() => {
                        this.setPageTitle(this.pageProps[category_type].PAGE_TITLE);
                        this.responseData = true;
                    })
                    .catch(() => this.$router.push({ name: 'manager.catalog' }));
            },
            onDelete (item) {
                return this.delete({
                    module: 'categories',
                    payload: item.id,
                    title: item.title,
                    alertText: `категорию «${item.title}»`,
                    storeModule: this.storeModule,
                    successText: 'Категория удалена!'
                })
            },
            onPublishChange (item) {
                this.publishAction(item.id);
            }
        },
        watch: {
            '$route' (to, from) {
                this.init(to.params.category_type);
            },
            items () {
                this.setSearch(['title', 'alias']);
            }
        },
        created () {
            this.init(this.category_type);
        },
        mounted () {
            this.setSearch(['title', 'alias']);
        }
    }
</script>

<style lang="scss" scoped>
    .md-table-thumb {
       object-fit: cover;
       width: 200px;
       height: 100px;
    }
    .tm-palette {
        width: 50px;
        height: 50px;
    }
</style>
