<template>
    <div class='page-wrapper product-page'>
        <div class='product-page__image' :style='productImage'></div>
        <div class='characteristic-container'>
            <div class='product-page__name'>Socks</div>
            <div class='product-characteristic'>
                <div class='product-characteristic__name'>{{ $t('product.price') }}</div>
                <div class='product-characteristic__value'>10$</div>
            </div>
            <div class='product-characteristic'>
                <div class='product-characteristic__name'>{{ $t('product.size') }}</div>
                <div class='product-characteristic__value'>44</div>
            </div>
            <div class='product-characteristic'>
                <div class='product-characteristic__name'>{{ $t('product.color') }}</div>
                <div class='product-characteristic__value'>Black</div>
            </div>
            <div class='product-characteristic'>
                <div class='product-characteristic__name'>{{ $t('product.material') }}</div>
                <div class='product-characteristic__value'>Suede</div>
            </div>
            <div class='button characteristic-container__button'>{{ $t('product.buy') }}</div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'product',
    data() {
        return {
            productImage: {
                backgroundImage: `url(/images/products/${this.$route.params.id}/1.jpeg)`
            }
        }
    }
}
</script>