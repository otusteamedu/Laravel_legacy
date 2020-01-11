<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card class="mt-0">
                    <md-card-content class="md-between">
                        <router-button-link route="manager.catalog.subcategories.list" />
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
                        <vee-input name="Заголовок" :vField="$v.title" @input="onFieldChange('title', $event)"
                                    :vRules="{
                                        required: true,
                                        unique: true,
                                        minLength: true
                                    }"/>
                        <vee-textarea name="Описание" :vField="$v.description" @input="onFieldChange('description', $event)" />
                        <div class="space-10"></div>
                        <h4 class="card-title">Опубликовать</h4>
                        <md-switch :value="!publish" @change="onPublishChange" />
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
    import { changeField, changePublish } from '@/mixins/changingFields'
    import { validationDelay } from '@/mixins/validations'
    import { createMethod } from '@/mixins/crudMethods'

    export default {
        name: 'SubCategoryCreate',
        mixins: [
            subCategoryPage,
            pageTitle,
            changeField,
            changePublish,
            validationDelay,
            createMethod
        ],
        data () {
            return {
                storeModule: 'subCategories',
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
                    redirectRoute: {
                        name: 'manager.catalog.subcategories.list'
                    }
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
                .catch(() => this.$router.push({
                    name: 'manager.catalog.subcategories.list'
                }));
        }
    }
</script>
