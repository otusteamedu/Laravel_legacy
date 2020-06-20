<template>
    <div class='page-wrapper'>
        <div>{{ $t('add_product_to_order.add_product_to_order') }}</div>
        <div class='input-container'>
            <div class='input-container__label'>{{ $t('add_product_to_order.search') }}</div>
            <input type='text' v-model="search" >
        </div>
        <div class='productlist-container'>
            <div
                v-for='product in products' :key='product.id'
                class='market-product-container'
                @click='addProductToOrder(product)'
            >
                <div
                    class='market-product-container__image'
                    :style='`background-image: url("${product.image_path}");`'
                ></div>
                <div class='market-product-container__information-container'>
                    <div class='market-product-container__name'>
                        {{ product.name }}
                    </div>
                    <div class='market-product-container__price'>
                        {{ product.price}}
                    </div>
                </div>
            </div>
        </div>
        <div class='end-of-page'>
            <div class='paginate'>
                <div v-if='prevPage' class='paginate__next-page button' @click="getPage(prevPage)">{{ prevPage }}</div>
                <div>{{ currentPage }}</div>
                <div v-if='nextPage' class='paginate__next-page button' @click="getPage(nextPage)">{{ nextPage }}</div>
            </div>
            <div class='input-container'>
                <div class='input-container__label'>{{ $t('add_product_to_order.products_per_page') }}</div>
                <input type='number' min='1' step='1' v-model="perPage">
            </div>
            <div class='input-container'>
                <div class='input-container__label'>{{ $t('add_product_to_order.page_to_go') }}</div>
                <input type='number' min='1' step='1' v-model="pageToGo" >
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            order: {},
            products: {},
            currentPage: 1,
            perPage: 20,
            search: null,
            nextPage: null,
            prevPage: null,
            pageToGo: 1
        }
    },
    mounted() {
        this.order = this.$store.getters.order

        if (this.isObjectEmpty(this.order)) {
            this.$router.push('/');
        }

        this.getPage(1);
    },
    methods: {
        getPage: function(page) {
            let currentPage = page;
            this.currentPage = currentPage;
            let search = this.search;
            let searchUrl = '';
            if (search && search.length >= 3) {
                searchUrl = '/' + search;
            }
            axios.get(`/api/products/${currentPage}/${this.perPage}${searchUrl}`).then(response => {
                let resp = response.data;
                this.products = resp.entities;
                if (resp.is_prev_page_exist) {
                    this.prevPage = parseInt(currentPage) - 1;
                } else {
                    this.prevPage = null;
                }
                if (resp.is_next_page_exist) {
                    this.nextPage = parseInt(currentPage) + 1;
                } else{
                    this.nextPage = null;
                }
            });
        },
        isObjectEmpty(obj) {
            return this.$store.getters.isObjectEmpty(obj);
        },
        addProductToOrder(product) {
            let productsInOrder = this.order.products;

            for (let i = 0; i < productsInOrder.length; i++) {
                let productInOrder = productsInOrder[i];
                if (productInOrder.id == product.id) {
                    this.$router.push(`/order/${this.order.id}`);
                    return;
                }
            }

            product.pivot = {
                order_id: this.order.id,
                product_id: product.id,
                quantity: 1
            };

            this.$store.dispatch("addProductToOrder", product);
            this.$router.push(`/order/${this.order.id}`);
        }
    },
    watch: {
        pageToGo: function(val) {
            if (parseInt(val)) {
                this.getPage(val);
            }
        },
        search: function(val) {
            this.getPage(this.currentPage);
        },
        perPage: function(val) {
            if (parseInt(val)) {
                this.getPage(this.currentPage);
            }
        }
    }
}
</script>