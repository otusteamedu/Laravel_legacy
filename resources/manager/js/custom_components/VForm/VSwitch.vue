<template>
    <div>
        <h4 class="card-title">{{ title }}</h4>
        <md-switch :value="!value" @change="onChange" />
    </div>
</template>

<script>
    export default {
        name: "VSwitch",
        props: {
            vField: {
                type: Object,
                default: null
            },
            name: {
                type: String,
                default: 'publish'
            },
            title: {
                type: String,
                default: 'Опубликовать'
            },
            module: {
                type: String,
                default: null
            },
            value: {
                type: [ String, Number ],
                default: ''
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
            },
            fieldName() {
                const fieldName = this.name[0].toUpperCase() + this.name.slice(1);
                return `toggle${fieldName}Field`
            }
        },
        methods: {
            onChange() {
                if (this.vField)
                    this.touched(this.vField, this.value);

                this.$store.dispatch(`${this.storeModule}${this.fieldName}`);
            },
            touched(v, value) {
                this.differ ? this.touchedDifferent(v, value) : v.$touch();
            },
            touchedDifferent(v, value) {
                this.isDiffer(value, this.valueReference)
                    ? v.$touch()
                    : v.$reset()
            },
            isDiffer(a, b) {
                return a === b;
            }

        },
        created() {
            this.valueReference = this.value;
        }
    }
</script>
