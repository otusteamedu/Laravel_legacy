<template>
    <div class="container">
        <h2>Редактирование пользователя {{ username }}</h2>
        <div v-if="isUpdateSuccess" class="alert alert-success" role="alert">
            Данные обновлены успешно!
        </div>
        <div v-if="hasUpdateErrors" class="alert alert-danger" role="alert">
            Не удалось обновить данные!
        </div>
        <form>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" placeholder="username" readonly
                       v-model="username">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email"
                       v-model="userEmail">
            </div>
            <div class="form-group">
                <label for="role">Роль пользователя</label>
                <select class="form-control" id="role" v-model="userRoleId">
                    <option v-for="role in rolesList" v-bind:selected="isUserRole(role.id)" v-bind:value="role.id">
                        {{ role.title }}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="created_at">Дата создания</label>
                <input type="text" class="form-control" id="created_at" readonly
                       v-model="dateCreated">
            </div>
            <div class="form-group">
                <label for="updated_at">Дата последнего обновления</label>
                <input type="text" class="form-control" id="updated_at" readonly
                       v-model="dateUpdated">
            </div>
            <button v-on:click.prevent="sendData" class="btn btn-primary">Сохранить изменения</button>
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
                rolesList: [],
                userId: null,
                username: null,
                userRoleId: null,
                userEmail: null,
                dateCreated: null,
                dateUpdated: null,
                isUpdateSuccess: false,
                hasUpdateErrors: false
            }
        },
        methods: {
            sendData() {
                this.isUpdateSuccess = false;
                this.hasUpdateErrors = false;
                axios.put('/api/admin/user/update/' + this.userId, {
                    email: this.userEmail,
                    role_id: this.userRoleId,
                })
                    .then(response => {
                        this.getUserData(this.userId);
                        this.isUpdateSuccess = true;
                        console.log(response);
                    })
                    .catch(error => {
                        this.hasUpdateErrors = true;
                        console.log(error);
                    });
            },
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
                        this.userId = response.data.id;
                        this.username = response.data.username;
                        this.userRoleId = response.data.role_id;
                        this.userEmail = response.data.email;
                        this.dateCreated = response.data.created_at;
                        this.dateUpdated = response.data.updated_at;
                        console.log(response.data);
                    });
            },
            isUserRole(roleId) {
                return roleId === this.userRoleId;
            }
        }
    }
</script>
