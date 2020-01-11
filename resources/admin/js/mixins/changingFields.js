export const changeField = {
    methods: {
        onFieldChange (name, value, delay = false) {
            if (this.$v[name] && delay) {
                this.setValidationDelay(this.$v[name]);
            } else if (this.$v[name]) {
                this.$v[name].$touch();
            }

            const title = name[0].toUpperCase() + name.slice(1);
            this.$store.dispatch(`${this.storeModule}/update${title}Field`, value.trim());
        }
    }
}

export const changeSelect = {
    methods: {
        onSelectChange (name, value) {
            if (this.$v[name]) {
                this.$v[name].$touch();
            }

            const title = name[0].toUpperCase() + name.slice(1);
            this.$store.dispatch(`${this.storeModule}/update${title}Field`, value);
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
