<template>
    <div class="md-layout" v-if="responseData">
        <div class="md-layout-item">
            <md-card class="mt-0">
                <md-card-content class="md-between">
                    <router-button-link title="В панель управления" />
                    <router-button-link title="Создать пользователя" icon="add" color="md-success"
                                        route="manager.users.create" />
                </md-card-content>
            </md-card>

            <div class="space-1"></div>
            <md-card>
                <card-icon-header title="Список Пользователей" icon="assignment" />
                <md-card-content>
                    <template v-if="items.length">
                        <md-table :value="queriedData"
                                  :md-sort.sync="currentSort"
                                  :md-sort-order.sync="currentSortOrder"
                                  :md-sort-fn="customSort"
                                  class="paginated-table table-striped table-hover"
                        >
                            <md-table-toolbar class="mb-3">
                                <md-field>
                                    <label for="pages">На странице</label>
                                    <md-select v-model="pagination.perPage" name="pages">
                                        <md-option
                                            v-for="item in pagination.perPageOptions"
                                            :key="item"
                                            :label="item"
                                            :value="item">
                                            {{ item }}
                                        </md-option>
                                    </md-select>
                                </md-field>
                                <md-field>
                                    <md-input
                                        type="search"
                                        clearable
                                        style="width: 200px"
                                        placeholder="Поиск"
                                        v-model="searchQuery">
                                    </md-input>
                                </md-field>
                            </md-table-toolbar>
                            <md-table-row slot="md-table-row" slot-scope="{ item }">
                                <md-table-cell md-label="#" md-sort-by="id" style="width: 50px">{{ item.id }}</md-table-cell>
                                <md-table-cell md-label="Имя" md-sort-by="name">{{ item.name }}</md-table-cell>
                                <md-table-cell md-label="Email">{{ item.email }}</md-table-cell>
                                <md-table-cell md-label="Роли">
                                    <span class="md-category-tag" v-for="(role, index) in item.roles" :key="index">{{ role.display_name }}</span>
                                </md-table-cell>
                                <md-table-cell md-label="Заказы" md-sort-by="orders_count">{{ item.orders_count }}</md-table-cell>
                                <md-table-cell md-label="Активен">
                                    <md-switch :value="!item.publish" @change="onPublishChange(item.id)" />
                                </md-table-cell>
                                <md-table-cell md-label="Дата регистрации" md-sort-by="created_at">{{ item.created_at }}</md-table-cell>
                                <md-table-cell md-label="Действия">
                                    <router-button-link title="Редактировать" icon="edit" color="md-success"
                                                        :route="'manager.users.edit'"
                                                        :params="{ id: item.id }" />
                                    <control-button title="Удалить" icon="delete" color="md-danger"
                                                    @click="onDelete(item)" />
                                </md-table-cell>
                            </md-table-row>
                        </md-table>
                        <md-card-actions md-alignment="space-between">
                            <div class="">
                                <p class="card-category">{{ from + 1 }} - {{ to }} / {{ total }}</p>
                            </div>
                            <pagination class="pagination-no-border pagination-success"
                                        v-model="pagination.currentPage"
                                        :per-page="pagination.perPage"
                                        :total="total">
                            </pagination>
                        </md-card-actions>
                    </template>
                    <template v-else>
                        <div class="alert alert-info">
                            <span><h3>У Вас еще нет пользователей!</h3></span>
                        </div>
                    </template>
                </md-card-content>
            </md-card>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapState} from 'vuex'

    import { Pagination } from '@/components'

    import { pageTitle } from '@/mixins/base'
    import { deleteMethod } from '@/mixins/crudMethods'
    import { tableExtension } from '@/mixins/tableExtension'

    export default {
        name: 'UsersList',
        components: {
            Pagination
        },
        mixins: [ pageTitle, deleteMethod, tableExtension ],
        data () {
            return {
                propsToSearch: ['name', 'email'],
                responseData: false,
                storeModule: 'users'
            }
        },
        computed: {
            ...mapState('users', [
                'items'
            ])
        },
        methods: {
            ...mapActions('users', {
                indexAction: 'index',
                publishAction: 'publish'
            }),
            onDelete(item) {
                return this.delete({
                    payload: item.id,
                    title: item.name,
                    alertText: `пользователя «${item.name}»`,
                    storeModule: this.storeModule,
                    successText: 'Пользователь удален!'
                })
            },
            onPublishChange(id) {
                this.publishAction(id);
            },
        },
        created() {
            this.indexAction()
                .then(() => {
                    this.setPageTitle('Пользователи');
                    this.responseData = true;
                })
                .catch(() => this.$router.push({ name: 'manager.dashboard' }));
        },
        mounted () {
            this.setSearch(this.propsToSearch);
        },
        watch: {
            items () {
                this.setSearch(this.propsToSearch);
            }
        }
    }
</script>

<style lang="scss" scoped>
    .md-card .md-card-actions{
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

    .md-category-tag {
        display: inline-block;
        padding: 3px 5px;
        background-color: #dddddd;
        border-radius: 3px;
        margin: 3px;
    }
</style>
