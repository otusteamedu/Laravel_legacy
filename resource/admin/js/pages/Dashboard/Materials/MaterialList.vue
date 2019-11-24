<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card>
                    <md-card-content class="md-between">
                        <router-button-link title="В панель управления" />
                        <router-button-link title="Создать материал" icon="add" color="md-success"
                                            route="admin.materials.create" />
                    </md-card-content>
                </md-card>
            </div>
        </div>
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card>
                    <card-icon-header title="Список материалов" icon="style" />
                    <md-card-content>
                        <template v-if="items.length">
                            <md-table v-model="items" class="paginated-table table-striped table-hover">
                                <md-table-row slot="md-table-row" slot-scope="{ item }">
                                    <md-table-cell md-label="#" class="width-small">{{ item.id }}</md-table-cell>
                                    <md-table-cell md-label="Превью">
                                        <img class="md-table-thumb img-raised rounded" :src="item.thumb_path" :alt="item.name">
                                    </md-table-cell>
                                    <md-table-cell md-label="Название"><h4>{{ item.name }}</h4></md-table-cell>
                                    <md-table-cell md-label="Опубликован">
                                        <md-switch :value="!item.publish" @change="onPublishChange(item.id)"></md-switch>
                                    </md-table-cell>
                                    <md-table-cell md-label="Действия">
                                        <router-button-link title="Редактировать" icon="edit" color="md-success"
                                                            route="admin.materials.edit"
                                                            :params="{ id: item.id }" />
                                        <control-button title="Удалить" icon="delete" color="md-danger" @click="onDelete(item)" />
                                    </md-table-cell>
                                </md-table-row>
                            </md-table>
                        </template>
                        <template v-else>
                            <div class="alert alert-info">
                                <span><h3>У Вас еще нет Материалов!</h3></span>
                            </div>
                        </template>
                    </md-card-content>
                </md-card>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'

    import { pageTitle } from '@/mixins/actions'
    import { deleteMethod } from '@/mixins/crudMethods'
    import { tableExtension } from '@/mixins/tableExtension'

    export default {
        name: 'MaterialList',
        data () {
            return {
                responsive: false,
                responseData: false
            }
        },
        mixins: [ pageTitle, deleteMethod, tableExtension ],
        computed: {
            ...mapState('materials', {
                items: state => state.items
            })
        },
        methods: {
            ...mapActions('materials', [
                'getItems',
                'deleteItem',
                'changePublish'
            ]),
            onPublishChange(id) {
                this.changePublish(id);
            },
            onDelete(item) {
                this.delete({
                    id: item.id,
                    title: item.title,
                    alertText: `материал «${item.name}»`,
                    successText: 'Материал удален!'
                })
            }
        },
        created() {
            this.getItems()
                .then(() => {
                    this.setPageTitle('Материалы');
                    this.responseData = true;
                })
                .catch(() => this.$router.push({ name: 'admin.dashboard' }));
        }
    }
</script>

<style lang="scss" scoped>
    .md-table-thumb {
        object-fit: cover;
        width: 200px;
        height: 100px;
    }
</style>
