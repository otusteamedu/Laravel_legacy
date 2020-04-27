<template>
    <div>
        <md-table :value="queriedData"
                  :md-sort.sync="pagination.sort_by"
                  :md-sort-order.sync="pagination.sort_order"
                  :md-sort-fn="customSort"
                  class="paginated-table table-striped table-hover"
                  :class="{ loading }"
        >
            <md-table-toolbar class="mb-3">
                <md-field>
                    <label for="pages">На странице</label>
                    <md-select :value="pagination.per_page" @md-selected="changePerPage" name="pages">
                        <md-option
                            v-for="item in perPageOptions"
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
                        :value="searchQuery"
                        @input="setSearchQueryAction"
                    >
                    </md-input>
                </md-field>
            </md-table-toolbar>

            <md-table-row slot="md-table-row" slot-scope="{ item }">
                <slot :item="item" />
            </md-table-row>

        </md-table>
        <md-card-actions md-alignment="space-between">
            <div class="">
                <p class="card-category" v-if="serverPagination">{{pagination.from}} - {{pagination.to}} / {{total}}</p>
                <p class="card-category" v-else>{{from + 1}} - {{to}} / {{total}}</p>
            </div>
            <pagination class="pagination-no-border pagination-success"
                        :per-page="pagination.per_page"
                        :total="total"
                        v-model="pagination.current_page"
                        @input="changePage" >
            </pagination>
        </md-card-actions>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'
    import { Pagination } from '@/components'
    import Fuse from 'fuse.js'

    export default {
        name: "VExtendedTable",
        props: {
            items: {
                type: [ Array, Object ],
                default: null
            },
            searchFields: {
                type: Array,
                default: () => ['id']
            },
            pagination: {
                type: Object,
                default() {
                    return {
                        per_page: 20,
                        current_page: 1,
                        sort_by: 'id',
                        sort_order: 'asc'
                    }
                }
            },
            perPageOptions: {
                type: Array,
                default: () => [ 20, 50, 100, 200 ]
            },
            serverPagination: {
                type: Boolean,
                default: false
            }
        },
        components: { Pagination },
        data () {
            return {
                fuseSearch: null,
                previousSortOrder: 'asc',
                searchTmt: null
            }
        },
        computed: {
            ...mapState([
                'searchedData',
                'searchQuery',
                'loading'
            ]),
            queriedData () {
                let result = this.items;

                if(this.searchedData.length > 0){
                    result = this.searchedData;
                }

                return result.slice(this.from, this.to)
            },
            to () {
                if (this.serverPagination) {
                    return this.items.length;
                }

                let highBound = this.from + this.pagination.per_page;
                if (this.total < highBound) {
                    highBound = this.total
                }

                return highBound
            },
            from () {
                return this.serverPagination
                    ? 0
                    : this.pagination.per_page * (this.pagination.current_page - 1);
            },
            total () {
                return this.pagination.total
                    ? this.pagination.total
                    : this.searchedData.length > 0 ? this.searchedData.length : this.items.length;
            }
        },
        methods: {
            ...mapActions({
                setSearchedDataAction: 'setSearchedData',
                setSearchQueryAction: 'setSearchQuery'
            }),
            customSort (value) {
                if (this.previousSortOrder !== this.pagination.sort_order) {
                    this.$emit('sort', this.pagination.sort_order);
                    this.previousSortOrder = this.pagination.sort_order;
                }

                if (! this.serverPagination) {
                    return this.sort(value);
                }
            },
            sort (value) {
                return value.sort((a, b) => {
                    const sortBy = this.pagination.sort_by;
                    const numberSort = typeof a[sortBy] === 'number' && typeof b[sortBy] === 'number';

                    if (this.pagination.sort_order === 'asc') {
                        return numberSort
                            ? a[sortBy] < b[sortBy] ? -1 : 1
                            : a[sortBy].localeCompare(b[sortBy])
                    }

                    return numberSort
                        ? a[sortBy] > b[sortBy] ? -1 : 1
                        : b[sortBy].localeCompare(a[sortBy])
                })
            },
            setFuseSearch () {
                if (!this.serverPagination) {
                    this.initFuseSearch(this.searchFields);
                }
            },
            initFuseSearch (keys) {
                this.fuseSearch = new Fuse(this.items, { keys, threshold: 0.3 })
            },
            changePage (item) {
                this.$emit('changePage', item);
            },
            changePerPage (value) {
                this.$emit('changePerPage', value);
            },
            searchOnServer (query) {
                this.$emit('search', query);

                if (!query) {
                    this.setSearchedDataAction([])
                }
            },
            search (query) {
                query
                    ? this.setSearchedDataAction(this.fuseSearch.search(query).map(fuse => fuse.item))
                    : this.setSearchedDataAction([]);
            },
            handleSearch (query) {
                this.serverPagination
                    ? this.searchOnServer(query)
                    : this.search(query);
            }
        },
        watch: {
            items () {
                this.setFuseSearch();
            },
            searchQuery () {
                const query = this.searchQuery;

                if (!query) {
                    this.setSearchedDataAction([])
                }

                clearTimeout(this.searchTmt);
                this.searchTmt = setTimeout(() => this.serverPagination
                        ? this.searchOnServer(query)
                        : this.search(query), 300);
            }
        },
        created() {
            this.setSearchedDataAction([]);
            this.setSearchQueryAction('');
        },
        mounted () {
            this.setFuseSearch();
            this.previousSortOrder = this.pagination.sort_order;
        },
        beforeDestroy() {
            clearTimeout(this.searchTmt);
            this.setSearchedDataAction([]);
            this.setSearchQueryAction('');
        }
    }
</script>

<style>
    .tm-palette {
        width: 50px;
        height: 50px;
    }
    .loading td {
        opacity: 0;
    }
</style>
