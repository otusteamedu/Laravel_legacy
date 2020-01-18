<template>
    <router-link :to="params ? { name: route, params } : { name: route }">
        <md-button :class="`${color} md-just-icon`">
            <md-icon>{{ icon }}</md-icon>
            <md-tooltip md-direction="right">{{ title }}</md-tooltip>
        </md-button>
    </router-link>
</template>

<script>
    export default {
        name: "RouterButtonLink",
        props: {
            route: {
                type: String,
                default: 'manager.dashboard'
            },
            params: {
                type: Object,
                default: null
            },
            icon: {
                type: String,
                default: 'arrow_back'
            },
            color: {
                type: String,
                default: 'md-info'
            },
            title: {
                type: String,
                default: 'Назад'
            }
        }
    }
</script>
