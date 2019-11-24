import swal from 'sweetalert2'

export const createMethod = {
    methods: {
        create({ title, sendData, successText, redirectName }) {
            this.createItem(sendData)
                .then(() => {
                    swal.fire({
                        title: successText,
                        text: `«${title}»`,
                        timer: 2000,
                        showConfirmButton: false,
                        type: 'success'
                    });
                    this.$router.push({ name: redirectName });
                });
        }
    }
}

export const updateMethod = {
    methods: {
        update ({ sendData, title, redirectName, successText }) {
            this.updateItem(sendData)
                .then(() => {
                    swal.fire({
                        title: successText,
                        text: `«${title}»`,
                        timer: 2000,
                        showConfirmButton: false,
                        type: 'success'
                    });
                    this.$router.go(-1) ? this.$router.go(-1) : this.$router.push({name: redirectName});
                });
        }
    }
}

export const deleteMethod = {
    methods: {
        delete({ id, title, alertText, successText, redirectName = null}) {
            swal.fire({
                title: 'Вы уверены?',
                text: `Данное действие удалит ${alertText} безвозвратно!`,
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'md-button md-success btn-fill',
                cancelButtonClass: 'md-button md-danger btn-fill',
                confirmButtonText: 'Удалить',
                cancelButtonText: 'Отменить',
                buttonsStyling: false
            }).then((result) => {
                if(result.value){
                    this.deleteItem(id)
                        .then(() => {
                            swal.fire({
                                title: successText,
                                text: `«${title}»`,
                                timer: 2000,
                                type: 'success',
                                showConfirmButton: false
                            });
                            if (redirectName) {
                                this.$router.go(-1) ? this.$router.go(-1) : this.$router.push({name: redirectName});
                            }
                        });
                }
            });
        },
    }
}

export const uploadMethod = {
    methods: {
        async upload (value) {
            const files = Array.from(value);
            if (this.category_type !== 'images') {
                await this.$store.dispatch('categories/uploadImages', {
                    'category_type': this.category_type,
                    'category_id': this.id,
                    'files': files
                });
            } else {
                await this.$store.dispatch('images/uploadItems', files);
            }
            await swal.fire({
                title: 'Изображения загружены!',
                text: '',
                timer: 2000,
                showConfirmButton: false,
                type: 'success'
            });
        }
    }
}

export const imageAddMethod = {
    methods: {
        addImages ({ categoryType, id, selected }) {
            this.addSelectedImages({ category_type: categoryType, category_id: id, selected_images: selected })
                .then(() => {
                    swal.fire({
                        title: 'Изображения добавлены!',
                        text: '',
                        timer: 2000,
                        showConfirmButton: false,
                        type: 'success'
                    });
                    this.$router.push({ name: `admin.categories.${categoryType}.images`, params: { id: id } });
                });
        }
    }
}
