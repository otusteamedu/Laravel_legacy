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
    import AsyncWorldMap from "@/components/WorldMap/AsyncWorldMap.vue";
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
            AsyncWorldMap,
            PanelCardLink
        },
        mixins: [ pageTitle ],
        data() {
            return {
                product1: "./img/card-2.jpg",
                product2: "./img/card-3.jpg",
                product3: "./img/card-1.jpg",
                seq2: 0,
                mapData: {
                    AU: 760,
                    BR: 550,
                    CA: 120,
                    DE: 1300,
                    FR: 540,
                    GB: 690,
                    GE: 200,
                    IN: 200,
                    RO: 600,
                    RU: 300,
                    US: 2920
                },
                dailySalesChart: {
                    data: {
                        labels: ["M", "T", "W", "T", "F", "S", "S"],
                        series: [[12, 17, 7, 17, 23, 18, 38]]
                    },
                    options: {
                        lineSmooth: this.$Chartist.Interpolation.cardinal({
                            tension: 0
                        }),
                        low: 0,
                        high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
                        chartPadding: {
                            top: 0,
                            right: 0,
                            bottom: 0,
                            left: 0
                        }
                    }
                },
                dataCompletedTasksChart: {
                    data: {
                        labels: ["12am", "3pm", "6pm", "9pm", "12pm", "3am", "6am", "9am"],
                        series: [[230, 750, 450, 300, 280, 240, 200, 190]]
                    },

                    options: {
                        lineSmooth: this.$Chartist.Interpolation.cardinal({
                            tension: 0
                        }),
                        low: 0,
                        high: 1000, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
                        chartPadding: {
                            top: 0,
                            right: 0,
                            bottom: 0,
                            left: 0
                        }
                    }
                },
                emailsSubscriptionChart: {
                    data: {
                        labels: [
                            "Ja",
                            "Fe",
                            "Ma",
                            "Ap",
                            "Mai",
                            "Ju",
                            "Jul",
                            "Au",
                            "Se",
                            "Oc",
                            "No",
                            "De"
                        ],
                        series: [[542, 443, 320, 780, 553, 453, 326, 434, 568, 610, 756, 895]]
                    },
                    options: {
                        axisX: {
                            showGrid: false
                        },
                        low: 0,
                        high: 1000,
                        chartPadding: {
                            top: 0,
                            right: 5,
                            bottom: 0,
                            left: 0
                        }
                    },
                    responsiveOptions: [
                        [
                            "screen and (max-width: 640px)",
                            {
                                seriesBarDistance: 5,
                                axisX: {
                                    labelInterpolationFnc: function (value) {
                                        return value[0];
                                    }
                                }
                            }
                        ]
                    ]
                }
            };
        }
    };
</script>
