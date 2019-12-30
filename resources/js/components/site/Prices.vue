<template>
    <div class="container">
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h2 class="display-6">Так какова же цена, за такое счастье?</h2>
            <p class="lead">
                Спешим обрадовать: все абсолютно бесплатно!
            </p>
            <p class="lead">
                Регистрируйся без какой-либо оплаты прямо сейчас!
            </p>
            <p class="lead">
                Налаживай общение! Делай бизнес проще!
            </p>
            <p class="lead">
                Не веришь? Попробуй сам!
            </p>
            <router-link class="btn btn-outline-primary" :to="{ name: 'site.registration' }">Регистрация</router-link>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
