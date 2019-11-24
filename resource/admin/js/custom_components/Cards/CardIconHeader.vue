<template>
    <md-card-header class="md-card-header-icon md-card-header-green">
        <div class="card-icon">
            <md-icon>{{ icon }}</md-icon>
        </div>
        <h3 class="title">{{ title }}</h3>
    </md-card-header>
</template>

<script>
    export default {
        name: "CardIconHeader",
        props: {
            icon: {
                type: String,
                default: 'settings'
            },
            title: {
                type: String,
                default: 'Установки'
            }
        }
    }
</script>
