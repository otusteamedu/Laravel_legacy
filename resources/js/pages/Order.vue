<template>
    <div class='page-wrapper'>
        <div v-if='order.deleted'>
            <div class='block-headline'>
                {{ $t('order.order_is_deleted') }}
            </div>
            <div class='button' @click='reestablish()'>{{ $t('order.reestablish') }}</div>
        </div>
        <div class='show-field'>
            <div class='show-field__name'>ID</div>
            <div class='show-field__value'>{{ order.id }}</div>
        </div>
        <div class='block-headline'>
            {{ $t('order.user') }}
        </div>
        <user :user='order.user' />
        <div class='block-headline'>
            {{ $t('order.products') }}
        </div>
        <div class='list'>
            <div  v-for='product in order.products' :key='product.id' class='list-item'>
                <div class='list-item__cell'>
                    <router-link class='link' :to='"/product/" + product.id'>
                        {{ product.name }}
                    </router-link>
                </div>
                <div class='list-item__cell list-item__price'>
                    {{ product.price}}
                </div>
                <div class='quantity'>
                    <div
                        v-if='!order.deleted'
                        class='button'
                        @click='changeQuantity(product.id, 1)'
                    >
                        +
                    </div>
                    <div class='quantity__value'>
                        {{ product.pivot.quantity }}
                    </div>
                    <div
                        v-if='!order.deleted'
                        class='button'
                        @click='changeQuantity(product.id, -1)'
                    >
                        -
                    </div>
                </div>
                <div class='list-item__cell list-item__price'>
                    {{ parseInt(product.price * product.pivot.quantity * 100) / 100 }}
                </div>
                <font-awesome-icon
                    v-if='!order.deleted'
                    @click='removeProduct(product.id)'
                    class='remove-list-item-button'
                    icon='trash-alt'
                />
            </div>
        </div>
        <div
            v-if='!order.deleted'
            class='button'
            @click='startAddProduct()'
        >
            {{ $t('order.add_product') }}
        </div>
        <div class='show-field'>
            <div class='show-field__name'>{{ $t('order.total_price') }}:</div>
            <div class='show-field__value'>{{ totalPrice }}</div>
        </div>
        <div class='show-field'>
            <div class='show-field__name'>{{ $t('order.status') }}:</div>
            <div v-if='order.deleted' class='show-field_value'>{{ status }}</div>
            <select v-if='!order.deleted' class='show-field__value' v-model='status'>
                <option v-for='status in statuses' :key='status.id'>{{ status.name }}</option>
            </select>
        </div>
        <div v-if='!order.deleted' class='double-button-container'>
            <div class='button double-button-container__button' @click='save()'>{{ $t('order.save') }}</div>
            <div class='button double-button-container__button' @click='remove()'>{{ $t('order.remove') }}</div>
        </div>
    </div>
</template>

<script>
import User from '../components/User.vue';

export default {
    name: 'order',
    components: {
        User
    },
    data() {
        return {
            order: {
                user: {},
                products: {},
                order_status: {}
            },
            totalPrice: 0,
            status: null,
            statuses: {}
        }
    },
    mounted() {
        axios.get('/api/order_statuses').then(response => {
            this.statuses = response.data;
        });

        if (!this.$store.getters.isObjectEmpty(this.$store.getters.order)) {
            this.order = this.$store.getters.order;
            this.countTotalPrice();
            this.status = this.order.order_status.name;
            return;
        }

        axios.get(`/api/order/${this.$route.params.id}`).then(response => {
            this.order = response.data;
            this.countTotalPrice();
            this.status = this.order.order_status.name;
        });
    },
    methods: {
        countTotalPrice() {
            let totalPrice = 0;
            for (let i = 0; i < this.order.products.length; i++) {
                let product = this.order.products[i];
                totalPrice += parseInt(product.price * product.pivot.quantity * 100) / 100;
            }
            this.totalPrice = parseInt(totalPrice * 100) / 100;
        },
        changeQuantity: function(productId, toCange) {
            for (let i = 0; i < this.order.products.length; i++) {
                if (
                    this.order.products[i].id == productId
                    && !(this.order.products[i].pivot.quantity == 1 && toCange == -1)
                ) {
                    this.order.products[i].pivot.quantity += toCange;
                }
            }

            this.countTotalPrice();
        },
        removeProduct: function(productId) {
            let newProducts = [];
            for (let i = 0; i < this.order.products.length; i++) {
                if (this.order.products[i].id != productId) {
                    newProducts.push(this.order.products[i]);
                }
            }
            this.order.products = newProducts;

            this.countTotalPrice();
        },
        startAddProduct: function() {
            this.$store.commit('rememberOrder', this.order);

            this.$router.push({
                path: '/add_product_to_order'
            });
        },
        getOrderForRequest() {
            let requestOrder = {
                id: this.order.id,
                status_id: this.order.status_id,
                products: [],
                deleted: this.order.deleted
            };

            for (let i = 0; i < this.order.products.length; i++) {
                let product = this.order.products[i];
                requestOrder.products.push({
                    id: product.id,
                    quantity: product.pivot.quantity
                });
            }

            return {
                update: [
                    requestOrder
                ]
            };
        },
        getOrderForRequestWithOnlyDeletedAttribute() {
            return {
                update: [{
                    id: this.order.id,
                    deleted: this.order.deleted
                }]
            }
        },
        save() {
            console.log(this.getOrderForRequest());
            axios.patch('/api/order', this.getOrderForRequest()).then(response => {

            });
        },
        remove() {
            this.order.deleted = true;
            axios.patch('/api/order',this.getOrderForRequestWithOnlyDeletedAttribute()).then(response => {

            });
        },
        reestablish() {
            this.order.deleted = false;
            axios.patch(`/api/order`, this.getOrderForRequestWithOnlyDeletedAttribute()).then(response => {

            });
        }
    },
    watch: {
        status: function(val) {
            for (let i = 0; i < this.statuses.length; i++) {
                let status = this.statuses[i];
                if (val == status.name) {
                    this.order.order_status = status;
                    this.order.status_id = status.id;
                }
            }
        }
    }
}
</script>