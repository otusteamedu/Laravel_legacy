<template>
    <div class="md-layout">
        <panel-card-link route="manager.images" icon="image" title="Изображения" :count="13434" color="danger" />
        <panel-card-link route="manager.catalog" icon="category" title="Каталог" :count="23" color="rose" />
        <panel-card-link route="manager.textures" icon="style" title="Фактуры" :count="6" color="primary" />
        <panel-card-link route="manager.settings" icon="settings" title="Конфигурация" :count="15" color="deep-purple" />
        <panel-card-link route="manager.store" icon="local_mall" title="Магазин" color="indigo"/>
        <panel-card-link route="manager.users" icon="people" title="Пользователи" :count="1234" color="blue"/>
        <panel-card-link route="manager.roles" icon="business_center" title="Роли" :count="14" color="light-blue" />
        <panel-card-link route="manager.permissions" icon="vpn_key" title="Привилегии" :count="24" color="cyan" />
    </div>
</template>

<script>
    // import AsyncWorldMap from "@/components/WorldMap/AsyncWorldMap.vue";
    import {
        ChartCard,
        ProductCard,
        AnimatedNumber,
        GlobalSalesCard,
        GlobalSalesTable
    } from "@/components";

    import PanelCardLink from '@/custom_components/Cards/PanelCardLink'
    import { pageTitle } from '@/mixins/base'

    export default {
        components: {
            ChartCard,
            AnimatedNumber,
            ProductCard,
            GlobalSalesCard,
            GlobalSalesTable,
            // AsyncWorldMap,
            PanelCardLink
        },
        mixins: [ pageTitle ],
        data() {
            return {

            }
        },
        created() {
            this.setPageTitle('Панель управления');
        }
    };
</script>
