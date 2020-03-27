<template>
    <div>
        <h4 class="card-title">{{ title }}</h4>
        <ckeditor
            :editor="editor"
            :config="editorConfig"
            :value="value"
            @input="onInput"/>
    </div>
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
        props: {
            title: {
                type: String,
                default: 'Описание'
            },
            value: {
                type: String
            },
            name: {
                type: String,
                default: 'description'
            },
            vField: {
                type: Object,
                default: null
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
        data () {
            return {
                editor: ClassicEditor,
                editorConfig: {
                    toolbar: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        'blockQuote',
                        '|',
                        'undo',
                        'redo'
                    ],
                    heading: {
                        options: [
                            {model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph'},
                            {model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1'},
                            {model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2'},
                            {model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3'},
                            {model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4'},
                            {model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5'},
                            {model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6'}
                        ]
                    }
                },
                valueReference: ''
            }
        },
        computed: {
            storeModule() {
                return this.module ? `${this.module}/` : '';
            }
        },
        methods: {
            onInput(value) {
                if (this.vField)
                    this.touched(this.vField, value);

                this.$store.dispatch(`${this.storeModule}updateField`, {
                    field: this.name,
                    value: value.trim()
                });
            },
            isDiffer(a, b) {
                return a !== b;
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
            this.valueReference = this.value;
        }
    }
</script>

<style lang="scss">
    .ck.ck-editor__main>.ck-editor__editable {
        height: 300px;
        &:focus {
            border: 1px solid var(--ck-color-input-border);
            box-shadow: var(--ck-inner-shadow),0 0;
            outline: none;
        }
    }
    .ck input.ck-input.ck-input-text:focus {
        border: 0;
        box-shadow: none;
    }
</style>

