<template>
    <div>
        <h4 class="card-title">{{ name }}</h4>
        <div class="form-group">
            <md-field :class="[{ 'md-error': vField.$error }, { 'md-valid': !vField.$invalid }]">
                <md-icon v-if="icon">{{ icon }}</md-icon>
                <md-input name="alias" @input="onInput" :value="value" :maxlength="max"></md-input>
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
                <input-notification-num v-else-if="!vField.numeric && vRules.numeric" :name="name"/>
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
        InputNotificationNum
    } from '@/custom_components/InputNotifications'

    export default {
        name: "VeeInput",
        components: {
            InputNotificationRequire,
            InputNotificationUnique,
            InputNotificationMinString,
            InputNotificationAlias,
            InputNotificationNum
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
            max: {
                type: Number,
                default: 30
            },
            icon: {
                type: String
            }
        },
        methods: {
            onInput(value) {
                this.$emit('input', value.trim());
            }
        }
    }
</script>
