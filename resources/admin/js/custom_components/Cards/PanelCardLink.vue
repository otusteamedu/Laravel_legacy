<template>
    <div class="md-layout-item md-medium-size-50 md-xsmall-size-100 md-size-25">
        <router-link :to="params ? { name: route, params } : { name: route }">
            <stats-card :header-color="color">
                <template slot="header">
                    <div class="card-icon">
                        <md-icon>{{ icon }}</md-icon>
                    </div>
                    <h4 class="title">{{ title }}</h4>
                    <p class="category" v-if="count">
                        <animated-number :value="count" />
                    </p>
                </template>

                <template slot="footer">
                    <div class="stats">
                        <md-icon>update</md-icon>
                        Just Updated
                    </div>
                </template>
            </stats-card>
        </router-link>
    </div>
</template>

<script>
    import { StatsCard, AnimatedNumber } from '@/components'

    export default {
        name: "PanelCardLink",
        components: {
            StatsCard,
            AnimatedNumber
        },
        props: {
            route: {
                type: String,
                required: true
            },
            params: {
                type: Object,
                default: null
            },
            icon: {
                type: String,
                required: true
            },
            title: {
                type: String,
                required: true
            },
            color: {
                type: String,
                default: 'default'
            },
            count: {
                type: Number
            }
        }
    }
</script>
