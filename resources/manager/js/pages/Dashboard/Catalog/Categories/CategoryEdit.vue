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
                        <div>
                            <slide-y-down-transition v-show="$v.$anyDirty && !$v.$invalid">
                                <control-button title="Сохранить" @click="onUpdate" />
                            </slide-y-down-transition>
                            <control-button title="Удалить" @click="onDelete()" icon="delete" class="md-danger" />
                        </div>
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
                                 :value="title"
                                 :differ="true"
                                 :vField="$v.title"
                                 :module="storeModule"
                                 :vRules="{ required: true, unique: true, minLength: true }" />

                        <v-input title="Алиас"
                                 icon="code"
                                 name="alias"
                                 :value="alias"
                                 :differ="true"
                                 :vDelay="true"
                                 :vField="$v.alias"
                                 :module="storeModule"
                                 :vRules="{ required: true, unique: true, minLength: true, alias: true }" />

                        <div v-if="category_type === 'colors'">
                            <h4 class="card-title">Цвет</h4>
                            <div class="md-color-sample mt-2" :style="`background-color: ${alias}`"></div>
                        </div>

                        <v-image name="image"
                                 :imgDefault="imagePath"
                                 :differ="true"
                                 :vField="$v.image"
                                 :vRules="{ required: true }"
                                 :module="storeModule" />

                        <v-switch :vField="$v.publish"
                                  :differ="true"
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
                                    :value="description"
                                    :differ="true"
                                    :vField="$v.description"
                                    :module="storeModule" />

                        <v-textarea title="Ключевые слова"
                                    name="keywords"
                                    :value="keywords"
                                    :differ="true"
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
    import { pageTitle } from '@/mixins/base'
    import { updateMethod, deleteMethod } from '@/mixins/crudMethods'

    export default {
        name: 'CategoryEdit',
        props: {
            id: {
                type: [ Number, String ],
                required: true
            },
            result: []
        },
        mixins: [
            categoryPage,
            pageTitle,
            updateMethod,
            deleteMethod
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
                    return (value.trim() === '') && !this.$v.title.$dirty
                        ? true
                        : !this.isUniqueTitleEdit
                }
            },
            alias: {
                required,
                touch: false,
                minLength: minLength(2),
                isUnique (value) {
                    return (value.trim() === '') && !this.$v.alias.$dirty
                        ? true
                        : !this.isUniqueAliasEdit
                },
                testAlias (value) {
                    return value.trim() === ''
                        ? true
                        : (/^([a-z0-9]+[-]?)+[a-z0-9]$/).test(value);
                }
            },
            image: {
                touch: false
            },
            publish: {
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
                imagePath: state => state.fields.image_path,
                publish: state => state.fields.publish,
                description: state => state.fields.description,
                keywords: state => state.fields.keywords
            }),
            isUniqueTitleEdit () {
                return !!this.$store.getters['categories/isUniqueTitleEdit'](this.title, this.id);
            },
            isUniqueAliasEdit () {
                return !!this.$store.getters['categories/isUniqueAliasEdit'](this.alias, this.id);
            }
        },
        methods: {
            ...mapActions('categories', {
                showAction: 'show',
                indexAction: 'index'
            }),
            onUpdate () {
                return this.update({
                    sendData: {
                        category_id: this.id,
                        formData: {
                            type: this.category_type,
                            title: this.title,
                            alias: this.alias,
                            image: this.image,
                            publish: +this.publish,
                            description: this.description,
                            keywords: this.keywords
                        }
                    },
                    title: this.title,
                    successText: 'Категория обновлена!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                });
            },
            onDelete () {
                return this.delete({
                    payload: this.id,
                    title: this.title,
                    alertText: `категорию «${this.title}»`,
                    successText: 'Категория удалена!',
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                })
            }
        },
        created() {
            this.indexAction()
                .then(() => this.showAction(this.id))
                .then(() => {
                    this.setPageTitle(this.title);
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
