<template>
    <div class="md-layout">
        <div class="md-layout-item">
            <h4 class="card-title">{{ title }}</h4>
            <md-field>
                <md-input
                    :name="name"
                    :value="value"
                    :type="type"
                    :placeholder="`Заполните поле ${title}`"
                    @input="onInputChange"
                />
            </md-field>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'setting-input',
        props: {
            title: String,
            name: String,
            value: String,
            onSave: Function,
            timeout: {
                type: Number,
                default: 500,
            },
            type: {
                default: 'text',
                type: String
            }
        },
        data () {
            return {
                inputValue: '',
                onEdit: false,
                updateTimeout: null
            }
        },
        methods: {
            onUpdateDelay() {
                clearTimeout(this.updateTimeout);
                this.updateTimeout = setTimeout(this.onUpdate, this.timeout);
            },
            onInputChange(value) {
                this.inputValue = value.trim();
                this.onUpdateDelay();
            },
            onUpdate() {
                return this.onSave({
                    key_name: this.name,
                    value: this.inputValue
                });
            }
        },
        created() {
            this.inputValue = this.value;
        }
    }
</script>
