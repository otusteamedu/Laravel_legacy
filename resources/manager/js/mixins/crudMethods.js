import swal from 'sweetalert2'

export const createMethod = {
    methods: {
        create({ sendData, title, successText, redirectRoute, storeModule = null }) {
            const module = storeModule ? `${storeModule}/` : '';

            return this.$store.dispatch(`${module}store`, sendData)
                .then(() => {
                    this.$router.go(-1) ? this.$router.go(-1) : this.$router.push(redirectRoute);

                    return swal.fire({
                        title: successText,
                        text: `«${title}»`,
                        timer: 2000,
                        showConfirmButton: false,
                        type: 'success'
                    });
                });
        }
    }
}

export const updateMethod = {
    methods: {
        update ({ sendData, title, redirectRoute, successText, storeModule = null }) {
            const module = storeModule ? `${storeModule}/` : '';

            return this.$store.dispatch(`${module}update`, sendData)
                .then(() => {
                    this.$router.go(-1) ? this.$router.go(-1) : this.$router.push(redirectRoute);

                    return swal.fire({
                        title: successText,
                        text: `«${title}»`,
                        timer: 2000,
                        showConfirmButton: false,
                        type: 'success'
                    });

                });
        }
    }
}

export const deleteMethod = {
    methods: {
        delete({
            payload,
            title,
            alertText,
            successText,
            storeModule = null,
            redirectRoute = null,
            categoryId = null,
            paginationData = null,

        }) {
            const module = storeModule ? `${storeModule}/` : '';

            return deleteSwalFireConfirm(alertText)
                .then((result) => {
                    if (result.value) {
                        return this.$store.dispatch(`${module}destroy`, payload)
                            .then(() => {
                                if (redirectRoute) {
                                    this.$router.go(-1) ? this.$router.go(-1) : this.$router.push(redirectRoute);
                                }

                                if (paginationData) {
                                    categoryId
                                        ? this.$store.dispatch('categories/showImages', {
                                            id: categoryId,
                                            data: paginationData
                                        })
                                        : this.$store.dispatch('images/index', paginationData);
                                }

                                return deleteSwalFireAlert(successText, title);
                            });
                    }
            });
        },
    }
}

const deleteSwalFireConfirm = alertText => {
    return swal.fire({
        title: 'Вы уверены?',
        text: `Данное действие удалит ${alertText} безвозвратно!`,
        type: 'warning',
        showCancelButton: true,
        confirmButtonClass: 'md-button md-success btn-fill',
        cancelButtonClass: 'md-button md-danger btn-fill',
        confirmButtonText: 'Удалить',
        cancelButtonText: 'Отменить',
        buttonsStyling: false
    })
}

const deleteSwalFireAlert = (successText, title) => {
    return swal.fire({
        title: successText,
        text: `«${title}»`,
        timer: 2000,
        type: 'success',
        showConfirmButton: false
    })
}

export const uploadMethod = {
    methods: {
        async upload ({ uploadFiles, type = null, id = null, storeModule = null, paginationData }) {
            const files = Array.from(uploadFiles);
            const module = storeModule ? storeModule : 'categories';

            id
                ? await this.$store.dispatch(`${module}/uploadImages`, { files, id, type, paginationData })
                : await this.$store.dispatch('images/store', { files, paginationData });

            return await swal.fire({
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
        addImages ({ category, selected }) {
            this.$store.dispatch('categories/addSelectedImages',{ category_id: category.id, selected_images: selected })
                .then(() => {
                    this.$router.push({ name: 'manager.catalog.categories.images', params: { id: category.id } });

                    return swal.fire({
                        title: 'Изображения добавлены!',
                        text: '',
                        timer: 2000,
                        showConfirmButton: false,
                        type: 'success'
                    });
                });
        }
    }
}

export const subCategoryImageAddMethod = {
    methods: {
        addImages ({ type, id, selected, redirectRoute }) {
            this.$store.dispatch('subCategories/addSelectedImages', { type, id, selected_images: selected })
                .then(() => {
                    this.$router.push(redirectRoute);

                    return swal.fire({
                        title: 'Изображения добавлены!',
                        text: '',
                        timer: 2000,
                        showConfirmButton: false,
                        type: 'success'
                    });
                });
        }
    }
}
