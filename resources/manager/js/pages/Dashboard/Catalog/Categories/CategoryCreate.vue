<template>
    <div v-if="responseData">

        <div class="md-layout">
            <div class="md-layout-item">
                <md-card class="mt-0">
                    <md-card-content class="md-between">
                        <router-button-link
                            route="manager.catalog.categories.list"
                            :params="{ category_type }" />
                        <slide-y-down-transition v-show="!$v.$invalid">
                            <control-button @click="onCreate" />
                        </slide-y-down-transition>
                    </md-card-content>
                </md-card>
            </div>
        </div>

        <div class="md-layout">
            <div class="md-layout-item md-medium-size-50 md-small-size-100">
                <md-card>
                    <card-icon-header />
                    <md-card-content>

                        <v-input title="Заголовок"
                                 icon="title"
                                 name="title"
                                 :vField="$v.title"
                                 :module="storeModule"
                                 :vRules="{ required: true, unique: true, minLength: true }" />

                        <v-input title="Алиас"
                                 icon="code"
                                 name="alias"
                                 :vDelay="true"
                                 :vField="$v.alias"
                                 :module="storeModule"
                                 :vRules="{ required: true, unique: true, minLength: true, alias: true }" />

                        <div v-if="category_type === 'colors'">
                            <h4 class="card-title">Цвет</h4>
                            <div class="md-color-sample mt-2" :style="`background-color: ${alias}`"></div>
                        </div>

                        <v-image name="image"
                                 :vField="$v.image"
                                 :vRules="{ required: true }"
                                 :module="storeModule" />

                        <v-switch :vField="$v.publish"
                                  :value="publish"
                                  :module="storeModule" />

                    </md-card-content>
                </md-card>
            </div>
            <div class="md-layout-item md-medium-size-50 md-small-size-100">
                <md-card>
                    <card-icon-header icon="timeline" title="SEO" />
                    <md-card-content>

                        <v-textarea name="description"
                                    :vField="$v.description"
                                    :module="storeModule" />

                        <v-textarea title="Ключевые слова"
                                    name="keywords"
                                    :vField="$v.keywords"
                                    :module="storeModule" />

                        <div class="space-30"></div>
                    </md-card-content>
                </md-card>
            </div>
        </div>

    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'

    import { required, minLength } from 'vuelidate/lib/validators'

    import { categoryPage } from '@/mixins/categories'
    import { createMethod } from '@/mixins/crudMethods'

    export default {
        name: 'CategoryCreate',
        props: {
            category_type: {
                type: String,
                required: true
            },
            result: []
        },
        mixins: [
            categoryPage,
            createMethod
        ],
        data () {
            return {
                responseData: false
            }
        },
        validations: {
            title: {
                required,
                touch: false,
                minLength: minLength(2),
                isUnique (value) {
                    return ((value.trim() === '') && !this.$v.title.$dirty) || !this.isUniqueTitle
                }
            },
            alias: {
                required,
                touch: false,
                testAlias (value) {
                    return value.trim() === '' || (/^([a-z0-9]+[-]?)+[a-z0-9]$/).test(value);
                },
                minLength: minLength(2),
                isUnique (value) {
                    return ((value.trim() === '') && !this.$v.alias.$dirty) || !this.isUniqueAlias
                },
            },
            image: {
                required,
                touch: false
            },
            description: {
                touch: false
            },
            keywords: {
                touch: false
            }
        },
        computed: {
            ...mapState('categories', {
                title: state => state.fields.title,
                alias: state => state.fields.alias,
                image: state => state.fields.image,
                publish: state => state.fields.publish,
                description: state => state.fields.description,
                keywords: state => state.fields.keywords
            }),
            isUniqueTitle () {
                return !!this.$store.getters['categories/isUniqueTitle'](this.title);
            },
            isUniqueAlias () {
                return !!this.$store.getters['categories/isUniqueAlias'](this.alias);
            }
        },
        methods: {
            ...mapActions('categories', {
                getItemsAction: 'getItems',
                clearFieldsAction: 'clearFields'
            }),
            onCreate () {
                return this.create({
                    sendData: {
                        type: this.category_type,
                        title: this.title,
                        alias: this.alias,
                        image: this.image,
                        publish: +this.publish,
                        description: this.description,
                        keywords: this.keywords
                    },
                    title: this.title,
                    successText: 'Категория создана!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                })
            }
        },
        created () {
            this.getItemsAction()
                .then(() => {
                    this.setPageTitle(this.pageProps[this.category_type].CREATE_PAGE_TITLE);
                    this.clearFieldsAction();
                    this.responseData = true;
                })
                .catch(() => this.$router.push(this.redirectRoute));
        }
    }
</script>

<style lang="scss">
    .md-color-sample {
        flex: none;
        width: 100%;
        height: 120px;
        border-radius: 3px;
        will-change: background-color;
        background-color: gray;
        box-shadow: 0 12px 20px -10px rgba(153, 153, 153, 0.14), 0 4px 20px 0px rgba(153, 153, 153, 0.2), 0 7px 8px -5px rgba(153, 153, 153, 0.12);
    }
</style>
