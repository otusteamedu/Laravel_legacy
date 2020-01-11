<template>
    <div class="md-layout">
        <div class="md-layout-item md-size-100">
            <md-card class="mt-0">
                <md-card-content>
                    <router-button-link route="manager.dashboard" title="В Панель управления" />
                </md-card-content>
            </md-card>
        </div>
        <panel-card-link route="manager.store.delivery" icon="local_shipping" title="Доставка" color="teal"/>
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

