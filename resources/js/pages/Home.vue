<template>
    <div class="wrapper">
        <Header />
        <router-view />
        <Footer />
    </div>
</template>

<script>
import Header from '../components/global/Header.vue';
import Footer from '../components/global/Footer.vue';

export default {
    name: 'home',
    components: {
        Header,
        Footer
    }
}
</script>