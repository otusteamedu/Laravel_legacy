<template>
    <div class="md-layout" v-if="responseData">
        <div class="md-layout-item">
            <md-card class="mt-0">
                <md-card-content class="md-between">
                    <router-link :to="{ name: 'admin.categories' }">
                        <md-button class="md-info md-just-icon">
                            <md-icon>arrow_back</md-icon>
                            <md-tooltip md-direction="right">В панель Категорий</md-tooltip>
                        </md-button>
                    </router-link>
                    <router-link :to="{ name: `admin.categories.${category_type}.create` }">
                        <md-button class="md-success md-just-icon">
                            <md-icon>add</md-icon>
                            <md-tooltip md-direction="right">Создать категорию</md-tooltip>
                        </md-button>
                    </router-link>
                </md-card-content>
            </md-card>
            <div class="space-1"></div>
            <md-card>
                <md-card-header class="md-card-header-icon md-card-header-green">
                    <div class="card-icon">
                        <md-icon>assignment</md-icon>
                    </div>
                    <h3 class="title">{{ table_title }}</h3>
                </md-card-header>
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
                                        :src="'/image/widen/300/' + item.image_path"
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
                                    <md-switch :value="!item.publish" @change="onPublishChange(item)"></md-switch>
                                </md-table-cell>
                                <md-table-cell md-label="Действия">
                                    <router-link :to="{ name: `admin.categories.${category_type}.images`, params: { id: item.id } }">
                                        <md-button
                                            class="md-info md-just-icon">
                                            <md-icon>collections</md-icon>
                                            <md-tooltip md-direction="top">Изображения</md-tooltip>
                                        </md-button>
                                    </router-link>
                                    <router-link :to="{ name: `admin.categories.${category_type}.edit`, params: { id: item.id } }">
                                        <md-button
                                            class="md-success md-just-icon">
                                            <md-icon>edit</md-icon>
                                            <md-tooltip md-direction="top">Редактировать</md-tooltip>
                                        </md-button>
                                    </router-link>
                                    <md-button
                                        class="md-danger md-just-icon"
                                        @click.native="onDelete(item)">
                                        <md-icon>delete</md-icon>
                                        <md-tooltip md-direction="top">Удалить</md-tooltip>
                                    </md-button>
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
                            <span><h3>{{ page_title }} не созданы!</h3></span>
                        </div>
                    </template>
                </md-card-content>
            </md-card>
        </div>
    </div>
</template>

<script>
    import { Pagination } from '@/components'
    import Fuse from 'fuse.js'
    import swal from 'sweetalert2'

    export default {
        name: 'CategoryList',
        components: {
            Pagination
        },
        props: {
            category_type: {
                type: String,
                require: true
            },
            page_title: {
                type: String,
                require: true
            },
            table_title: {
                type: String,
                require: true
            }
        },
        data () {
            return {
                currentSort: '',
                currentSortOrder: 'asc',
                pagination: {
                    perPage: 10,
                    currentPage: 1,
                    perPageOptions: [10, 15, 25, 50],
                    total: 0
                },
                searchQuery: '',
                propsToSearch: ['title', 'alias'],
                tableData: this.items,
                searchedData: [],
                fuseSearch: null,
                responseData: false
            }
        },
        created () {
            this.init(this.category_type);
        },
        mounted () {
            this.fuseSearch = new Fuse(this.items, {keys: ['title', 'alias'], threshold: 0.3})
        },
        computed: {
            items () {
                return this.$store.getters['categories/items'](this.category_type);
            },
            queriedData () {
                let result = this.items;
                if(this.searchedData.length > 0){
                    result = this.searchedData;
                }
                return result.slice(this.from, this.to)
            },
            to () {
                let highBound = this.from + this.pagination.perPage;
                if (this.total < highBound) {
                    highBound = this.total
                }
                return highBound
            },
            from () {
                return this.pagination.perPage * (this.pagination.currentPage - 1)
            },
            total () {
                return this.searchedData.length > 0 ? this.searchedData.length : this.items.length;
            }
        },
        methods: {
            init (category) {
                this.responseData = false;
                this.$store.dispatch('setPageTitle', '');
                this.$store.dispatch('categories/getItems', category)
                    .then(() => {
                        this.$store.dispatch('setPageTitle', this.page_title);
                        this.responseData = true;
                    })
                    .catch(() => this.$router.push({ name: 'admin.categories' }));
            },
            customSort (value) {
                return value.sort((a, b) => {
                    const sortBy = this.currentSort;
                    if (this.currentSortOrder === 'asc') {
                        if (typeof a[sortBy] === 'number' && typeof b[sortBy] === 'number') {
                            return a[sortBy] < b[sortBy] ? -1 : 1;
                        }
                        return a[sortBy].localeCompare(b[sortBy])
                    }
                    if (typeof a[sortBy] === 'number' && typeof b[sortBy] === 'number') {
                        return a[sortBy] > b[sortBy] ? -1 : 1;
                    }
                    return b[sortBy].localeCompare(a[sortBy])
                })
            },
            onDelete (item) {
                swal.fire({
                    title: 'Вы уверены?',
                    text: `Данное действие удалит категорию «${item.title}» безвозвратно!`,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'md-button md-success btn-fill',
                    cancelButtonClass: 'md-button md-danger btn-fill',
                    confirmButtonText: 'Удалить',
                    cancelButtonText: 'Отменить',
                    buttonsStyling: false
                }).then((result) => {
                    if(result.value){
                        this.$store.dispatch('categories/deleteItem', { category_id: item.id, category_type: this.category_type})
                            .then(() => {
                                swal.fire({
                                    title: 'Категория удалена!',
                                    text: item.title,
                                    timer: 2000,
                                    type: 'success',
                                    showConfirmButton: false
                                });
                            });
                    }
                });
            },
            onPublishChange (item) {
                this.$store.dispatch('categories/changePublish', { category_id: item.id, category_type: this.category_type });
            }
        },
        watch: {
            '$route' (to, from) {
                this.init(to.params.category_type);
            },
            searchQuery (value){
                let result = this.items;
                if (value !== '') {
                    result = this.fuseSearch.search(this.searchQuery)
                }
                this.searchedData = result;
            },
            items () {
                this.fuseSearch = new Fuse(this.items, {keys: ['title', 'alias'], threshold: 0.3})
            }
        }
    }
</script>

<style lang="scss" scoped>
    .md-card .md-card-actions{
        border: 0;
        margin-left: 20px;
        margin-right: 20px;
    }

    .md-table-thumb {
        object-fit: cover;
        width: 200px;
        height: 100px;
    }

    .md-table-cell-container {
        .md-just-icon {
            margin-left: 5px;
            margin-right: 5px;
        }
    }

    .tm-palette {
        width: 50px;
        height: 50px;
    }
</style>
