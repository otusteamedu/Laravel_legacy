<template>
    <div v-if="item" class="table-actions">

        <control-button v-if="remove"
                        title="Отвязать"
                        icon="remove"
                        color="md-info"
                        @click="onRemove" />

        <router-button-link title="Редактировать"
                            icon="edit"
                            color="md-success"
                            route="manager.images.edit"
                            :params="{ id: item.id, page }" />

        <control-button title="Удалить"
                        icon="delete"
                        color="md-danger"
                        @click="onDelete" />
    </div>
</template>

<script>
    export default {
        name: "ImageTableActions",
        props: {
            item: {
                type: Object,
                default: null
            },
            remove: {
                type: Boolean,
                default: false
            },
            page: {
                type: Number,
                default: null
            }
        },
        methods: {
            onDelete() {
                this.$emit('delete', this.item);
            },
            onRemove() {
                this.$emit('remove', this.item.id);
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
