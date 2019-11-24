<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card class="mt-0">
                    <md-card-content class="md-between">
                        <router-button-link :route="`admin.categories.${category_type}.images`" :params="{ id }" />
                        <div v-if="selectedImages.length">
                            <control-button title="Добавить изображения" icon="add" @click="onImagesAdd" />
                        </div>
                    </md-card-content>
                </md-card>
            </div>
        </div>
        <div class="md-layout">
            <div class="md-layout-item">
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
                                    <md-table-cell style="width: 50px">
                                        <md-checkbox v-model="selected" :value="item.id"></md-checkbox>
                                    </md-table-cell>
                                    <md-table-cell md-label="#" md-sort-by="id" style="width: 50px">{{ item.id }}</md-table-cell>
                                    <md-table-cell md-label="Превью">
                                        <img class="md-table-thumb img-raised rounded"
                                             :src="'/image/widen/150/' + item.path"
                                             :alt="item.id"
                                        >
                                    </md-table-cell>
                                    <md-table-cell md-label="Темы">
                                        <span class="md-category-tag" v-for="topic in item.topics">{{ topic.title }}</span>
                                    </md-table-cell>
                                    <md-table-cell md-label="Цвета">
                                        <md-icon class="md-color-icon"
                                                 v-for="(color, index) in item.colors"
                                                 :style="{ color: color.alias }"
                                                 :key="index"
                                        >
                                            lens
                                            <md-tooltip md-direction="top">{{ color.title }}</md-tooltip>
                                        </md-icon>
                                    </md-table-cell>
                                    <md-table-cell md-label="Помещения">
                                        <span class="md-category-tag"
                                              v-for="(placement, index) in item.placements"
                                              :key="index"
                                        >
                                            {{ placement.title }}
                                        </span>
                                    </md-table-cell>
                                    <md-table-cell md-label="Владелец">
                                        <span v-if="item.owner" class="md-category-tag">{{ item.owner.title }}</span>
                                    </md-table-cell>
                                    <md-table-cell md-label="Формат">
                                        <span>
                                            <md-icon>{{ item.proportion.icon }}</md-icon>
                                            <md-tooltip md-direction="top">{{ item.proportion.title }}</md-tooltip>
                                        </span>
                                    </md-table-cell>
                                    <md-table-cell md-label="Просм."><md-icon>visibility</md-icon> {{ item.views }}</md-table-cell>
                                    <md-table-cell md-label="Лайки"><md-icon>favorite</md-icon> {{ item.likes }}</md-table-cell>
                                    <md-table-cell md-label="Заказы"><md-icon>shopping_cart</md-icon> {{ item.orders }}</md-table-cell>
                                    <md-table-cell md-label="Опубл.">
                                        <md-switch :value="!item.publish" @change="onPublishChange(item)"></md-switch>
                                    </md-table-cell>
                                    <md-table-cell md-label="Действия">
                                        <router-button-link title="Редактировать" icon="edit" color="md-success"
                                                            route="admin.images.edit"
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
                                <span><h3>Пока нет других изображений!</h3></span>
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
    import { deleteMethod, imageAddMethod } from '@/mixins/crudMethods'
    import { tableExtension } from '@/mixins/tableExtension'

    export default {
        name: 'ExcludedImageList',
        mixins: [ pageTitle, deleteMethod, imageAddMethod, tableExtension ],
        props: {
            id: {
                type: [Number, String],
                required: true
            },
            category_type: {
                type: String,
                default: null
            },
        },
        data () {
            return {
                pagination: {
                    perPage: 50,
                    perPageOptions: [50, 200, 500, 1000]
                },
                responseData: false,
                selected: []
            }
        },
        computed: {
            ...mapState({
                items: state => state.images.items,
                title: state => state.categories.fields.title,
                selectedImages: state => state.categories.selectedImages
            }),
        },
        methods: {
            ...mapActions('images', [
                'getItems',
                'deleteItem',
                'changePublish'
            ]),
            ...mapActions({
                getCategory: 'categories/getItem',
                getExcludedImageList: 'categories/getExcludedImageList',
                addSelectedImages: 'categories/addSelectedImages',
                updateSelectedImages: 'categories/updateSelectedImages'
            }),
            onDelete (item) {
                this.delete({
                    module: 'images',
                    id: item.id,
                    title: item.id,
                    alertText: `изображение «${item.id}»`,
                    successText: 'Изображение удалено!'
                });
            },
            onPublishChange(item) {
                this.changePublish(item.id);
            },
            onImagesAdd() {
                this.addImages({
                    categoryType: this.category_type,
                    id: this.id,
                    selected: this.selectedImages
                })
            }
        },
        created() {
            this.getCategory({ category_id: this.id, category_type: this.category_type })
                .then(() => this.getExcludedImageList({ category_id: this.id, category_type: this.category_type }))
                .then(() => {
                    this.setPageTitle('Каталог изображений');
                    this.responseData = true;
                })
                .catch(() => this.$router.push({ name: `admin.categories.${this.category_type}` }));
        },
        mounted () {
            this.setSearch(['id']);
        },
        watch: {
            items() {
                this.setSearch(['id']);
            },
            selected() {
                this.updateSelectedImages(this.selected);
            }
        }
    }
</script>

<style lang="scss" scoped>
    .md-file-input {
        display: none;
    }

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
</style>
