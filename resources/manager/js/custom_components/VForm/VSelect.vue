<template>
    <div>
        <h4 v-if="title" class="card-title">{{ title }}</h4>
        <md-field>
            <label>{{ placeholder }}</label>
            <md-select @md-selected="onSelect" :value="value" :multiple="multiple">
                <md-option v-if="defaultValue !== null" :value="defaultValue">{{ defaultTitle }}</md-option>
                <md-option v-for="(item, index) in options" :value="item[indexName]" :key="index">
                    {{ item[nameField] }}
                </md-option>
            </md-select>
        </md-field>
    </div>
</template>

<script>
    export default {
        name: "VSelect",
        props: {
            title: {
                type: String
            },
            name: {
                type: String,
                required: true
            },
            vField: {
                type: Object,
                default: null
            },
            placeholder: {
                type: String
            },
            options: {
                type: Array,
                required: true
            },
            value: {
                type: [ Array, Number, String ],
                default: null
            },
            multiple: {
                type: Boolean,
                default: false
            },
            defaultValue: {
                type: [ Array, Number, String, Object ],
                default: null
            },
            defaultTitle: {
                type: String,
                default: 'Нет'
            },
            nameField: {
                type: String,
                default: 'title'
            },
            indexName: {
                type: [ String, Number ],
                default: 'id'
            },
            module: {
                type: String,
                default: null
            },
            differ: {
                type: Boolean,
                default: false
            }
        },
        data() {
          return {
              valueReference: null
          }
        },
        computed: {
            storeModule() {
                return this.module ? `${this.module}/` : '';
            }
        },
        methods: {
            onSelect (value) {
                if (this.vField)
                    this.touched(this.vField, value);

                this.$store.dispatch(`${this.storeModule}updateField`, { field: this.name, value });
            },
            isDiffer(a, b) {
                return this.multiple
                    ? !!a.filter(i => !b.includes(i)).concat(b.filter(i => !a.includes(i))).length
                    : a != b;
            },
            touchedDifferent(v, value) {
                this.isDiffer(value, this.valueReference)
                    ? v.$touch()
                    : v.$reset()
            },
            touched(v, value) {
                this.differ ? this.touchedDifferent(v, value) : v.$touch();
            }
        },
        created() {
            this.valueReference = this.value instanceof Array ? this.value.slice(0) : this.value;
        }
    }
</script>
