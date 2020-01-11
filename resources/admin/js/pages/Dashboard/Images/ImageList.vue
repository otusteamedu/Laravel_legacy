<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card class="mt-0">
                    <md-card-content class="md-between">
                        <router-button-link v-if="category_type === 'images'"
                            route="manager.dashboard"
                        />
                        <router-button-link v-else
                            route="manager.catalog.categories.list"
                            :params="{ category_type }"
                        />
                        <div>
                            <router-button-link v-if="category_type !== 'images'"
                                icon="add"
                                color="md-success"
                                title="Добавить изображения"
                                route="manager.catalog.categories.images.excluded"
                                :params="{ id }" />
                            <upload-button @change="fileInputChange" />
                        </div>
                    </md-card-content>
                </md-card>
            </div>
        </div>
        <div class="md-layout">
            <div class="md-layout-item">
                <div class="md-layout-item md-progress-bar__container">
                    <md-progress-bar v-if="fileProgress" class="md-info" :md-value="fileProgress" />
                </div>
                <md-card>
                    <card-icon-header title="Каталог изображений" icon="image" />
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
                                    <md-table-cell md-label="Превью">
                                        <img class="md-table-thumb img-raised rounded"
                                             :src="`/image/widen/150/${item.path}`"
                                             :alt="item.id"
                                        >
                                    </md-table-cell>
                                    <md-table-cell md-label="Темы">
                                        <span class="md-category-tag"
                                              v-for="(topic, index) in item.topics"
                                              :key="index"
                                        >{{ topic.title }}</span>
                                    </md-table-cell>
                                    <md-table-cell md-label="Цвета">
                                        <md-icon class="md-color-icon"
                                                 v-for="(color, index) in item.colors"
                                                 :style="{ color: color.alias }"
                                                 :key="index">
                                            lens
                                            <md-tooltip md-direction="top">{{ color.title }}</md-tooltip>
                                        </md-icon>
                                    </md-table-cell>
                                    <md-table-cell md-label="Помещения">
                                        <span class="md-category-tag"
                                              v-for="(interiors, index) in item.interiorss"
                                              :key="index"
                                        >{{ interiors.title }}</span>
                                    </md-table-cell>
                                    <md-table-cell md-label="Владелец">
                                        <span v-if="item.owner" class="md-category-tag">{{ item.owner.title }}</span>
                                    </md-table-cell>
                                    <md-table-cell md-label="Формат">
                                        <span>
                                            <md-icon>{{ item.format.icon }}</md-icon>
                                            <md-tooltip md-direction="top">{{ item.format.title }}</md-tooltip>
                                        </span>
                                    </md-table-cell>
                                    <md-table-cell md-label="Просм."><md-icon>visibility</md-icon> {{ item.views }}</md-table-cell>
                                    <md-table-cell md-label="Лайки"><md-icon>favorite</md-icon> {{ item.likes }}</md-table-cell>
                                    <md-table-cell md-label="Заказы"><md-icon>shopping_cart</md-icon> {{ item.orders }}</md-table-cell>
                                    <md-table-cell md-label="Опубл.">
                                        <md-switch :value="!item.publish" @change="onPublishChange(item)" />
                                    </md-table-cell>
                                    <md-table-cell md-label="Действия">
                                        <control-button v-if="category_type !== 'images'" title="Отвязать" icon="remove"
                                            color="md-info"
                                            @click="onRemove(item)" />
                                        <router-button-link title="Редактировать" icon="edit" color="md-success"
                                            :route="'manager.images.edit'"
                                            :params="{ id: item.id }" />
                                        <control-button title="Удалить" icon="delete" color="md-danger"
                                            @click="onDelete(item)" />
                                    </md-table-cell>
                                </md-table-row>
                            </md-table>
                            <div class="md-space-between">
                                <p class="card-category">{{from + 1}} - {{to}} / {{total}}</p>
                                <pagination class="pagination-no-border pagination-success"
                                            v-model="pagination.currentPage"
                                            :per-page="pagination.perPage"
                                            :total="total">
                                </pagination>
                            </div>
                        </template>
                        <template v-else>
                            <div class="alert alert-info">
                                <span><h3>Пока нет изображений!</h3></span>
                            </div>
                        </template>
                    </md-card-content>
                </md-card>
            </div>
        </div>
    </div>
    <div class="spinner__container" v-else>
        <md-progress-spinner :md-diameter="100" :md-stroke="3" md-mode="indeterminate" />
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'

    import { pageTitle } from '@/mixins/base'
    import { deleteMethod, uploadMethod } from '@/mixins/crudMethods'
    import { tableExtension } from '@/mixins/tableExtension'

    export default {
        name: 'ImageList',
        mixins: [ pageTitle, deleteMethod, uploadMethod, tableExtension ],
        props: {
            category_type: {
                type: String,
                default: 'images'
            },
            id: {
                type: [ Number, String ],
                default: null
            }
        },
        data () {
            return {
                pagination: {
                    perPage: 50,
                    perPageOptions: [ 50, 200, 500, 1000 ],
                },
                responseData: false,
                storeModule: 'images'
            }
        },
        computed: {
            ...mapState({
                category: state => state.categories.item,
                items: state => state.images.items,
                fileProgress: state => state.images.fileProgress
            })
        },
        methods: {
            ...mapActions('images', {
                indexAction: 'index',
                publishAction: 'publish'
            }),
            ...mapActions({
                removeImage: 'categories/removeImage',
                getCategoryWithImages: 'categories/showWithImages'
            }),
            init (category_type) {
                if (category_type !== 'images') {
                    this.getCategoryWithImages(this.id)
                        .then(() => {
                            this.setPageTitle(`Изображения категории «${this.category.title}»`);
                            this.responseData = true;
                        })
                        .catch(() => this.$router.push({
                            name: 'manager.catalog.categories.list',
                            params: { category_type: this.category_type }
                        }));
                } else {
                    this.indexAction()
                        .then(() => {
                            this.setPageTitle('Изображения');
                            this.responseData = true;
                        })
                        .catch(() => this.$router.push({ name: 'manager.dashboard' }));
                }
            },
            fileInputChange (event) {
                this.upload(event.target.files, this.category_type, this.id);
            },
            onRemove (item) {
                this.removeImage({
                    category_id: this.id,
                    image_id: item.id
                })
            },
            onDelete (item) {
                this.delete({
                    payload: item.id,
                    title: item.id,
                    alertText: `изображение «${item.id}»`,
                    successText: 'Изображение удалено!',
                    storeModule: this.storeModule
                });
            },
            onPublishChange (item) {
                this.publishAction(item.id);
            }
        },
        created () {
            this.init(this.category_type);
        },
        mounted () {
            this.setSearch(['id']);
        },
        watch: {
            '$route' (to, from) {
                this.init(to.params.category_type);
            },
            items () {
                this.setSearch(['id']);
            }
        }
    }
</script>

<style lang="scss" scoped>
    .md-table-thumb {
        object-fit: cover;
        width: 100px;
        height: 70px;
    }
    .md-table-cell-container {
        .md-just-icon {
            margin-left: 5px;
            margin-right: 5px;
        }
    }
    .md-between {
        display: flex;
        justify-content: space-between;
    }
    .md-category-tag {
        display: inline-block;
        padding: 3px 5px;
        background-color: #dddddd;
        border-radius: 3px;
        margin: 3px;
    }
    .md-progress-bar__container {
        height: 4px;
    }
</style>
