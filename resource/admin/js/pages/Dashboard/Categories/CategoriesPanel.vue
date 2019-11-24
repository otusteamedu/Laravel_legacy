<template>
    <div class="md-layout">
        <div class="md-layout-item md-size-100">
            <md-card class="mt-0">
                <md-card-content>
                    <router-link :to="{ name: 'admin.dashboard' }">
                        <md-button class="md-info md-just-icon">
                            <md-icon>arrow_back</md-icon>
                            <md-tooltip md-direction="right">В Панель управления</md-tooltip>
                        </md-button>
                    </router-link>
                </md-card-content>
            </md-card>
        </div>
        <div class="md-layout-item md-medium-size-50 md-xsmall-size-100 md-size-25">
            <router-link :to="{ name: 'admin.categories.topics' }">
                <stats-card header-color="blue">
                    <template slot="header">
                        <div class="card-icon">
                            <md-icon>collections_bookmark</md-icon>
                        </div>
                        <h3 class="title">Темы</h3>
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
        <div class="md-layout-item md-medium-size-50 md-xsmall-size-100 md-size-25">
            <router-link :to="{ name: 'admin.categories.colors' }">
                <stats-card header-color="blue">
                    <template slot="header">
                        <div class="card-icon">
                            <md-icon>palette</md-icon>
                        </div>
                        <h3 class="title">Цвета</h3>
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
        <div class="md-layout-item md-medium-size-50 md-xsmall-size-100 md-size-25">
            <router-link :to="{ name: 'admin.categories.placements' }">
                <stats-card header-color="blue">
                    <template slot="header">
                        <div class="card-icon">
                            <md-icon>meeting_room</md-icon>
                        </div>
                        <!--                        <p class="category">Помещения</p>-->
                        <h3 class="title">Помещения</h3>
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
        <div class="md-layout-item md-medium-size-50 md-xsmall-size-100 md-size-25">
            <router-link :to="{ name: 'admin.categories.owners' }">
                <stats-card header-color="blue">
                    <template slot="header">
                        <div class="card-icon">
                            <md-icon>cloud</md-icon>
                        </div>
                        <h3 class="title">Владельцы</h3>
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
    </div>
</template>

<script>

    import {
        StatsCard,
    } from '@/components'

    export default {
        components: {
            StatsCard
        },
        data() {
            return {}
        },
        created() {
            this.$store.dispatch('setPageTitle', 'Категории');
        },

    }
</script>