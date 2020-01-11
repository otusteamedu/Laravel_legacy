<template>
    <div class="md-layout" v-if="responseData">
        <div class="md-layout-item">
            <md-card class="mt-0">
                <md-card-content class="md-between">
                    <router-button-link title="В панель управления" />
                    <router-button-link title="Создать роль" icon="add" color="md-success"
                                        route="manager.roles.create" />
                </md-card-content>
            </md-card>

            <div class="space-1"></div>
            <md-card>
                <card-icon-header title="Список Ролей" icon="assignment" />
                <md-card-content>
                    <template v-if="items.length">
                        <md-table v-model="items" class="paginated-table table-striped table-hover">
                            <md-table-row slot="md-table-row" slot-scope="{ item }">
                                <md-table-cell md-label="#" style="width: 50px">{{ item.id }}</md-table-cell>
                                <md-table-cell md-label="Имя">{{ item.display_name }}</md-table-cell>
                                <md-table-cell md-label="Алиас">{{ item.name }}</md-table-cell>
                                <md-table-cell md-label="Пользователи">{{ item.users_count }}</md-table-cell>
                                <md-table-cell md-label="Описание">{{ item.description }}</md-table-cell>
                                <md-table-cell md-label="Действия">
                                    <router-button-link title="Редактировать" icon="edit" color="md-success"
                                                        :route="'manager.roles.edit'"
                                                        :params="{ id: +item.id }" />
                                    <control-button title="Удалить" icon="delete" color="md-danger"
                                                    @click="onDelete(item)" />
                                </md-table-cell>
                            </md-table-row>
                        </md-table>
                    </template>
                    <template v-else>
                        <div class="alert alert-info">
                            <span><h3>У Вас еще нет ролей!</h3></span>
                        </div>
                    </template>
                </md-card-content>
            </md-card>
        </div>
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex'

    import { pageTitle } from '@/mixins/base'
    import { deleteMethod } from '@/mixins/crudMethods'
    import { tableExtension } from '@/mixins/tableExtension'

    export default {
        name: 'RoleList',
        mixins: [ pageTitle, deleteMethod, tableExtension ],
        data() {
            return {
                responseData: false,
                storeModule: 'roles'
            }
        },
        computed: {
            ...mapState('roles', [
                'items'
            ]),
        },
        methods: {
            ...mapActions('roles', {
                indexAction: 'index'
            }),
            onDelete(item) {
                return this.delete({
                    payload: item.id,
                    title: item.display_name,
                    alertText: `роль «${item.display_name}»`,
                    storeModule: this.storeModule,
                    successText: 'Роль удалена!'
                })
            }
        },
        created() {
            this.indexAction()
                .then(() => {
                    this.setPageTitle('Роли');
                    this.responseData = true;
                })
                .catch(() => this.$router.push({name: 'manager.dashboard'}));
        },
    }
</script>

<style lang="scss" scoped>
    .md-card .md-card-actions {
        border: 0;
        margin-left: 20px;
        margin-right: 20px;
    }

    .md-table-thumb {
        object-fit: cover;
        width: 200px;
        height: 100px;
    }

    .md-table-cell-container {
        .md-just-icon {
            margin-left: 5px;
            margin-right: 5px;
        }
    }
</style>
