<template lang="pug">
    .tm-material
        section.uk-section.uk-section-xlarge.uk-section-default
            .uk-container
                .uk-material__header(data-uk-scrollspy="cls:uk-animation-slide-bottom-small; delay: 300")
                    h2.uk-heading-small.uk-margin-remove {{ title }}
                    .uk-divider-small
                .uk-grid.uk-margin-medium-top(data-uk-grid)
                    .tm-material__description(class="uk-width-3-5@s" data-uk-scrollspy="cls:uk-animation-slide-bottom-small; delay: 300")
                        p {{ description }}
                        hr.uk-margin
                        .tm-material__bottom.tm-text-medium
                            span.tm-material__spec Ширина:
                                span.tm-material__spec-value {{ width }} см
                            span.tm-material__spec Цена:
                                span.tm-material__spec-value {{ cost }} ₽/м<sup>2</sup>
                    .tm-material__sample(class="uk-width-3-4 uk-width-2-5@s" data-uk-lightbox data-uk-scrollspy="cls:uk-animation-slide-bottom-small; delay: 700")
                        div
                            a.uk-inline.uk-transition-toggle(:href="textureSrc" tabindex="0" :data-caption="title")
                                img.uk-box-shadow-large(:data-src="textureSrc" data-uk-img)
        section.tm-material-sample.uk-section.uk-background-fixed.uk-background-cover(:data-src="exampleSrc" data-uk-img)
</template>

<script>
    export default {
        props: {
            title: {
                type: String,
                require: true
            },
            description: {
                type: String,
                require: true
            },
            width: {
                type: Number,
                require: true
            },
            cost: {
                type: Number,
                require: true
            },
            textureSrc: {
                type: String,
                require: true
            },
            exampleSrc: {
                type: String,
                require: true
            }

        }
    }
</script>

<style lang="scss" scoped>
    @import '../../../sass/uikit/variables-theme';
    @import '../../../sass/variables';
    @import '../../../sass/mixins';

    .tm-material {
        &__spec {
            &:not(:first-child) {
                margin-left: $global-margin;
            }

            &-value {
                margin-left: $global-small-margin / 2;
                font-weight: $base-strong-font-weight;
                color: $global-emphasis-color;
            }
        }

        &__sample {
            img {
                width: 100%;
                height: auto;
                display: block;
            }
        }
    }

    .tm-material-sample {
        min-height: 500px;
        max-height: 150vw;
        height: 100vh;
    }
</style>
