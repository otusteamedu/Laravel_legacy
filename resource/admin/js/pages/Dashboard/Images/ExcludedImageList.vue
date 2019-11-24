<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card class="mt-0">
                    <md-card-content class="md-between">
                        <router-link :to="{ name: `admin.categories.${category_type}.images`, params: { id } }">
                            <md-button class="md-info md-just-icon">
                                <md-icon>arrow_back</md-icon><md-tooltip md-direction="right">Назад</md-tooltip>
                            </md-button>
                        </router-link>
                        <div v-if="selectedImages.length">
                            <md-button class="md-success md-just-icon" @click.native="onImagesAdd">
                                <md-icon >add</md-icon>
                                <md-tooltip md-direction="right">Добавить изображения</md-tooltip>
                            </md-button>
                        </div>
                    </md-card-content>
                </md-card>
            </div>
        </div>
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card>
                    <md-card-header class="md-card-header-icon md-card-header-green">
                        <div class="card-icon">
                            <md-icon>image</md-icon>
                        </div>
                        <h3 class="title">Каталог изображений</h3>
                    </md-card-header>
                    <md-card-content>
                        <template v-if="imageList.length">
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
                                        <router-link :to="{ name: 'admin.images.edit', params: { id: item.id } }">
                                            <md-button
                                                class="md-success md-just-icon">
                                                <md-icon>edit</md-icon>
                                                <md-tooltip md-direction="top">Редактировать</md-tooltip>
                                            </md-button>
                                        </router-link>
                                        <md-button
                                            class="md-danger md-just-icon"
                                            @click.native="handleDelete(item)">
                                            <md-icon>delete</md-icon>
                                            <md-tooltip md-direction="top">Удалить</md-tooltip>
                                        </md-button>
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
    import { mapState } from 'vuex'

    import {Pagination} from '@/components'
    import Fuse from 'fuse.js'
    import swal from 'sweetalert2'

    export default {
        name: 'ExcludedImageList',
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
        components: {
            Pagination
        },
        data () {
            return {
                currentSort: 'id',
                currentSortOrder: 'asc',
                pagination: {
                    perPage: 50,
                    currentPage: 1,
                    perPageOptions: [50, 200, 500, 1000],
                    total: 0
                },
                searchQuery: '',
                propsToSearch: ['id'],
                searchedData: [],
                fuseSearch: [],
                responseData: false,
                selected: []
            }
        },
        computed: {
            ...mapState({
                imageList: state => state.images.items,
                title: state => state.categories.fields.title,
                selectedImages: state => state.categories.selectedImages
            }),
            queriedData () {
                let result = this.imageList;
                if(this.searchedData.length > 0){
                    result = this.searchedData;
                }
                return result.slice(this.from, this.to)
            },
            to () {
                let highBound = this.from + this.pagination.perPage;
                if (this.total < highBound) {
                    highBound = this.total
                }
                return highBound
            },
            from () {
                return this.pagination.perPage * (this.pagination.currentPage - 1)
            },
            total () {
                return this.searchedData.length > 0 ? this.searchedData.length : this.imageList.length;
            }
        },
        methods: {
            customSort (value) {
                return value.sort((a, b) => {
                    const sortBy = this.currentSort;
                    if (this.currentSortOrder === 'desc') {
                        if (typeof a[sortBy] === 'number' && typeof b[sortBy] === 'number') {
                            return a[sortBy] < b[sortBy] ? -1 : 1;
                        }
                        return a[sortBy].localeCompare(b[sortBy])
                    }
                    if (typeof a[sortBy] === 'number' && typeof b[sortBy] === 'number') {
                        return a[sortBy] > b[sortBy] ? -1 : 1;
                    }
                    return b[sortBy].localeCompare(a[sortBy])
                })
            },
            handleDelete (item) {
                swal.fire({
                    title: 'Вы уверены?',
                    text: `Данное действие удалит изображение «${item.id}» безвозвратно!`,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'md-button md-success btn-fill',
                    cancelButtonClass: 'md-button md-danger btn-fill',
                    confirmButtonText: 'Удалить',
                    cancelButtonText: 'Отменить',
                    buttonsStyling: false
                }).then((result) => {
                    if(result.value){
                        this.$store.dispatch('images/deleteItem', item.id)
                            .then(() => {
                                swal.fire({
                                    title: 'Изображение удалено!',
                                    text: `«${item.id}»`,
                                    timer: 2000,
                                    type: 'success',
                                    showConfirmButton: false
                                })
                            });
                    }
                });
            },
            onPublishChange(item) {
                this.$store.dispatch('images/changePublish', item.id);
            },
            onImagesAdd() {
                this.$store.dispatch('categories/addSelectedImages', { category_id: this.id, category_type: this.category_type })
                    .then(() => {
                        swal.fire({
                            title: 'Изображения добавлены!',
                            text: '',
                            timer: 2000,
                            showConfirmButton: false,
                            type: 'success'
                        });
                        this.$router.push({ name: `admin.categories.${this.category_type}.images`, params: { id: this.id } });
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
            this.$store.dispatch('categories/getItem', { category_id: this.id, category_type: this.category_type })
                .then(() => this.$store.dispatch('categories/getExcludedImageList', { category_id: this.id, category_type: this.category_type }))
                .then(() => {
                    this.$store.dispatch('setPageTitle', 'Каталог изображений');
                    this.responseData = true;
                })
                .catch(() => this.$router.push({ name: `admin.categories.${this.category_type}` }));
        },
        mounted () {
            this.fuseSearch = new Fuse(this.imageList, {keys: ['id'], threshold: 0.3});
        },

        watch: {
            searchQuery(value){
                let result = this.imageList;
                if (value !== '') {
                    result = this.fuseSearch.search(this.searchQuery)
                }
                this.searchedData = result;
            },
            imageList() {
                this.fuseSearch = new Fuse(this.imageList, {keys: ['id'], threshold: 0.3});
            },
            selected() {
                this.$store.dispatch('categories/updateSelectedImages', this.selected);
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
