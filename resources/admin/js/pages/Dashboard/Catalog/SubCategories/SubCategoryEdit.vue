<template>
    <div v-if="responseData">
        <div class="md-layout">
            <div class="md-layout-item">
                <md-card class="mt-0">
                    <md-card-content class="md-between">
                        <router-button-link
                            route="manager.catalog.subcategories.list"
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
                        <vee-input name="Заголовок" :vField="$v.title" @input="onFieldChange('title', $event)"
                                    :value="title"
                                    :maxlength="50"
                                    :vRules="{
                                        required: true,
                                        unique: true,
                                        minLength: true
                                    }"/>
                        <vee-textarea name="Описание" :vField="$v.description" :value="description"
                                      @input="onFieldChange('description', $event)" />
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
    import { changeField, changePublishEdit } from '@/mixins/changingFields'
    import { validationDelay } from '@/mixins/validations'
    import { updateMethod, deleteMethod } from '@/mixins/crudMethods'

    export default {
        name: 'TagEdit',
        props: {
            id: {
                type: [ Number, String ],
                required: true
            },
            result: []
        },
        mixins: [
            subCategoryPage,
            pageTitle,
            changeField,
            changePublishEdit,
            validationDelay,
            updateMethod,
            deleteMethod
        ],
        data () {
            return {
                imageFile: '',
                responseData: false,
                storeModule: 'subCategories',
                redirectRoute: {
                    name: 'manager.catalog.subcategories.list'
                }
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
            publish: {
                touch: false
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
            isUniqueTitleEdit () {
                return !!this.$store.getters['subCategories/isUniqueTitleEdit'](this.title, this.id);
            }
        },
        methods: {
            ...mapActions('subCategories', {
                showAction: 'show',
                indexAction: 'index'
            }),
            onUpdate () {
                return this.update({
                    sendData: {
                        id: this.id,
                        type: this.category_type,
                        formData: {
                            title: this.title,
                            publish: +this.publish,
                            description: this.description
                        }
                    },
                    title: this.title,
                    successText: this.pageProps[this.category_type].UPDATE_SUCCESS_TEXT,
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                });
            },
            onDelete () {
                return this.delete({
                    payload: {
                        type: this.category_type,
                        id: this.id
                    },
                    title: this.title,
                    alertText: this.pageProps[this.category_type].DELETE_CONFIRM_TEXT(this.title),
                    successText: this.pageProps[this.category_type].DELETE_SUCCESS_TEXT,
                    storeModule: this.storeModule,
                    redirectRoute: this.redirectRoute
                })
            }
        },
        created() {
            this.indexAction(this.category_type)
                .then(() => this.showAction({
                    type: this.category_type,
                    id: this.id
                }))
                .then(() => {
                    this.setPageTitle(this.title);
                    this.responseData = true;
                })
                .catch(() => this.$router.push(this.redirectRoute));
        }
    }
</script>
