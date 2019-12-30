<template>
    <div class="container">
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
            <tr v-for="user in usersList">
                <th scope="row">{{ user.id }}</th>
                <td>{{ user.username }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.role }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.getUsersList();
        },
        data() {
            return {
                usersList: [],
            }
        },
        methods: {
            getUsersList() {
                axios.get('/api/admin/user/list')
                    .then(response => {
                        this.usersList = response.data;
                    });
            }
        }
    }
</script>
