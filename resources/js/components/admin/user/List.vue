<template>
    <div class="container">
        <router-link :to="{ name: 'admin.user.create'}" class="btn btn-primary">
            Создать нового пользователя
        </router-link>
        <h3>Нажмите на пользователя для редактирования</h3>
        <pagination :data="usersList" @pagination-change-page="getUsersList"></pagination>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Email</th>
                <th scope="col">Роль</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user in usersList.data">
                <th scope="row">{{ user.id }}</th>
                <td>
                    <router-link :to="{ name: 'admin.user.edit', params: {id: user.id}}">
                        {{ user.name }}
                    </router-link>
                </td>
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
            }
        },
        methods: {
            getUsersList(page = 1) {
                axios.get('/admin/user/list?page=' + page)
                    .then(response => {
                        this.usersList = response.data;
                    });
            }
        }
    }
</script>
