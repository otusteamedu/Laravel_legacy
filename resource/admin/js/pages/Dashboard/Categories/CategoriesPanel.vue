<template>
    <div class="md-layout">
        <div class="md-layout-item md-size-100">
            <md-card class="mt-0">
                <md-card-content>
                    <router-button-link />
                </md-card-content>
            </md-card>
        </div>
        <panel-card-link route="admin.categories.topics" icon="collections_bookmark" title="Темы" color="blue" />
        <panel-card-link route="admin.categories.colors" icon="palette" title="Цвета" color="rose" />
        <panel-card-link route="admin.categories.placements" icon="meeting_room" title="Помещения" color="green" />
        <panel-card-link route="admin.categories.owners" icon="cloud" title="Владельцы" color="warning" />
    </div>
</template>

<script>
    import PanelCardLink from '@/custom_components/Cards/PanelCardLink'
    import { pageTitle } from '@/mixins/actions'

    export default{
        components: {
            PanelCardLink
        },
        mixins: [ pageTitle ],
        data () {
            return {
            }
        },
        created() {
            this.setPageTitle('Категории');
        }
    }
</script>

