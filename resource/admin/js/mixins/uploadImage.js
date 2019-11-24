

export const uploadImage = {
    methods: {
        onImageChange (vField, dataImage, action, e) {
            this.$v[vField].$touch();
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0], dataImage);
            action(e.target.files[0]);
        },
        createImage (file, dataImage) {
            let reader = new FileReader();
            let vm = this;

            reader.onload = (e) => vm[dataImage] = e.target.result;
            reader.readAsDataURL(file);
        },
        onImageRemove (dataImage, action, vField = null) {
            this[dataImage] = '';
            action('');
            if (vField) {
                this.$v[vField].$reset();
            }
        },
    }
}
