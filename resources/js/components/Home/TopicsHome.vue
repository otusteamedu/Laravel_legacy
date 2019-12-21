<template lang="pug">
    section.tm-topics.uk-section.uk-section-xlarge.uk-section-default
        .uk-container.uk-container-large
            h2.uk-heading-small Темы
            .uk-divider-small
            .uk-margin-large-top(data-uk-grid)
                .uk-width-1-1(class="uk-width-1-4@s uk-width-medium@l")
                    .tm-tab__container
                        ul.uk-tab-left(data-uk-tab="connect: #topics-tab; animation: uk-animation-fade; media: @s")
                            li(v-for="topic in topics" :key="topic.id")
                                a.uk-h4(href="") {{ topic.title }}
                .uk-width-expand
                    ul.uk-switcher(id="topics-tab")
                        li(v-for="topic in topics" :key="topic.id")
                            .uk-grid-collapse(class="uk-child-width-1-2 uk-child-width-1-3@m uk-child-width-1-4@l" data-uk-grid="masonry: true" data-uk-lightbox="animation: slide")
                                .tm-image(v-for="(image, i) in topic.images" :key="i")
                                    a.tm-image__link.uk-inline.uk-transition-toggle(:href="image" tabindex="0" data-caption="Caption 1")
                                        img.uk-box-shadow-medium(:data-src="image" alt="" data-uk-img)
                                        .uk-transition-fade.uk-overlay.uk-overlay-primary.uk-position-cover(v-if="!touch")
                                            .uk-position-center
                                                span(data-uk-overlay-icon)
                                            .tm-image__footer.uk-position-bottom
                                                .tm-image__article
                                                    span.tm-image__article-prefix.uk-text-muted А
                                                    span.tm-image__article-number 000234
                                    .tm-image__footer.uk-position-bottom-right
                                        span.tm-image__likes.uk-icon(data-uk-icon="icon: heart; ratio: 0.8")
</template>

<script>
    import MobileDetect from 'mobile-detect';
    const md = new MobileDetect(window.navigator.userAgent);
    export default {
        data () {
            return {
                touch: false,
                topics: [
                    {
                        id: 1,
                        title: "Мегаполис",
                        images: [
                            '../../img/main/topics/megapolice/A0010.jpg',
                            '../../img/main/topics/megapolice/A0032.jpg',
                            '../../img/main/topics/megapolice/A0037.jpg',
                            '../../img/main/topics/megapolice/A0045.jpg',
                            '../../img/main/topics/megapolice/A0116.jpg',
                            '../../img/main/topics/megapolice/A0135.jpg',
                            '../../img/main/topics/megapolice/A0217.jpg',
                            '../../img/main/topics/megapolice/A0238.jpg',
                            '../../img/main/topics/nature/E0390.jpg',
                            '../../img/main/topics/nature/F0034.jpg'
                        ]
                    },
                    {
                        id: 2,
                        title: "Природа",
                        images: [
                            '../../img/main/topics/nature/E0284.jpg',
                            '../../img/main/topics/nature/F0084.jpg',
                            '../../img/main/topics/nature/E0287.jpg',
                            '../../img/main/topics/nature/E0289.jpg',
                            '../../img/main/topics/nature/E0304.jpg',
                            '../../img/main/topics/nature/E0380.jpg',
                            '../../img/main/topics/nature/E0390.jpg',
                            '../../img/main/topics/nature/F0034.jpg',
                            '../../img/main/topics/nature/E0390.jpg',
                            '../../img/main/topics/nature/F0034.jpg'
                        ]
                    },
                    {
                        id: 3,
                        title: "Живопись",
                        images: [
                            '../../img/main/topics/megapolice/A0010.jpg',
                            '../../img/main/topics/megapolice/A0032.jpg',
                            '../../img/main/topics/megapolice/A0037.jpg',
                            '../../img/main/topics/megapolice/A0045.jpg',
                            '../../img/main/topics/megapolice/A0116.jpg',
                            '../../img/main/topics/megapolice/A0135.jpg',
                            '../../img/main/topics/megapolice/A0217.jpg',
                            '../../img/main/topics/megapolice/A0238.jpg'
                        ]
                    },
                    {
                        id: 4,
                        title: "Города",
                        images: [
                            '../../img/main/topics/nature/E0284.jpg',
                            '../../img/main/topics/nature/F0084.jpg',
                            '../../img/main/topics/nature/E0287.jpg',
                            '../../img/main/topics/nature/E0289.jpg',
                            '../../img/main/topics/nature/E0304.jpg',
                            '../../img/main/topics/nature/E0380.jpg',
                            '../../img/main/topics/nature/E0390.jpg',
                            '../../img/main/topics/nature/F0034.jpg'
                        ]
                    },
                    {
                        id: 5,
                        title: "Живопись",
                        images: [
                            '../../img/main/topics/megapolice/A0010.jpg',
                            '../../img/main/topics/megapolice/A0032.jpg',
                            '../../img/main/topics/megapolice/A0037.jpg',
                            '../../img/main/topics/megapolice/A0045.jpg',
                            '../../img/main/topics/megapolice/A0116.jpg',
                            '../../img/main/topics/megapolice/A0135.jpg',
                            '../../img/main/topics/megapolice/A0217.jpg',
                            '../../img/main/topics/megapolice/A0238.jpg'
                        ]
                    },
                    {
                        id: 6,
                        title: "Города",
                        images: [
                            '../../img/main/topics/nature/E0284.jpg',
                            '../../img/main/topics/nature/F0084.jpg',
                            '../../img/main/topics/nature/E0287.jpg',
                            '../../img/main/topics/nature/E0289.jpg',
                            '../../img/main/topics/nature/E0304.jpg',
                            '../../img/main/topics/nature/E0380.jpg',
                            '../../img/main/topics/nature/E0390.jpg',
                            '../../img/main/topics/nature/F0034.jpg'
                        ]
                    }
                ]
            }
        },
        created() {
            if (md.tablet() || md.phone()) {
                this.touch = true;
                console.log('touch')
            }
        }
    }
</script>
