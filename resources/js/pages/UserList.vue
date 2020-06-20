<template>
    <div class='page-wrapper userlist-wrapper'>
        <div>
            <div class='input-container'>
                <div class='input-container__label'>{{ $t('userlist.search') }}</div>
                <input type='text' v-model="search" >
            </div>
            <vue-table :elements='users'/>
        </div>
        <div class='end-of-page'>
            <div class='paginate'>
                <div v-if='prevPage' class='paginate__next-page button' @click="getPage(prevPage)">{{ prevPage }}</div>
                <div>{{ currentPage }}</div>
                <div v-if='nextPage' class='paginate__next-page button' @click="getPage(nextPage)">{{ nextPage }}</div>
            </div>
            <div class='input-container'>
                <div class='input-container__label'>{{ $t('userlist.users_per_page') }}</div>
                <input type='number' min='1' step='1' v-model="perPage">
            </div>
            <div class='input-container'>
                <div class='input-container__label'>{{ $t('userlist.page_to_go') }}</div>
                <input type='number' min='1' step='1' v-model="pageToGo" >
            </div>
        </div>
    </div>
</template>

<script>
import VueTable from '../components/VueTable.vue';

export default {
    data() {
        return {
            users: [],
            currentPage: 1,
            nextPage: null,
            prevPage: null,
            perPage: 20,
            pageToGo: null,
            search: null
        };
    },
    components: {
        VueTable
    },
    mounted() {
        this.getPage(1);
    },
    methods: {
        getPage: function(page) {
            let currentPage = page;
            this.currentPage = currentPage;
            let search = this.search;
            let searchUrl = '';
            if (search && search.length >= 3) {
                searchUrl = `/${search}`;
            }
            axios.get(`/api/users/${currentPage}/${this.perPage}${searchUrl}`).then(response => {
                let resp = response.data;
                this.users = resp.entities;

                for (let i = 0; i < this.users.length; i++) {
                    this.users[i].link = `/user/${this.users[i].id}`;
                    this.users[i].created_at = undefined;
                    this.users[i].updated_at = undefined;
                }
                if (resp.is_prev_page_exist) {
                    this.prevPage = parseInt(currentPage) - 1;
                } else {
                    this.prevPage = null;
                }
                if (resp.is_next_page_exist) {
                    this.nextPage = parseInt(currentPage) + 1;
                } else{
                    this.nextPage = null;
                }
            });
        }
    },
    watch: {
        pageToGo: function(val) {
            if (parseInt(val)) {
                this.getPage(val);
            }
        },
        search: function(val) {
            this.getPage(this.currentPage);
        },
        perPage: function(val) {
            if (parseInt(val)) {
                this.getPage(this.currentPage);
            }
        }
    }
}
</script>