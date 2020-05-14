import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

export default new VueRouter({
	mode: "history",
	routes: [
		{
			path: '/',
			name: 'home',
			component: Vue.component('Home', require('./pages/Home.vue')).default,
			children: [
				{
					path: '/',
					name: 'market',
					component: Vue.component('Market', require('./pages/Market.vue')).default,
					meta: {
						roles: []
					}
				},
				{
					path: '/login',
					name: 'login',
					component: Vue.component('Login', require('./pages/Login.vue')).default,
					meta: {
						roles: []
					},
				},
				{
					path: '/registration',
					name: 'registration',
					component: Vue.component('Registration', require('./pages/Registration.vue')).default,
					meta: {
						roles: []
					}
				},
				{
					path: '/basket',
					name: 'basket',
					component: Vue.component('Basket', require('./pages/Basket.vue')).default,
					meta: {
						roles: []
					}
				},
				{
					path: '/product/:id',
					name: 'product',
					component: Vue.component('Product', require('./pages/Product.vue')).default,
					meta: {
						roles: []
					}
				}
			]
		},
	]
});
