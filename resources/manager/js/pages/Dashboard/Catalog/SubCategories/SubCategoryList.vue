<template>
    <div class="md-layout" v-if="responseData">
        <div class="md-layout-item">
            <md-card class="mt-0">
                <md-card-content class="md-between">
                    <router-button-link route="manager.catalog" title="В каталог" />
                    <router-button-link
                        route="manager.catalog.subcategories.create"
                        :params="{ category_type }"
                        icon="add"
                        color="md-success"
                        title="Создать тэг" />
                </md-card-content>
            </md-card>
            <div class="space-1"></div>
            <md-card>
                <card-icon-header :title="tableTitle" icon="assignment" />
                <md-card-content>

                    <v-extended-table v-if="items.length"
                                      :items="items"
                                      :searchFields="[ 'title', 'alias' ]" >

                        <template slot-scope="{ item }">

                            <md-table-cell md-label="#" md-sort-by="id" style="width: 50px">{{ item.id }}</md-table-cell>

                            <md-table-cell md-label="Заголовок" md-sort-by="title">
                                <span class="md-subheading">{{ item.title }}</span>
                            </md-table-cell>

                            <md-table-cell md-label="Описание">
                                {{ item.description }}
                            </md-table-cell>

                            <md-table-cell md-label="Изображения" md-sort-by="images_count">
                                {{ item.images_count }}
                            </md-table-cell>

                            <md-table-cell md-label="Опубликован">
                                <md-switch :value="!item.publish" @change="onPublishChange(item)" />
                            </md-table-cell>

                            <md-table-cell md-label="Действия">
                                <category-table-actions :item="item"
                                                        @delete="onDelete"
                                                        subPath="subcategories" />
                            </md-table-cell>

                        </template>
                    </v-extended-table>

                    <template v-else>
                        <div class="alert alert-info">
                            <span><h3>{{ pageTitle }} не созданы!</h3></span>
                        </div>
                    </template>

                </md-card-content>
            </md-card>
        </div>
    </div>
</template>
<script>
    import { mapActions, mapState } from 'vuex'

    import CategoryTableActions from "@/custom_components/Tables/CategoryTableActions";

    import categoryTableMixin from "@/mixins/categoryTableMixin";
    import { subCategoryPage, tableTitle } from '@/mixins/categories'
    import { pageTitle } from '@/mixins/base'
    import { deleteMethod } from '@/mixins/crudMethods'

    export default {
        name: 'SubCategoryList',
        mixins: [
            categoryTableMixin,
            subCategoryPage,
            tableTitle,
            pageTitle,
            deleteMethod
        ],
        components: {
            CategoryTableActions
        },
        data () {
            return {
                storeModule: 'subCategories',
                responseData: false
            }
        },
        computed: {
            ...mapState('subCategories', {
                items: state => state.items,
            })
        },
        methods: {
            ...mapActions('subCategories', {
                indexAction: 'index',
                publishAction: 'publish',
                clearFieldsAction: 'clearFields'
            }),
            async init (category_type) {
                this.responseData = false;
                await this.setPageTitle('');
                await this.clearFieldsAction();
                await this.indexAction(category_type)
                    .then(() => {
                        this.setPageTitle(this.pageProps[category_type].PAGE_TITLE);
                        this.responseData = true;
                    })
                    .catch(() => this.$router.push({ name: 'manager.catalog' }));
            },
            onDelete (item) {
                this.delete({
                    storeModule: this.storeModule,
                    payload: {
                        type: this.category_type,
                        id: item.id
                    },
                    title: item.title,
                    alertText: this.pageProps[this.category_type].DELETE_CONFIRM_TEXT(item.title),
                    successText: this.pageProps[this.category_type].DELETE_SUCCESS_TEXT
                })
            },
            onPublishChange (item) {
                this.publishAction({
                    type: this.category_type,
                    id: item.id
                });
            }
        },
        created () {
            this.init(this.category_type);
        }
    }
</script>
