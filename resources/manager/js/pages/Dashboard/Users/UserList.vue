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
                    <v-extended-table v-if="items.length"
                                      :items="items"
                                      :searchFields="propsToSearch" >

                        <template slot-scope="{ item }">

                            <md-table-cell md-label="#" md-sort-by="id" style="width: 50px">
                                {{ item.id }}
                            </md-table-cell>

                            <md-table-cell md-label="Имя" md-sort-by="name">
                                <span class="md-subheading">{{ item.name }}</span>
                            </md-table-cell>

                            <md-table-cell md-label="Email">{{ item.email }}</md-table-cell>

                            <md-table-cell md-label="Роль">
                                <span class="md-category-tag"
                                      v-for="(role, index) in item.roles"
                                      :key="index">{{ role.display_name }}</span>
                            </md-table-cell>

                            <md-table-cell md-label="Заказы" md-sort-by="orders_count">
                                {{ item.orders_count }}
                            </md-table-cell>

                            <md-table-cell md-label="Активен">
                                <md-switch :value="!item.publish" @change="onPublishChange(item.id)" />
                            </md-table-cell>

                            <md-table-cell md-label="Дата регистрации" md-sort-by="created_at">
                                {{ item.created_at }}
                            </md-table-cell>

                            <md-table-cell md-label="Действия">

                                <table-actions :item="item"
                                               :subPath="storeModule"
                                               @delete="onDelete"/>

                            </md-table-cell>

                        </template>

                    </v-extended-table>
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
    import { mapActions, mapState } from 'vuex'

    import VExtendedTable from "@/custom_components/Tables/VExtendedTable";
    import TableActions from "@/custom_components/Tables/TableActions";

    import { pageTitle } from '@/mixins/base'
    import { deleteMethod } from '@/mixins/crudMethods'

    export default {
        name: 'UsersList',
        components: { VExtendedTable, TableActions },
        mixins: [ pageTitle, deleteMethod ],
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
                getItemsAction: 'getItems',
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
            this.getItemsAction()
                .then(() => {
                    this.setPageTitle('Пользователи');
                    this.responseData = true;
                })
                .catch(() => this.$router.push({ name: 'manager.dashboard' }));
        }
    }
</script>
