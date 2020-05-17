<template>
    <div class='page-wrapper'>
        <div class='products-basket-container'>
            <div class='product-basket-container'>
                <div class='product-basket-container__name'>Socks</div>
                <div class='product-basket-container__price'>20$</div>
                <div class='product-basket-container__quantity-container'>
                    <div class='button'>-</div>
                    <div class='product-basket-container__quantity'>2</div>
                    <div class='button'>+</div>
                </div>
                <div class='products-container_price'>40$</div>
            </div>
            <div class='product-basket-container'>
                <div class='product-basket-container__name'>Socks</div>
                <div class='product-basket-container__price'>20$</div>
                <div class='product-basket-container__quantity-container'>
                    <div class='button'>-</div>
                    <div class='product-basket-container__quantity'>2</div>
                    <div class='button'>+</div>
                </div>
                <div class='products-container__price'>40$</div>
            </div>
            <div class='products-basket-container__full-price'>80$</div>
        </div>
        <input class='address-input' v-model='address' :placeholder='$t("basket.address")'>
        <input class='address-input' v-model='phone' :placeholder='$t("basket.phone")'>
        <div class='button'>{{ $t('basket.buy') }}</div>
    </div>
</template>

<script>
export default {
    name: 'basket',
    data() {
        return {
            address: '',
            phone: ''
        };
    }
}
</script>