<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card class="mt-0">
                    <md-card-content class="md-between">
                        <router-button-link :route="redirectRoute.name" />
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
                                 :module="storeModule"
                                 :vField="$v.title"
                                 :vRules="{ required: true, unique: true, minLength: true }" />

                        <v-textarea name="description"
                                    :vField="$v.description"
                                    :module="storeModule" />

                        <div class="space-10"></div>

                        <v-switch :vField="$v.publish"
                                  :module="storeModule" />

                    </md-card-content>
                </md-card>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'

    import { required, minLength } from 'vuelidate/lib/validators'

    import { subCategoryPage } from '@/mixins/categories'
    import { pageTitle } from '@/mixins/base'
    import { createMethod } from '@/mixins/crudMethods'

    export default {
        name: 'SubCategoryCreate',
        mixins: [
            subCategoryPage,
            pageTitle,
            createMethod
        ],
        data () {
            return {
                storeModule: 'subCategories',
                responseData: false,
                redirectRoute: { name: 'manager.catalog.subcategories.list' }
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
                        : !this.isUniqueTitle
                }
            },
            description: {
                touch: false
            }
        },
        computed: {
            ...mapState('subCategories', {
                title: state => state.fields.title,
                publish: state => state.fields.publish,
                description: state => state.fields.description
            }),
            isUniqueTitle () {
                return !!this.$store.getters['subCategories/isUniqueTitle'](this.title);
            }
        },
        methods: {
            ...mapActions('subCategories', {
                indexAction: 'index',
                clearFieldsAction: 'clearFields'
            }),
            onCreate () {
                return this.create({
                    sendData: {
                        type: this.category_type,
                        formData: {
                            title: this.title,
                            publish: +this.publish,
                            description: this.description
                        }
                    },
                    title: this.title,
                    successText: this.pageProps[this.category_type].CREATE_SUCCESS_TEXT,
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                })
            }
        },
        created () {
            this.indexAction(this.category_type)
                .then(() => {
                    this.setPageTitle(this.pageProps[this.category_type].CREATE_PAGE_TITLE);
                    this.clearFieldsAction();
                    this.responseData = true;
                })
                .catch(() => this.$router.push(this.redirectRoute));
        }
    }
</script>
