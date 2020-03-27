<template>
    <div>
        <h4 v-if="title" class="card-title">{{ title }}</h4>
        <md-field>
            <label v-if="placeholder">{{ placeholder }}</label>
            <slot></slot>
        </md-field>
    </div>
</template>

<script>
    export default {
        name: "FormWrap",
        props: {
            title: {
                type: String
            },
            placeholder: {
                type: String
            }
        },
        methods: {
            onSelect (value) {
                this.$emit('selected', value);
            }
        }
    }
</script>

<style scoped>

</style>
