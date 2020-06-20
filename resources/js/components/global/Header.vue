<template>
    <div class='header'>
        <div class='header__logo-container'>
            <router-link to='/' class='header__logo'>Medieval trade</router-link>
            <router-link to='/admin' class='header__admin-button'>
                <font-awesome-icon icon='cog' />
            </router-link>
        </div>
        <div class='header__settings'>
            <div class='header__login-container'>
                <router-link to='/login' class='header__login-button button'>{{ $t('main.login' )}}</router-link>
                <router-link to='/registration' class='header__login-button button'>{{ $t('main.registration') }}</router-link>
                <router-link to='/basket' class='button'>
                    <font-awesome-icon class='button__icon' icon="shopping-basket" />
                </router-link>
            </div>
            <div class='header__language-container'>
                <div class='header__language-button button' @click.prevent='setLocale("en")'>En</div>
                <div class='header__language-button button' @click.prevent='setLocale("ru")'>Ru</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'vue-header',
    methods: {
        setLocale(locale) {
            if (this.$i18n.locale != locale) {
                this.$i18n.locale = locale;
            }
        }
    }
}
</script>