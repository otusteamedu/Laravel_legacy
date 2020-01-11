import { Pagination } from '@/components'
import Fuse from 'fuse.js'
import { mapState } from 'vuex'

export const tableExtension = {
    components: {
        Pagination
    },
    data () {
        return {
            currentSort: 'id',
            currentSortOrder: 'asc',
            pagination: {
                perPage: 10,
                currentPage: 1,
                perPageOptions: [10, 15, 25, 50],
                total: 0
            },
            searchQuery: '',
            tableData: this.items,
            fuseSearch: null,
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
    created() {
        this.setSearchedData([]);
    },
    watch: {
        searchQuery (value){
            let result = this.items;
            if (value !== '') {
                result = this.fuseSearch.search(this.searchQuery)
            }
            this.setSearchedData(result)
        }
    }
}
