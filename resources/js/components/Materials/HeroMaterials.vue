<template lang="pug">
    .tm-materials
        section.tm-materials__hero.uk-section.uk-flex.uk-flex-middle.uk-background-cover(data-uk-height-viewport="offset-top: true")
            .uk-container
                .tm-materials__hero-content.uk-margin-xlarge-bottom(class="uk-width-large@s uk-width-xlarge@m")
                    .uk-margin-large-bottom
                        h1.uk-margin-remove Материалы
                        .uk-divider-small
                    div
                    .tm-text-medium В нашем интернет-магазине Вы сможете купить любые фотообои на стену из более чем 7 000 подобранных изображений и из 40 млн. фото из фотобанков. Все фотообои производятся на заказ по Вашим размерам и именно под Вашу стену. Заполните размеры, оформите заявку и уже через 3 дня заказ будет у Вас.
        item-materials(
            v-for="item in items"
            :key="item.id"
            :title="item.title"
            :description="item.description"
            :width="item.width"
            :cost="item.cost"
            :textureSrc="item.textureSrc"
            :exampleSrc="item.exampleSrc"
        )

</template>

<script>
    import ItemMaterials from "./ItemMaterials";
    export default {
        components: {
            ItemMaterials
        },
        data () {
            return {
                items: [
                    {
                        id: 1,
                        title: 'Холст',
                        description: 'В нашем интернет-магазине Вы сможете купить любые фотообои на стену из более чем 7 000 подобранных изображений и из 40 млн. фото из фотобанков. Все фотообои производятся на заказ по Вашим размерам и именно под Вашу стену. Заполните размеры, оформите заявку и уже через 3 дня заказ будет у Вас.',
                        width: 103,
                        cost: 990,
                        textureSrc: '/img/materials/texture-09.jpg',
                        exampleSrc: '/img/materials/bg/example-02.jpg'
                    },
                    {
                        id: 2,
                        title: 'Иней',
                        description: 'В нашем интернет-магазине Вы сможете купить любые фотообои на стену из более чем 7 000 подобранных изображений и из 40 млн. фото из фотобанков. Все фотообои производятся на заказ по Вашим размерам и именно под Вашу стену. Заполните размеры, оформите заявку и уже через 3 дня заказ будет у Вас.',
                        width: 104,
                        cost: 1560,
                        textureSrc: '/img/materials/texture-04.jpg',
                        exampleSrc: '/img/materials/bg/example-03.jpg'
                    },
                    {
                        id: 3,
                        title: 'Скорлупа',
                        description: 'В нашем интернет-магазине Вы сможете купить любые фотообои на стену из более чем 7 000 подобранных изображений и из 40 млн. фото из фотобанков. Все фотообои производятся на заказ по Вашим размерам и именно под Вашу стену. Заполните размеры, оформите заявку и уже через 3 дня заказ будет у Вас.',
                        width: 105,
                        cost: 770,
                        textureSrc: '/img/materials/texture-06.jpg',
                        exampleSrc: '/img/materials/bg/example-04.jpg'
                    }
                ]
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import '../../../sass/uikit/variables-theme';
    @import '../../../sass/variables';
    @import '../../../sass/mixins';

    .tm-materials {
        &__hero {
            background-image: url('~/img/bg/bg-polygons.webp');
            @include media-portrait() {
                background-image: url('~/img/bg/bg-polygons-m.webp');
            }
        }
    }
</style>
