<template>
    <div class="container">
        <h2>Редактирование пользователя {{ userData.username }}</h2>
        <form>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="email" class="form-control" id="username" placeholder="username"
                       v-bind:value="userData.username">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email"
                       v-bind:value="userData.email">
            </div>
            <div class="form-group">
                <label for="role">Роль пользователя</label>
                <select class="form-control" id="role">
                    <option v-for="role in rolesList" v-bind:selected="isUserRole(role.id)" v-bind:value="role.id">
                        {{ role.title }}
                    </option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        mounted() {
            this.userId = this.$route.params.id;
            this.getUserData(this.userId);
            this.getRolesList();
        },
        data() {
            return {
                userData: [],
                rolesList: [],
                userId: null,

            }
        },
        methods: {
            getRolesList() {
                axios.get('/api/admin/role/list')
                    .then(response => {
                        this.rolesList = response.data;
                        console.log(response.data);
                    });
            },
            getUserData(id) {
                axios.get('/api/admin/user/get-user/' + id)
                    .then(response => {
                        this.userData = response.data;
                        console.log(response.data);
                    });
            },
            isUserRole(roleId) {
                return roleId === this.userData.role_id;
            }
        }
    }
</script>
