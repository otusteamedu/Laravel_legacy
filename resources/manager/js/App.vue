<template>
<!--    Обновляет компонент, но ломается анимация роутов-->
<!--        <router-view :key="$route.fullPath" />-->
    <router-view />
</template>

<script>
import { mapGetters } from 'vuex'

export default {
    computed: {
        ...mapGetters([
            'serverErrors'
        ])
    },
    methods: {
        notifyVue(message) {
            this.$notify(
                {
                    message: message,
                    icon: 'add_alert',
                    horizontalAlign: 'center',
                    verticalAlign: 'top',
                    type: 'danger',
                    timeout: 5000
                }
            )
        }
    },
    watch: {
        serverErrors() {
            this.serverErrors.forEach(message => this.notifyVue(message))
        }
    }
}
</script>
