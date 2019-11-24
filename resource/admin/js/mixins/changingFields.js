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
