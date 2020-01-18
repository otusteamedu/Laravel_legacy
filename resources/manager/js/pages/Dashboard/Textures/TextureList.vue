<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card>
                    <md-card-content class="md-between">
                        <router-button-link title="В панель управления" />
                        <router-button-link title="Создать фактуру" icon="add" color="md-success"
                                            route="manager.textures.create" />
                    </md-card-content>
                </md-card>
            </div>
        </div>
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card>
                    <card-icon-header title="Список фактур" icon="style" />
                    <md-card-content>
                        <template v-if="items.length">
                            <md-table v-model="items" class="paginated-table table-striped table-hover">
                                <md-table-row slot="md-table-row" slot-scope="{ item }">

                                    <md-table-cell md-label="#" class="width-small">
                                        {{ item.id }}
                                    </md-table-cell>

                                    <md-table-cell md-label="Превью">
                                        <img class="md-table-thumb img-raised rounded" :src="`/image/widen/300/${item.thumb_path}`" :alt="item.name">
                                    </md-table-cell>

                                    <md-table-cell md-label="Название">
                                        <span class="md-subheading">{{ item.name }}</span>
                                    </md-table-cell>

                                    <md-table-cell md-label="Опубликован">
                                        <md-switch :value="!item.publish" @change="onPublishChange(item.id)" />
                                    </md-table-cell>

                                    <md-table-cell md-label="Действия">

                                        <table-actions :item="item"
                                                       :subPath="storeModule"
                                                       @delete="onDelete"/>

                                    </md-table-cell>

                                </md-table-row>
                            </md-table>
                        </template>
                        <template v-else>
                            <div class="alert alert-info">
                                <span><h3>У Вас еще нет фактур!</h3></span>
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

    import TableActions from "@/custom_components/Tables/TableActions";

    import { pageTitle } from '@/mixins/base'
    import { deleteMethod } from '@/mixins/crudMethods'

    export default {
        name: 'TextureList',
        data () {
            return {
                storeModule: 'textures',
                responsive: false,
                responseData: false
            }
        },
        components: { TableActions },
        mixins: [ pageTitle, deleteMethod ],
        computed: {
            ...mapState('textures', {
                items: state => state.items
            })
        },
        methods: {
            ...mapActions('textures', {
                indexAction: 'index',
                publishAction: 'publish'
            }),
            onPublishChange(id) {
                this.publishAction(id);
            },
            onDelete(item) {
                return this.delete({
                    payload: item.id,
                    title: item.title,
                    alertText: `фактура «${item.name}»`,
                    storeModule: this.storeModule,
                    successText: 'Фактура удалена!'
                })
            }
        },
        created() {
            this.indexAction()
                .then(() => {
                    this.setPageTitle('Фактуры');
                    this.responseData = true;
                })
                .catch(() => this.$router.push({ name: 'manager.dashboard' }));
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
