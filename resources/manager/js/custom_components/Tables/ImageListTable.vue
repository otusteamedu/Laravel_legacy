<template>
    <v-extended-table v-if="items.length"
                      :items="items" >

        <template slot-scope="{ item }">

            <slot name="first-column" :item="item" >
                <md-table-cell md-label="#" md-sort-by="id" style="width: 50px">
                    {{ item.id }}
                </md-table-cell>
            </slot>

            <md-table-cell md-label="Превью">
                <thumb-table-cell :path="item.path" />
            </md-table-cell>

            <md-table-cell md-label="Темы">
                <tags-table-cell :items="item.topics" />
            </md-table-cell>

            <md-table-cell md-label="Цвета">
                <palette-table-cell :items="item.colors" />
            </md-table-cell>

            <md-table-cell md-label="Интерьеры">
                <tags-table-cell :items="item.interiors"/>
            </md-table-cell>

            <md-table-cell md-label="Владелец">
                <span v-if="item.owner" class="md-category-tag">
                    {{ item.owner.title }}
                </span>
            </md-table-cell>

            <md-table-cell md-label="Формат">
                <span v-if="item.format">
                    <md-icon>{{ item.format.icon }}</md-icon>
                    <md-tooltip md-direction="top">{{ item.format.title }}</md-tooltip>
                </span>
            </md-table-cell>

            <md-table-cell md-label="Просм."><md-icon>visibility</md-icon> {{ item.views }}</md-table-cell>
            <md-table-cell md-label="Лайки"><md-icon>favorite</md-icon> {{ item.likes }}</md-table-cell>
            <md-table-cell md-label="Заказы"><md-icon>shopping_cart</md-icon> {{ item.orders }}</md-table-cell>

            <md-table-cell md-label="Опубл.">
                <md-switch :value="!item.publish" @change="onPublish(item.id)" />
            </md-table-cell>

            <slot name="actions-column" :item="item"/>

        </template>

    </v-extended-table>
</template>

<script>
    import VExtendedTable from "@/custom_components/Tables/VExtendedTable";
    import TagsTableCell from "@/custom_components/Tables/TagsTableCell";
    import PaletteTableCell from "@/custom_components/Tables/PaletteTableCell";
    import ThumbTableCell from "@/custom_components/Tables/ThumbTableCell";

    export default {
        name: "ImageListTable",
        components: {
            VExtendedTable,
            TagsTableCell,
            PaletteTableCell,
            ThumbTableCell
        },
        props: {
            items: {
                type: [ Array, Object ],
                default: null
            }
        },
        computed: {

        },
        methods: {
            onPublish(id) {
                this.$emit('publish', id);
            }
        }
    }
</script>
