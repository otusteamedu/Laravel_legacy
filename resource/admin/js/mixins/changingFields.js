export const changeTitle = {
    methods: {
        onTitleChange (value) {
            this.setValidationDelay(this.$v.title);
            this.$store.dispatch(`${this.store_module}/updateTitleField`, value.trim());
        }
    }
}

export const changeField = {
    methods: {
        onFieldChange (name, value, delay = false) {
            if (this.$v[name] && delay) {
                this.setValidationDelay(this.$v[name]);
            } else if (this.$v[name]) {
                this.$v[name].$touch();
            }

            const title = name[0].toUpperCase() + name.slice(1);
            this.$store.dispatch(`${this.store_module}/update${title}Field`, value.trim());
        }
    }
}

export const changeAlias = {
    methods: {
        onAliasChange (value) {
            this.setValidationDelay(this.$v.alias);
            this.$store.dispatch(`${this.store_module}/updateAliasField`, value.trim());
        }
    }
}

export const changePublishEdit = {
    methods: {
        onPublishChange () {
            this.$v.publish.$touch();
            this.$store.dispatch(`${this.store_module}/updatePublishField`);
        }
    }
}

export const changePublish = {
    methods: {
        onPublishChange () {
            this.$store.dispatch(`${this.store_module}/updatePublishField`);
        }
    }
}

export const changeDescription = {
    methods: {
        onDescriptionChange (value) {
            this.$v.description.$touch();
            this.$store.dispatch(`${this.store_module}/updateDescriptionField`, value.trim());
        }
    }
}

export const changeKeywords = {
    methods: {
        onKeywordsChange (value) {
            this.$v.keywords.$touch();
            this.$store.dispatch(`${this.store_module}/updateKeywordsField`, value.trim());
        }
    }
}

export const changeTopics = {
    methods: {
        onTopicsChange(value) {
            this.$v.topics.$touch();
            this.$store.dispatch(`${this.store_module}/updateTopicsField`, value);
        }
    }
}

export const changeColors = {
    methods: {
        onColorsChange(value) {
            this.$v.colors.$touch();
            this.$store.dispatch(`${this.store_module}/updateColorsField`, value);
        }
    }
}

export const changePlacements = {
    methods: {
        onPlacementsChange(value) {
            this.$v.placements.$touch();
            this.$store.dispatch(`${this.store_module}/updatePlacementsField`, value);
        }
    }
}

export const changeOwner = {
    methods: {
        onOwnerChange(value) {
            this.$v.placements.$touch();
            this.$store.dispatch(`${this.store_module}/updateOwnerField`, value);
        }
    }
}
