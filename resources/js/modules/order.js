export const order = {
    state: {
        order: {}
    },
    mutations: {
        rememberOrder(state, order) {
            state.order = order;
        },
        addProductToOrder(state, product) {
            state.order.products.push(product);
        }
    },
    actions: {
        rememberOrder(context, order) {
            context.commit('rememberOrder', order);
        },
        addProductToOrder(context, product) {
            context.commit('addProductToOrder', product);
        }
    },
    getters: {
        order(state) {
            return state.order;
        }
    }
}