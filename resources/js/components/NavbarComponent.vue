<template lang="pug">
    .tm-navbar.uk-box-shadow-medium
        .tm-navbar__background
        .uk-navbar-container.uk-light.uk-navbar-transparent
            .uk-container
                nav(data-uk-navbar)
                    .uk-navbar-left
                        a.tm-logo.uk-logo.uk-icon(href="" data-uk-icon="calipari")
                    .uk-navbar-center(class="uk-visible@m")
                        ul.uk-navbar-nav
                            li.uk-active: a(href="/catalog") Каталог
                            li: a(href="/materials") Материалы
                            li: a(href="#") Информация
                            li: a(href="#") Портфолио
                            li: a(href="#") Контакты
                    .uk-navbar-right
                        ul.uk-navbar-nav.tm-navbar-icon(class="uk-visible@m")
                            li: a(href="" data-uk-icon="search")
                            //- li: a(href="" data-uk-icon="heart"): span.uk-badge 756
                            li: a(href="/cart" data-uk-icon="bag"): span.uk-badge 1
                            li: a(href="/login" data-uk-icon="user")
                        a.uk-navbar-toggle(href="#menu" data-uk-toggle data-uk-icon="menu" class="uk-hidden@m")
</template>

<script>

</script>

<style scoped>

</style>
