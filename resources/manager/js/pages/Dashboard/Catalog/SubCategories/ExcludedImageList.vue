<template>
    <div v-if="responseData">

        <div class="md-layout">
            <div class="md-layout-item">
                <md-card class="mt-0">
                    <md-card-content class="md-between">
                        <router-button-link
                            :route="redirectRoute.name"
                            :params="redirectRoute.params"
                        />
                        <div v-if="selected.length">
                            <control-button title="Добавить изображения"
                                            icon="add"
                                            @click="onImagesAdd" />
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
                        <image-list-table v-if="items.length"
                                          :items="items"
                                          @publish="onPublishChange">

                            <template #first-column="{ item }">
                                <md-table-cell style="width: 50px">
                                    <md-checkbox v-model="selected" :value="item.id" />
                                </md-table-cell>
                            </template>

                            <template #actions-column="{ item }">
                                <md-table-cell v-if="item" md-label="Действия">
                                    <image-table-actions :item="item"
                                                         @delete="onDelete"/>
                                </md-table-cell>
                            </template>

                        </image-list-table>

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

    import { pageTitle } from '@/mixins/base'
    import { deleteMethod, subCategoryImageAddMethod } from '@/mixins/crudMethods'

    import ImageListTable from "@/custom_components/Tables/ImageListTable";
    import ImageTableActions from "@/custom_components/Tables/ImageTableActions";


    export default {
        name: 'ExcludedImageList',
        mixins: [
            pageTitle,
            deleteMethod,
            subCategoryImageAddMethod
        ],
        components: {
            ImageListTable,
            ImageTableActions
        },
        props: {
            id: {
                type: [ Number, String ],
                required: true
            },
            category_type: {
                type: String,
                default: null
            },
        },
        data () {
            return {
                storeModule: 'images',
                redirectRoute: {
                    name: 'manager.catalog.subcategories.images',
                    params: { category_type: this.category_type, id: this.id }
                },
                responseData: false,
                selected: []
            }
        },
        computed: {
            ...mapState({
                category: state => state.subCategories.item,
                items: state => state.images.items
            }),
        },
        methods: {
            ...mapActions('images', {
                indexAction: 'index',
                publishAction: 'publish'
            }),
            ...mapActions('subCategories', {
                getCategoryWithExcludedImages: 'showWithExcludedImages'
            }),
            onDelete (item) {
                return this.delete({
                    storeModule: this.storeModule,
                    payload: item.id,
                    title: item.id,
                    alertText: `изображение «${item.id}»`,
                    successText: 'Изображение удалено!'
                });
            },
            onPublishChange(id) {
                this.publishAction(id);
            },
            onImagesAdd() {
                return this.addImages({
                    type: this.category_type,
                    id: this.id,
                    selected: this.selected,
                    redirectRoute: this.redirectRoute
                })
            }
        },
        created() {
            this.getCategoryWithExcludedImages({ type: this.category_type, id: this.id })
                .then(() => {
                    this.setPageTitle(`Для категории «${this.category.title}»`);
                    this.responseData = true;
                })
                .catch(() => this.$router.push(this.redirectRoute));
        }
    }
</script>

<style lang="scss" scoped>
    .md-file-input {
        display: none;
    }
    .md-between {
        display: flex;
        justify-content: space-between;
    }
</style>
