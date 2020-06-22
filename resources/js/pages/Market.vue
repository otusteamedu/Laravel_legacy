<template>
    <div class='page-wrapper'>
        <div class='search-container'>
            <input v-model='search' :placeholder='$t("market.search")'>
            <div class='button search-container__button'>
                <font-awesome-icon class='button__icon' icon="search" />
            </div>
        </div>
        <select v-model='groupOfCategories'>
            <option value='1' disabled hidden>{{ $t('market.select_group_of_categories') }}</option>
        </select>
        <select v-model='category'>
            <option value='1' disabled hidden>{{ $t('market.select_category') }}</option>
        </select>
        <router-link to='/product/1' class='market-product-container'>
            <div
                class='market-product-container__image'
                style='background-image: url(/images/products/1/1.jpeg'
            ></div>
            <div class='market-product-container__information-container'>
                <div class='market-product-container__name'>
                    Socks 1
                </div>
                <div class='market-product-container__price'>
                    20$
                </div>
            </div>
        </router-link>
        <div class='market-product-container'>
            <div
                class='market-product-container__image'
                style='background-image: url(/images/products/2/1.jpeg'
            ></div>
            <div class='market-product-container__information-container'>
                <div class='market-product-container__name'>
                    Socks 2
                </div>
                <div class='market-product-container__price'>
                    20$
                </div>
            </div>
        </div>
        <div class='market-product-container'>
            <div
                class='market-product-container__image'
                style='background-image: url(/images/products/3/1.jpeg'
            ></div>
            <div class='market-product-container__information-container'>
                <div class='market-product-container__name'>
                    Strawberry
                </div>
                <div class='market-product-container__price'>
                    10$
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'market',
    data() {
        return {
            search: '',
            groupsOfCategories: [
                'group of categories 1',
                'group of categories 2'
            ],
            groupOfCategories: '1',
            category: '1'
        };
    }
}
</script>