<template>
    <div class="md-layout" v-if="responseData">
        <div class="md-layout-item">
            <md-card class="mt-0">
                <md-card-content class="md-between">
                    <router-button-link title="В панель магазина" :route="redirectRoute.name"/>
                    <router-button-link title="Создать доставку" icon="add" color="md-success"
                                        route="manager.store.delivery.create" />
                </md-card-content>
            </md-card>

            <div class="space-1"></div>
            <md-card>
                <card-icon-header title="Способы Доставки" icon="assignment" />
                <md-card-content>
                    <template v-if="items.length">
                        <md-table v-model="items" class="paginated-table table-striped table-hover">
                            <md-table-row slot="md-table-row" slot-scope="{ item }">
                                <md-table-cell md-label="#" style="width: 50px">{{ item.id }}</md-table-cell>
                                <md-table-cell md-label="Заголовок">{{ item.title }}</md-table-cell>
                                <md-table-cell md-label="Стоимость">{{ item.cost || 'Бесплатно' }}</md-table-cell>
                                <md-table-cell md-label="Описание">{{ item.description }}</md-table-cell>
                                <md-table-cell md-label="Опубликован">
                                    <md-switch :value="!item.publish" @change="onPublishChange(item)" />
                                </md-table-cell>
                                <md-table-cell md-label="Действия">
                                    <router-button-link route="manager.store.delivery.edit" :params="{ id: item.id }" icon="edit" color="md-success" title="Редактировать" />
                                    <control-button class="md-danger" @click="onDelete(item)" icon="delete" title="Удалить" />
                                </md-table-cell>
                            </md-table-row>
                        </md-table>
                    </template>
                    <template v-else>
                        <div class="alert alert-info">
                            <span><h3>У Вас еще нет способов доставки!</h3></span>
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

    export default {
        name: 'DeliveryList',
        mixins: [ pageTitle, deleteMethod ],
        data() {
            return {
                responseData: false,
                redirectRoute: { name: 'manager.store' },
                storeModule: 'deliveries'
            }
        },
        computed: {
            ...mapState('deliveries', [
                'items'
            ]),
        },
        methods: {
            ...mapActions('deliveries', {
                indexAction: 'index',
                publishAction: 'publish'
            }),
            onDelete(item) {
                return this.delete({
                    payload: item.id,
                    title: item.title,
                    alertText: `способ доставки «${item.title}»`,
                    storeModule: this.storeModule,
                    successText: 'Способ доставки удален!'
                })
            },
            onPublishChange (item) {
                this.publishAction(item.id);
            }
        },
        created() {
            this.indexAction()
                .then(() => {
                    this.setPageTitle('Способы доставки');
                    this.responseData = true;
                })
                .catch(() => this.$router.push(this.redirectRoute));
        }
    }
</script>
