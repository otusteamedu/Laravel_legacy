<template lang="pug">
    section.uk-section.uk-padding-remove-vertical.uk-overflow-hidden
        .tm-hero.uk-container.uk-light
            .tm-hero__container(data-uk-grid)
                .tm-hero__strip-block(class="uk-width-1-2@m")
                    .tm-hero__strip.uk-background-cover(data-src="/img/main/hero/strip-1.jpg" data-uk-img data-uk-scrollspy="cls:uk-animation-slide-top; delay: 500")
                        img.tm-hero__strip-roll(data-src="/img/main/hero/roll.png" data-uk-img)
                .tm-hero__content(data-uk-scrollspy="cls:uk-animation-fade" class="uk-width-1-2@m")
                    .tm-hero__heading
                        span.tm-hero__brand-name.uk-heading-large.uk-text-background Calipari
                        span.tm-hero__title.uk-h1.uk-margin-remove Студия печати<br>и дизайна
                        span.tm-hero__lead.uk-margin-top Изготовление фотообоев<br>на заказ
                        a.tm-hero__email.tm-text-medium.uk-link-muted.uk-link-reset(href="") info@calipari.ru
                    a.tm-hero__phone.tm-text-medium.uk-link-muted.uk-link-reset(href="") +7 952 967 4204
            .tm-hero__socials(data-uk-scrollspy="cls:uk-animation-fade")
                a.uk-link-reset.uk-text-uppercase(href="") Vkontakte
                a.uk-link-reset.uk-text-uppercase(href="") Facebook
                a.uk-link-reset.uk-text-uppercase(href="") Instagram
</template>

<script>
</script>

<style scoped>

</style>
