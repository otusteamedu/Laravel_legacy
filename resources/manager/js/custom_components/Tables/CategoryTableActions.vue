<template>
    <div class="table-actions" v-if="item">

        <router-button-link title="Изображения"
                            icon="collections"
                            :route="`manager.catalog.${subPath}.images`"
                            :params="{ id: item.id }" />

        <router-button-link title="Редактировать"
                            icon="edit"
                            color="md-success"
                            :route="`manager.catalog.${subPath}.edit`"
                            :params="{ id: item.id }" />

        <control-button title="Удалить"
                        icon="delete"
                        color="md-danger"
                        @click="onDelete(item)" />
    </div>
</template>

<script>
    export default {
        name: "CategoryTableActions",
        props: {
            item: {
                type: Object,
                default: null
            },
            subPath: {
                type: String,
                default: 'categories'
            }
        },
        methods: {
            onDelete(item) {
                this.$emit('delete', item);
            }
        }
    }
</script>

<style scoped>
    .table-actions {
        display: flex;
        justify-content: flex-end;
    }
</style>
