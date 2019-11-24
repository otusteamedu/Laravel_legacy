<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card>
                    <md-card-content class="md-between">
                        <router-link :to="{ name: 'admin.dashboard' }">
                            <md-button class="md-info md-just-icon">
                                <md-icon>arrow_back</md-icon>
                                <md-tooltip md-direction="right">В панель управления</md-tooltip>
                            </md-button>
                        </router-link>
                        <router-link :to="{ name: 'admin.materials.create' }">
                            <md-button class="md-success md-just-icon">
                                <md-icon>add</md-icon>
                                <md-tooltip md-direction="right">Создать материал</md-tooltip>
                            </md-button>
                        </router-link>
                    </md-card-content>
                </md-card>
            </div>
        </div>
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card>
                    <md-card-header class="md-card-header-icon md-card-header-green">
                        <div class="card-icon">
                            <md-icon>style</md-icon>
                        </div>
                        <h3 class="title">Список материалов</h3>
                    </md-card-header>
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
                                        <router-link :to="{ name: 'admin.materials.edit', params: { id: item.id } }">
                                            <md-button
                                                class="md-success md-just-icon">
                                                <md-icon>edit</md-icon>
                                                <md-tooltip md-direction="top">Редактировать</md-tooltip>
                                            </md-button>
                                        </router-link>
                                        <md-button
                                            class="md-danger md-just-icon"
                                            @click.native="onDelete(item)">
                                            <md-icon>delete</md-icon>
                                            <md-tooltip md-direction="top">Удалить</md-tooltip>
                                        </md-button>
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
    import { mapState } from 'vuex'

    import swal from 'sweetalert2'
    import { SlideYDownTransition } from 'vue2-transitions'
    import {Modal} from '@/components'

    export default {
        name: 'MaterialList',
        components: {
            SlideYDownTransition,
            Modal
        },
        data () {
            return {
                responsive: false,
                responseData: false
            }
        },
        computed: {
            ...mapState('materials', {
                items: state => state.items
            })
        },
        methods: {
            onPublishChange(id) {
                this.$store.dispatch('materials/changePublish', id);
            },
            onDelete(item) {
                swal.fire({
                    title: 'Вы уверены?',
                    text: `Данное действие удалит Материал «${item.name}» безвозвратно!`,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'md-button md-success btn-fill',
                    cancelButtonClass: 'md-button md-danger btn-fill',
                    confirmButtonText: 'Удалить',
                    cancelButtonText: 'Отменить',
                    buttonsStyling: false
                })
                    .then((result) => {
                        if(result.value){
                            this.$store.dispatch('materials/deleteItem', item.id)
                                .then(() => {
                                    swal.fire({
                                        title: 'Материал удален!',
                                        text: item.title,
                                        timer: 2000,
                                        type: 'success',
                                        showConfirmButton: false
                                    });
                                });
                        }
                    });
            },
            notifyVue(message) {
                this.$notify(
                    {
                        message: message,
                        icon: 'add_alert',
                        horizontalAlign: 'center',
                        verticalAlign: 'top',
                        type: 'danger',
                        timeout: 5000
                    }
                )
            }
        },
        created() {
            this.$store.dispatch('materials/getItems')
                .then(() => {
                    this.$store.dispatch('setPageTitle', 'Материалы');
                    this.responseData = true;
                })
                .catch(() => this.$router.push({ name: 'admin.dashboard' }));

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
</style>
