<template lang="pug">
    section.tm-feedback.uk-section.uk-section-large.uk-section-primary.uk-light
        .uk-container
            .tm-feedback__container(class="uk-child-width-1-2@m" data-uk-grid)
                div
                    h2.uk-h2.uk-heading-small Получите бесплатную консультацию от&nbsp;дизайнера
                form
                    .uk-inline.uk-width-1-1.uk-margin-small
                        span.uk-form-icon(data-uk-icon="icon: user")
                        input.uk-input.uk-form-large(type="text")
                    .uk-inline.uk-width-1-1.uk-margin-small
                        span.uk-form-icon(data-uk-icon="icon: receiver")
                        input.uk-input.uk-form-large(type="tel")
                    .uk-inline.uk-margin.uk-margin-medium-top
                        div(class="" data-uk-grid)
                            p.uk-text-small(class="uk-width-expand@s") Нажимая кнопку «Отправить», я&nbsp;даю согласие на обработку персональных данных и соглашаюсь <a href="#" class="uk-link-text">политикой конфиденциальности</a>
                            div(class="uk-width-auto@s")
                                button.uk-button.uk-button-primary.uk-button-large(type="submit") Отправить
</template>

<script>
    export default {
        name: "ConsultationComponent"
    }
</script>

<style lang="scss" scoped>
    @import '../../sass/uikit/variables-theme';
    @import '../../sass/variables';
    @import '../../sass/mixins';
    .uk-container {
        @include media-desk($m) {
            max-width: $width-large-width !important;
        }
    }
</style>
