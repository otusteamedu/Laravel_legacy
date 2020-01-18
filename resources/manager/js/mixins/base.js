import { mapActions } from 'vuex'

export const pageTitle = {
    methods: {
        ...mapActions([
            'setPageTitle'
        ])
    }
}
