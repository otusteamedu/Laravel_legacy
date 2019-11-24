<template>
    <div>
        <h4 class="card-title">{{ name }}</h4>
        <div class="form-group">
            <md-field :class="[{'md-valid': vField.$dirty}]">
                <md-textarea @input="onInput" :value="value" :maxlength="max"></md-textarea>
                <slide-y-down-transition v-show="vField.$dirty">
                    <md-icon class="success">done</md-icon>
                </slide-y-down-transition>
            </md-field>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CTextarea",
        props: {
            vField: {
                type: Object,
                require: true
            },
            name: {
                type: String,
                default: ''
            },
            value: {
                type: String,
                default: ''
            },
            max: {
                type: Number,
                default: 250
            }
        },
        methods: {
            onInput(value) {
                this.$emit('input', value.trim());
            }
        }
    }
</script>
