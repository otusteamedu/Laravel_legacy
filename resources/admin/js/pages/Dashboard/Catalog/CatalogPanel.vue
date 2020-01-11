<template>
    <div class="md-layout">
        <div class="md-layout-item md-size-100">
            <md-card class="mt-0">
                <md-card-content>
                    <router-button-link />
                </md-card-content>
            </md-card>
        </div>
        <panel-card-link route="manager.catalog.categories.list" :params="{ category_type: 'topics' }" icon="collections_bookmark" title="Темы" color="blue" />
        <panel-card-link route="manager.catalog.categories.list" :params="{ category_type: 'colors' }" icon="palette" title="Цвета" color="rose" />
        <panel-card-link route="manager.catalog.categories.list" :params="{ category_type: 'interiors' }" icon="meeting_room" title="Интерьеры" color="green" />
        <panel-card-link route="manager.catalog.subcategories.list" :params="{ category_type: 'tags' }" icon="local_offer" title="Теги" color="primary" />
        <panel-card-link route="manager.catalog.subcategories.list" :params="{ category_type: 'owners' }" icon="cloud" title="Владельцы" color="warning" />
    </div>
</template>

<script>
    import PanelCardLink from '@/custom_components/Cards/PanelCardLink'
    import { pageTitle } from '@/mixins/base'

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

