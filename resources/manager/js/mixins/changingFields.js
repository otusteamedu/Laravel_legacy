export const changeField = {
    methods: {
        onFieldChange (field, value, delay = false) {
            if (this.$v[field] && delay) {
                this.setValidationDelay(this.$v[field]);
            } else if (this.$v[field]) {
                this.$v[field].$touch();
            }

            this.$store.dispatch(`${this.storeModule}/updateField`, { field, value: value.trim() });
        }
    }
}

export const changeFile = {
    methods: {
        onFileChange(field, value) {
            this.$store.dispatch(`${this.storeModule}/updateField`, { field, value: value });
        }
    }
}

export const changeSelect = {
    methods: {
        onSelectChange (field, value) {
            if (this.$v[field]) {
                this.$v[field].$touch();
            }

            this.$store.dispatch(`${this.storeModule}/updateField`, { field, value });
        }
    }
}

export const changePublishEdit = {
    methods: {
        onPublishChange () {
            this.$v.publish.$touch();
            this.$store.dispatch(`${this.storeModule}/updatePublishField`);
        }
    }
}

export const changePublish = {
    methods: {
        onPublishChange () {
            this.$store.dispatch(`${this.storeModule}/updatePublishField`);
        }
    }
}
