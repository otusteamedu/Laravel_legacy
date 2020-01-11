

export const uploadImage = {
    methods: {
        onImageChange (vFieldName, dataImageName, action, e) {
            this.$v[vFieldName].$touch();
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0], dataImageName);
            action(files[0]);
        },
        createImage (file, dataImageName) {
            const reader = new FileReader();
            const vm = this;
            reader.onload = (e) => {
                vm[dataImageName] = e.target.result;
            }
            reader.readAsDataURL(file);
        },
        onImageRemove (dataImageName, action, vFieldName = null) {
            this[dataImageName] = '';
            action('');
            if (vFieldName)
                this.$v[vFieldName].$reset();
        }
    }
}
