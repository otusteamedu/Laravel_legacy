<template lang="pug">
    footer.tm-footer.uk-section.uk-section-primary
        .uk-container.uk-container-expand
            .tm-footer__content
                a.uk-logo.uk-icon(href="" data-uk-icon="icon: calipari; ratio: 1.2")
                .tm-footer__contacts.uk-flex
                    a.uk-link(href="#") sotav@yandex.ru
                    a.uk-link(href="#") +7 (952) 967 42 04
                    .tm-socials
                        a.uk-link-reset.uk-text-uppercase(href="") Vkontakte
                        a.uk-link-reset.uk-text-uppercase(href="") Facebook
                        a.uk-link-reset.uk-text-uppercase(href="") Instagram
            .tm-footer__bottom
                .tm-footer__links
                    a.uk-link-muted(href="#") Политика конфиденциальности
                    a.uk-link-muted(href="#") Использование cookies
                    a.uk-link-muted(href="#") Продажа и возврат
                    a.uk-link-muted(href="#") Карта сайта
                span.tm-footer__copyright © Aura, 2019. Все права защищены.
</template>

<script>
    export default {
    }
</script>

<style lang="scss" scoped>
@import '../../sass/uikit/variables-theme';
@import '../../sass/variables';
@import '../../sass/mixins';

.tm-footer {
    margin-top: auto !important;
    @include media-mob($l){
        margin-bottom: 0;
    }
    &__content {
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        align-items: center;
        .tm-logo {
            margin-bottom: $global-margin;
        }
        @include media-mob($s){
            .tm-logo {
                margin-bottom: 0;
            }
            flex-direction: row;
            justify-content: space-between;
            margin-bottom: $global-margin;
        }
    }
    &__contacts {
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        align-items: center;
        font-size: 1.5rem;
        line-height: 1;
        .tm-socials {
            margin-bottom: $global-margin;
            @include media-mob($m){
                padding-left: $global-margin;
                border-left: 1px solid $inverse-global-border;
            }
        }
        @include media-desk($s) {
            width: 100%;
            margin-top: $global-margin;
            > * {
                &:not(:last-child) {
                    margin-bottom: $global-small-margin;
                }
            }
            .tm-socials {
                margin-top: $global-small-margin;
            }
        }
        @include media-mob($s){
            flex-direction: row;
            align-items: flex-end;
            font-size: 1.2rem;
            justify-content: flex-end;
            width: 400px;
            > * {
                margin-bottom: 0;
                &:not(:first-child) {
                    margin-left: $global-margin;
                }
            }
            .tm-socials {
                margin-top: $global-small-margin;
                margin-bottom: 0;
                text-align: right;
            }
        }
        @include media-mob($m){
            width: auto;
            font-size: 1.1rem;
            .tm-socials {
                margin-top: 0;
            }
        }

    }
    &__bottom {
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        margin-top: $global-small-margin;
        align-items: center;
        @include media-mob($s){
            flex-direction: row-reverse;
            justify-content: space-between;
            align-items: flex-end;
        }
    }
    &__links, &__copyright {
        font-size: 12px;
        font-weight: normal;
    }
    &__links {
        margin-bottom: $global-margin;
        text-align: center;
        a {
            display: inline-block;
            line-height: 1;
            &:not(:first-child) {
                padding-left: $global-small-margin;
                margin-left: $global-small-margin;
                border-left: 1px solid $inverse-global-border;
            }
            .uk-dark & {
                color: $global-color;
                &:not(:last-child) {
                    border-color: $global-border;
                }
            }
        }
        @include media-mob($s){
            margin-bottom: 0;
            width: 50%;
            text-align: right;
        }
        @include media-mob($m) {
            width: auto;
        }
    }
}
</style>
