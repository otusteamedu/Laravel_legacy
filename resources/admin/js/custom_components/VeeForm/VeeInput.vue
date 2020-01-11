<template>
    <div>
        <h4 class="card-title">{{ name }}</h4>
        <div class="form-group">
            <md-field :class="[{ 'md-error': vField.$error }, { 'md-valid': !vField.$invalid }]">
                <md-icon v-if="icon">{{ icon }}</md-icon>
                <md-input :type="type" name="alias" @input="onInput" :value="value" :maxlength="maxlength" />
                <slide-y-down-transition v-show="vField.$error">
                    <md-icon class="error">close</md-icon>
                </slide-y-down-transition>
                <slide-y-down-transition v-show="vField.$dirty && !vField.$invalid">
                    <md-icon class="success">done</md-icon>
                </slide-y-down-transition>
            </md-field>
            <div class="under-input-notice" v-if="vField.$error">
                <input-notification-require v-if="!vField.required && vRules.required" :name="name" />
                <input-notification-unique v-else-if="!vField.isUnique && vRules.unique" :name="name"/>
                <input-notification-min-string v-else-if="!vField.minLength && vRules.minLength" :name="name"/>
                <input-notification-alias v-else-if="!vField.testAlias && vRules.alias" :name="name"/>
                <input-notification-key v-else-if="!vField.testKey && vRules.key" :name="name"/>
                <input-notification-num v-else-if="!vField.numeric && vRules.numeric" :name="name"/>
                <input-notification-alpha-num v-else-if="!vField.alphaNum && vRules.alphaNum" :name="name"/>
                <input-notification-email v-else-if="!vField.email && vRules.email"/>
                <input-notification-same-as-password v-else-if="!vField.sameAsPassword && vRules.sameAsPassword"/>
            </div>
        </div>
    </div>
</template>

<script>
    import {
        InputNotificationRequire,
        InputNotificationUnique,
        InputNotificationMinString,
        InputNotificationAlias,
        InputNotificationKey,
        InputNotificationAlphaNum,
        InputNotificationNum,
        InputNotificationSameAsPassword,
        InputNotificationEmail
    } from '@/custom_components/InputNotifications'

    export default {
        name: "VeeInput",
        components: {
            InputNotificationRequire,
            InputNotificationUnique,
            InputNotificationMinString,
            InputNotificationAlias,
            InputNotificationNum,
            InputNotificationSameAsPassword,
            InputNotificationAlphaNum,
            InputNotificationEmail,
            InputNotificationKey
        },
        props: {
            name: {
                type: String,
                require: true
            },
            vField: {
                type: Object,
                require: true
            },
            vRules: {
                type: Object,
                default: null
            },
            value: {
                type: [ String, Number ],
                default: ''
            },
            min: {
                type: Number,
                default: 2
            },
            maxlength: {
                type: Number,
                default: 30
            },
            icon: {
                type: String
            },
            type: {
                type: String,
                default: 'text'
            }
        },
        methods: {
            onInput(value) {
                this.$emit('input', value.trim());
            }
        }
    }
</script>
