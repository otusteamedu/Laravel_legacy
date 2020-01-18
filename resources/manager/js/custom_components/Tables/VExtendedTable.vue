<template>
    <div>
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
                <slot :item="item" />
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
    </div>
</template>

<script>
    import { Pagination } from '@/components'
    import Fuse from 'fuse.js'
    import { mapState } from 'vuex'



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
                        perPage: 50,
                        currentPage: 1,
                        perPageOptions: [ 50, 200, 500, 1000 ],
                        total: 0
                    }
                }
            },
            sortOrder: {
                type: String,
                default: 'asc'
            }
        },
        components: { Pagination },
        data () {
            return {
                searchQuery: '',
                fuseSearch: null,
                currentSort: 'id',
                currentSortOrder: 'asc'
            }
        },
        computed: {
            ...mapState([
                'searchedData'
            ]),
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
            setSearchedData(result) {
                this.$store.dispatch('setSearchedData', result);
            },
            customSort (value) {
                return value.sort((a, b) => {
                    const sortBy = this.currentSort;
                    const numberSort = typeof a[sortBy] === 'number' && typeof b[sortBy] === 'number';

                    if (this.currentSortOrder === 'asc') {
                        return numberSort
                            ? a[sortBy] < b[sortBy] ? -1 : 1
                            : a[sortBy].localeCompare(b[sortBy])
                    }

                    return numberSort
                        ? a[sortBy] > b[sortBy] ? -1 : 1
                        : b[sortBy].localeCompare(a[sortBy])
                })
            },
            setSearch (keys) {
                this.fuseSearch = new Fuse(this.items, {keys, threshold: 0.3})
            }
        },
        watch: {
            items () {
                this.setSearch(this.searchFields);
            },
            searchQuery (value){
                let result = this.items;
                if (value !== '') {
                    result = this.fuseSearch.search(this.searchQuery)
                }
                this.setSearchedData(result)
            }
        },
        created() {
            this.setSearchedData([]);
        },
        mounted () {
            this.setSearch(this.searchFields);
        }
    }
</script>

<style scoped>
    .tm-palette {
        width: 50px;
        height: 50px;
    }
</style>
