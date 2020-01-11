<template>
    <div>
        <h4 v-if="title" class="card-title">{{ title }}</h4>
        <md-field>
            <label>{{ placeholder }}</label>
            <md-select @md-selected="onSelect" :value="value" :multiple="multiple">
                <md-option v-if="defaultValue" :value="defaultValue.value">{{ defaultValue.title }}</md-option>
                <md-option v-for="(item, index) in options" :value="item[indexName]" :key="index">
                    {{ item[nameField] }}
                </md-option>
            </md-select>
        </md-field>
    </div>
</template>

<script>
    export default {
        name: "VeeSelect",
        props: {
            title: {
                type: String
            },
            placeholder: {
                type: String
            },
            options: {
                type: Array,
                required: true
            },
            value: {
                type: [ Array, String, Number ],
                default: null
            },
            multiple: {
                type: Boolean,
                default: false
            },
            defaultValue: {
                type: Object,
                default: null
            },
            nameField: {
                type: String,
                default: 'title'
            },
            indexName: {
                type: [ String, Number ],
                default: 'id'
            }
        },
        methods: {
            onSelect (value) {
                this.$emit('selected', value);
            }
        }
    }
</script>

<style scoped>

</style>
