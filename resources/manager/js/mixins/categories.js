import pageProps from '@/lib/CatalogPageProps'
import { mapActions, mapState } from "vuex";

export const categoryPage = {
    props: {
        category_type: {
            type: String,
            require: true
        }
    },
    data () {
        return {
            pageProps,
            storeModule: 'categories',
            redirectRoute: {
                name: 'manager.catalog.categories.list',
                params: { category_type: this.category_type }
            }
        }
    },
    computed: {
        ...mapState({
            pageTitle: state => state.pageTitle
        })
    },
    methods: {
        ...mapActions([
            'setPageTitle'
        ])
    }
}

export const subCategoryPage = {
    props: {
        category_type: {
            type: String,
            require: true
        }
    },
    data () {
        return {
            pageProps,
            storeModule: 'subCategories',
            redirectRoute: {
                name: 'manager.catalog.subcategories.list',
                params: { category_type: this.category_type }
            }
        }
    },
    computed: {
        ...mapState({
            pageTitle: state => state.pageTitle
        })
    }
}

export const tableTitle = {
    computed: {
        tableTitle () {
            return pageProps[this.category_type].TABLE_TITLE
        }
    }
}
