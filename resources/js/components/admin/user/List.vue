<template>
    <div class="container">
        <pagination :data="usersList" @pagination-change-page="getUsersList"></pagination>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Роль</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user in usersList.data">
                <th scope="row">{{ user.id }}</th>
                <td>{{ user.username }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.role }}</td>
            </tr>
            </tbody>
        </table>
        <pagination :data="usersList" @pagination-change-page="getUsersList"></pagination>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        mounted() {
            this.getUsersList();
        },
        data() {
            return {
                usersList: {},
                firstPageUrl: '',
                lastPageUrl: '',
                nextPageUrl: '',
            }
        },
        methods: {
            getUsersList(page = 1) {
                axios.get('/api/admin/user/list?page=' + page)
                    .then(response => {
                        this.usersList = response.data;
                    });
            }
        }
    }
</script>
