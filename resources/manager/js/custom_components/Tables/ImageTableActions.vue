<template>
    <div v-if="item" class="table-actions">

        <control-button v-if="remove"
                        icon="remove"
                        color="md-info"
                        @click="onRemove" />

        <router-button-link title="Редактировать"
                            icon="edit"
                            color="md-success"
                            route="manager.images.edit"
                            :params="{ id: item.id }" />

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
