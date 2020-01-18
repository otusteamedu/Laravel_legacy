<template>
    <md-button :class="`${color} md-just-icon`" @click.native="onClick">
        <md-icon>{{ icon }}</md-icon>
        <md-tooltip md-direction="left">{{ title }}</md-tooltip>
    </md-button>
</template>

<script>
    export default {
        name: "ControlButton",
        props: {
            title: {
                type: String,
                default: 'Создать'
            },
            icon: {
                type: String,
                default: 'check'
            },
            color: {
                type: String,
                default: 'md-success'
            }
        },
        methods: {
            onClick() {
                this.$emit('click')
            }
        }
    }
</script>
