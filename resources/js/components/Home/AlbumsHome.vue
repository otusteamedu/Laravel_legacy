<template lang="pug">
    section.tm-albums.uk-section.uk-section-xlarge.uk-section-default
        .uk-container.uk-text-center.uk-margin-large-bottom
            .uk-heading-medium.uk-margin-remove
                number(
                    :to="17564"
                    :duration="5"
                    )
            span.uk-heading-small Изображений
            .uk-divider-small
        .albums.uk-width-1-1(data-uk-scrollspy="start")
            .albums-side.albums-left(class="uk-width-expand@s")
            .tm-albums__content
                .uk-card.uk-card-primary.uk-card-body.uk-height-1-1.uk-box-shadow-large
                    span.uk-text-large Каталог по 30 темам, интерьерам и цветовым гаммам на любой вкус
                    a.tm-albums__button.uk-button.uk-button-primary.uk-button-large.uk-margin-large-top(href="") Каталог
            .albums-side.albums-right(class="uk-width-expand@s")
</template>

<script>
    import VueNumber from "vue-number-animation";

    import Albums from '../../../lib/apple-albums/js';
    export default {
        components: {
            VueNumber
        },
        mounted() {
            let albumLeftElement = document.querySelector('.albums-left');
            let albumRightElement = document.querySelector('.albums-right');
            const albums = Albums(albumLeftElement, albumRightElement);
            if (albums) {
                albums.init();
            }
        }
    }
</script>

<style scoped>
    /*@import '../../../lib/apple-albums/sass/albums.scss';*/
</style>
