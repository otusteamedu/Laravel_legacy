<template lang="pug">
    section.tm-albums.uk-section.uk-padding-remove-vertical.uk-section-default
        .uk-container.uk-container-large
            .uk-margin-large-bottom.uk-text-center.uk-width-large.uk-margin-auto
                h2.uk-heading-small Качественные <br>материалы
                .uk-divider-small.uk-margin-large-bottom
                span.uk-text-large Качественная фактура, 100% стыковка, насыщенность цвета
            carousel-3d(
                :width="500"
                :height="500"
                :border="0"
                :display="5"
                :controls-visible="true"
                :controls-prev-html="'<span data-uk-icon=\"icon: chevron-left; ratio: 2\"></span>'"
                :controls-next-html="'<span data-uk-icon=\"icon: chevron-right; ratio: 2\"></span>'"
                :controls-width="40"
                :controls-height="60"
                :clickable="false"
                )
                slide(v-for="(slide, i) in slides"
                    :index="i"
                    :key="slide.id"
                    :title="slide.title"
                    :width="slide.width"
                    :price="slide.price"
                    :newPrice="slide.newPrice"
                    )
                    figure
                        img(
                            :data-src="slide.src"
                            :alt="slide.title"
                            data-uk-img
                            )
</template>

<script>
    import { Carousel3d } from 'vue-carousel-3d';
    import Slide from '@@/components/Home/Materials/Slide';

    export default {
        components: {
            Carousel3d,
            Slide
        },
        data () {
            return {
                slides: [
                    {
                        id: 1,
                        title: 'Кора',
                        src: '/img/materials/texture-01.jpg',
                        width: 103,
                        price: 990,
                        newPrice: 987
                    },
                    {
                        id: 2,
                        title: 'Лен',
                        src: '/img/materials/texture-02.jpg',
                        width: 104,
                        price: 890,
                        newPrice: 800
                    },
                    {
                        id: 3,
                        title: 'Вельвет',
                        src: '/img/materials/texture-03.jpg',
                        width: 105,
                        price: 1050,
                        newPrice: 990
                    },
                    {
                        id: 4,
                        title: 'Кожа',
                        src: '/img/materials/texture-04.jpg',
                        width: 130,
                        price: 950,
                        newPrice: 900
                    },
                    {
                        id: 5,
                        title: 'Кожа',
                        src: '/img/materials/texture-05.jpg',
                        width: 105,
                        price: 970,
                        newPrice: null
                    },
                    {
                        id: 6,
                        title: 'Кожа',
                        src: '/img/materials/texture-06.jpg',
                        width: 103,
                        price: 1000,
                        newPrice: 900
                    },
                    {
                        id: 7,
                        title: 'Кожа',
                        src: '/img/materials/texture-07.jpg',
                        width: 105,
                        price: 850,
                        newPrice: 590
                    },
                    {
                        id: 8,
                        title: 'Кожа',
                        src: '/img/materials/texture-08.jpg',
                        width: 104,
                        price: 850,
                        newPrice: null
                    },
                    {

                        id: 9,
                        title: 'Холст',
                        src: '/img/materials/texture-09.jpg',
                        width: 105,
                        price: 850,
                        newPrice: null
                    }
                ]
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import '../../../sass/uikit/variables-theme';
    @import '../../../sass/variables';
    @import '../../../sass/mixins';
    .uk-container {
        padding: 0;
    }
    .carousel-3d-container {
        z-index: 1;
    }
</style>
