<template>
    <div class='page-wrapper'>
        <user :user='user' />
        <div class='block-headline'>
            {{ $t('user.orders') }}
        </div>
        <vue-table :elements='orders' />
    </div>
</template>

<script>
import VueTable from '../components/VueTable.vue';
import User from '../components/User.vue';

export default {
    components: {
        VueTable,
        User
    },
    data() {
        return {
            user: {},
            orders: []
        };
    },
    mounted() {
        let langUrl = '';
        if (this.$i18n.locale != 'en') {
            langUrl = `/${this.$i18n.locale}`;
        }

        axios.get(`/api/user/${this.$route.params.id}${langUrl}`).then(response => {
            let resp = response.data;
            this.user = resp;
            this.orders = this.user.orders;

            for (let i = 0; i < this.orders.length; i++) {
                this.orders[i].link = '/order/' + this.orders[i].id;
                this.orders[i].created_at = undefined;
                this.orders[i].updated_at = undefined;
                this.orders[i].user_id = undefined;
                this.orders[i].order_status_name = this.orders[i].order_status.name;
                this.orders[i].order_status = undefined;
                this.orders[i].status_id = undefined;
                this.orders[i].main_product_name = this.getMainProductName(this.orders[i].products);
                this.orders[i].price = this.getPriceSum(this.orders[i].products);
                this.orders[i].products = undefined;
                this.orders[i].deleted = undefined;
            }
        });
    },
    methods: {
        getPriceSum: function(products) {
            let priceSum = 0;
            for (let i = 0; i < products.length; i++) {
                priceSum += products[i].price;
            }
            priceSum = priceSum * 100;
            priceSum = parseInt(priceSum);
            priceSum = priceSum / 100;  
            return priceSum;
        },
        getMainProductName: function(products) {
            let mainProduct = products[0];
            for (let i = 1; i < products.length; i++) {
                if (mainProduct.price < products[i].price) {
                    mainProduct = products[i];
                }
            };
            return mainProduct.name;
        }
    }
}
</script>