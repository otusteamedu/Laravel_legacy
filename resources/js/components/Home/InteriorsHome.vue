<template lang="pug">
    section.tm-interiors.uk-section.uk-section-xlarge.uk-section-default
        .uk-container.uk-container-large
            .tm-interiors__title.uk-width-xlarge
                h2.uk-heading-small Фотообои <br>для Вашего <br>интерьера
                .uk-divider-small
            .uk-flex-middle(data-uk-grid)
                .uk-width-1-1(class="uk-width-1-4@s uk-width-medium@l")
                    .tm-tab__container
                        ul.uk-tab-left(data-uk-tab="connect: #interiors-tab; animation: uk-animation-fade; media: @s")
                            li(v-for="interior in interiors" :key="interior.id")
                                a.uk-h4(href="") {{ interior.title }}
                .uk-width-expand
                    ul.uk-switcher(id="interiors-tab")
                        li(v-for="interior in interiors" :key="interior.id")
                            .tm-interiors__item.uk-position-relative.uk-dark
                                .tm-interiors__background.uk-background-cover(:data-src="interior.image" data-uk-img)
                                .tm-interiors__card.uk-card.uk-card-secondary.uk-card-body.uk-box-shadow-medium
                                    h3.uk-h4 {{ interior.cardTitle }}
                                    p {{ interior.cardText }}
</template>

<script>
    export default {
        data () {
            return {
                interiors: [
                    {
                        id: 1,
                        title: "Спальня",
                        cardTitle: "Фотообои для спальни",
                        cardText: "Здесь Вы увидите разнообразные фотообои для спальни. Свежее, оригинальное решение, которое обязательно будет приносить Вам радость каждый раз, когда Вы будете смотреть на него, утром и вечером.",
                        image: '/img/main/placements/bedroom.jpg'
                    },
                    {
                        id: 2,
                        title: "Гостиная",
                        cardTitle: "Фотообои для гостиной",
                        cardText: "Здесь Вы увидите разнообразные фотообои для спальни. Свежее, оригинальное решение, которое обязательно будет приносить Вам радость каждый раз, когда Вы будете смотреть на него, утром и вечером.",
                        image: '/img/main/placements/living-room.jpg'
                    },
                    {
                        id: 3,
                        title: "Кабинет",
                        cardTitle: "Фотообои для кабинета",
                        cardText: "Здесь Вы увидите разнообразные фотообои для спальни. Свежее, оригинальное решение, которое обязательно будет приносить Вам радость каждый раз, когда Вы будете смотреть на него, утром и вечером.",
                        image: '/img/main/placements/cabinet.jpg'
                    },
                    {
                        id: 4,
                        title: "Детская",
                        cardTitle: "Фотообои для детской",
                        cardText: "Здесь Вы увидите разнообразные фотообои для спальни. Свежее, оригинальное решение, которое обязательно будет приносить Вам радость каждый раз, когда Вы будете смотреть на него, утром и вечером.",
                        image: '/img/main/placements/childrens-room.jpg'
                    },
                    {
                        id: 5,
                        title: "Столовая",
                        cardTitle: "Фотообои для столовой",
                        cardText: "Здесь Вы увидите разнообразные фотообои для спальни. Свежее, оригинальное решение, которое обязательно будет приносить Вам радость каждый раз, когда Вы будете смотреть на него, утром и вечером.",
                        image: '/img/main/placements/dinning-room.jpg'
                    },
                    {
                        id: 6,
                        title: "Прихожая",
                        cardTitle: "Фотообои для прихожей",
                        cardText: "Здесь Вы увидите разнообразные фотообои для спальни. Свежее, оригинальное решение, которое обязательно будет приносить Вам радость каждый раз, когда Вы будете смотреть на него, утром и вечером.",
                        image: '/img/main/placements/hall.jpg'
                    }
                ]
            }
        }
    }
</script>

<style lang="scss">
    @import '../../../sass/uikit/variables-theme';
    @import '../../../sass/variables';
    @import '../../../sass/mixins';
    .tm-interiors {
        .uk-container {
            position: relative;
        }
        &__title {
            @include media-mob($s) {
                position: absolute;
                top: $global-small-margin;
                left: $global-gutter;
                z-index: 1;
            }
            @include media-mob($m) {
                top: $global-margin;
                left: $global-medium-margin;
            }
        }
        .tm-tab__container {
            @include media-mob($s) {
                margin-top: ($global-xlarge-margin + $global-large-margin);
            }
        }
        &__background {
            height: 300px;
            display: flex;
            align-items: flex-end;
            @include media-mob($s) {
                height: 75vh;
                min-height: 300px;
                max-height: 50vw;
            }
            @include media-mob($m) {
                min-height: 512px;
            }
            @include media-mob($qhd) {
                height: 65vh;
            }
        }
        &__card {
            width: calc(100% - #{$global-gutter});
            margin-left: $global-small-gutter;
            margin-top: -$global-margin;
            @include media-mob($s) {
                width: $width-large-width;
                margin-top: -$global-large-margin;
                margin-left: auto;
                margin-right: $global-gutter;
            }
            @include media-mob($m) {
                margin-right: $global-medium-margin;
            }
            @include media-mob($l) {
                margin-top: -$global-xlarge-margin;
            }
            @include media-mob($xl) {
                width: $width-xlarge-width;
                margin-right: 10vw;
            }
        }
        .uk-switcher {
            @include media-desk($s) {
                margin: 0 -$global-small-gutter;
            }
        }
    }
</style>
