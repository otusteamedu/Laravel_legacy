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
                    <v-extended-table v-if="items.length"
                                      :items="items"
                                      :searchFields="[ 'title', 'alias' ]" >

                        <template slot-scope="{ item }">

                            <md-table-cell md-label="#" style="width: 50px">{{ item.id }}</md-table-cell>

                            <md-table-cell md-label="Имя">
                                <span class="md-subheading">{{ item.display_name }}</span>
                            </md-table-cell>

                            <md-table-cell md-label="Алиас">
                                {{ item.name }}
                            </md-table-cell>

                            <md-table-cell md-label="Пользователи">
                                {{ item.users_count }}
                            </md-table-cell>

                            <md-table-cell md-label="Описание">
                                {{ item.description }}
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

    import VExtendedTable from "@/custom_components/Tables/VExtendedTable";
    import TableActions from "@/custom_components/Tables/TableActions";

    import { pageTitle } from '@/mixins/base'
    import { deleteMethod } from '@/mixins/crudMethods'

    export default {
        name: 'RoleList',
        components: { VExtendedTable, TableActions },
        mixins: [ pageTitle, deleteMethod ],
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
                getItemsAction: 'getItems'
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
            this.getItemsAction()
                .then(() => {
                    this.setPageTitle('Роли');
                    this.responseData = true;
                })
                .catch(() => this.$router.push({name: 'manager.dashboard'}));
        },
    }
</script>
