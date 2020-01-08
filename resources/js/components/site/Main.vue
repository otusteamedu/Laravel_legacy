<template>
    <div>
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
            <h5 class="my-0 mr-md-auto font-weight-normal">Маркет плэйс</h5>
            <nav class="my-2 my-md-0 mr-md-3">
                <router-link class="p-2 text-dark" :to="{ name: 'site.home' }">Главная</router-link>
                <router-link class="p-2 text-dark" :to="{ name: 'site.features' }">Наши преимущества</router-link>
                <router-link class="p-2 text-dark" :to="{ name: 'site.about' }">О нас</router-link>
                <router-link class="p-2 text-dark" :to="{ name: 'site.contacts' }">Контакты</router-link>
                <router-link class="p-2 text-dark" :to="{ name: 'site.prices' }">Цены</router-link>
            </nav>
            <router-link v-if="!$auth.check()" class="btn btn-outline-primary" :to="{ name: 'site.login' }">Войти</router-link>
            <router-link v-if="!$auth.check()" class="btn btn-outline-primary" :to="{ name: 'site.registration' }">Регистрация</router-link>
            <router-link v-if="$auth.check()" class="btn btn-outline-primary" :to="{ name: 'admin.main' }">Личный кабинет</router-link>
            <a v-if="$auth.check()" class="btn btn-outline-primary" href="#" @click.prevent="$auth.logout()">Выйти</a>
        </div>
        <div class="container">
            <router-view></router-view>
        </div>
        <footer class="pt-4 my-md-5 pt-md-5 border-top">
            <div class="row">
                <div class="col-12 col-md">
                    <small class="d-block mb-3 text-muted">&copy; ОАО Маркет-плэйс 2017-2018</small>
                </div>
                <div class="col-6 col-md">
                    <h5>Навигация</h5>
                    <ul class="list-unstyled text-small">
                        <router-link class="text-muted" :to="{ name: 'site.home' }">Главная</router-link>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5>Основная информация</h5>
                    <ul class="list-unstyled text-small">
                        <router-link class="text-muted" :to="{ name: 'site.about' }">О нас</router-link>
                        <router-link class="text-muted" :to="{ name: 'site.contacts' }">Контакты</router-link>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5>О нас</h5>
                    <ul class="list-unstyled text-small">
                        <router-link class="text-muted" :to="{ name: 'site.about' }">О нас</router-link>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</template>
<script>
    export default {
        mounted() {
            console.log('Component Main mounted');
            console.log('Check login', this.$auth.check());
        }
    }
</script>
