<template lang="pug">
    section.tm-buying-scheme.uk-section.uk-section-xlarge.uk-section-default
        .uk-container.uk-container-large
            h2.uk-heading-small.uk-width-large Как <br>купить <br>фотообои?
            .uk-divider-small
            .uk-margin-xlarge-top.uk-flex.uk-flex-right
                div(class="uk-width-4-5@m")
                    .tm-buying-scheme__card.uk-card.uk-grid-collapse(class="uk-child-width-1-2@s" data-uk-grid)
                        .uk-card-media-left.uk-cover-container
                            img(src="/img/main/placements/bedroom.jpg" alt="" data-uk-cover)
                            canvas.tm-buying-scheme__card-canvas
                        .uk-card-body.tm-card__number(data-num="1")
                            h3.uk-card-title Выбираете изображение
                            p Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
                    .tm-buying-scheme__card.uk-card.uk-grid-collapse.uk-margin(class="uk-child-width-1-2@s" data-uk-grid)
                        .uk-card-media-right.uk-cover-container(class="uk-flex-last@s")
                            img(src="/img/main/placements/bedroom.jpg" alt="" data-uk-cover)
                            canvas.tm-buying-scheme__card-canvas
                        .uk-card-body.tm-card__number(data-num="2")
                            h3.uk-card-title Оформляете заказ
                            p Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
                    .tm-buying-scheme__card.uk-card.uk-grid-collapse.uk-margin(class="uk-child-width-1-2@s" data-uk-grid)
                        .uk-card-media-left.uk-cover-container
                            img(src="/img/main/placements/bedroom.jpg" alt="" data-uk-cover)
                            canvas.tm-buying-scheme__card-canvas
                        .uk-card-body.tm-card__number(data-num="3")
                            h3.uk-card-title Согласовываем макет
                            p Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
                    .tm-buying-scheme__card.uk-card.uk-grid-collapse.uk-margin(class="uk-child-width-1-2@s" data-uk-grid)
                        .uk-card-media-right.uk-cover-container(class="uk-flex-last@s")
                            img(src="/img/main/placements/bedroom.jpg" alt="" data-uk-cover)
                            canvas.tm-buying-scheme__card-canvas
                        .uk-card-body.tm-card__number(data-num="4")
                            h3.uk-card-title Производите оплату
                            p Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
                    .tm-buying-scheme__card.uk-card.uk-grid-collapse.uk-margin(class="uk-child-width-1-2@s" data-uk-grid)
                        .uk-card-media-left.uk-cover-container
                            img(src="/img/main/placements/bedroom.jpg" alt="" data-uk-cover)
                            canvas.tm-buying-scheme__card-canvas
                        .uk-card-body.tm-card__number(data-num="5")
                            h3.uk-card-title Печатаем фотообои для Вашего интерьера и отправляем Вам
                            p Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
</template>

<script>
    export default {
        name: "BuyingSchemeHome"
    }
</script>

<style lang="scss">
    @import '../../../sass/uikit/variables-theme';
    @import '../../../sass/variables';
    @import '../../../sass/mixins';
    .tm-buying-scheme {
        &__card {
            @include media-mob($s){
                &:not(:last-child) {
                    margin-bottom: $global-gutter;
                }
            }
            @include media-mob($m){
                &:not(:last-child) {
                    margin-bottom: $global-medium-margin;
                }
            }
            @include media-desk($s) {
                .uk-card-body {
                    padding-left: 0;
                    padding-right: $global-medium-margin;
                }
            }
            &-canvas {
                height: 250px;
                @include media-mob($l){
                    height: 300px;
                }
                @include media-mob($hxl){
                    height: 350px;
                }
                @include media-mob($xxl){
                    height: 400px;
                }
            }
        }
    }
</style>
