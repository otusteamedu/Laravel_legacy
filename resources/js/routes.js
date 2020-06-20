import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store.js';

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
				},
				{
					path: '/admin',
					name: 'admin',
					component: Vue.component('Admin', require('./pages/AdminMenu.vue')).default,
					meta: {
						roles: []
					}
				},
				{
					path: '/userlist',
					name: 'userlist',
					component: Vue.component('UserList', require('./pages/UserList.vue')).default,
					meta: {
						roles: []
					}
				},
				{
					path: '/user/:id',
					name: 'user',
					component: Vue.component('User', require('./pages/User.vue')).default,
					meta: {
						roles: []
					}
				},
				{
					path: '/order/:id',
					name: 'order',
					component: Vue.component('Product', require('./pages/Order.vue')).default,
					meta: {
						roles: []
					},
					beforeEnter: (to, from, next) => {
						if (from.path != '/add_product_to_order') {
							store.commit("rememberOrder", {});
						}
						next();
					}
				}
			]
		},
		{
			path: '/add_product_to_order',
			name: 'add_product_to_order',
			component: Vue.component('AddProductToOrder', require('./pages/AddProductToOrder.vue')).default
		}
	],
});
