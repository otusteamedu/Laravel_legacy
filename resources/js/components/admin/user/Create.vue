<template>
    <div class="container">
        <h2>Редактирование пользователя {{ username }}</h2>
        <div v-if="isCreateSuccess" class="alert alert-success" role="alert">
            Пользователь успешно создан! Редирект на страницу редактирования ...
        </div>
        <div v-if="hasCreateErrors" class="alert alert-danger" role="alert">
            Не удалось создать пользователя!
        </div>
        <form>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" placeholder="username" required
                       v-model="username">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email" required
                       v-model="userEmail">
            </div>
            <div class="form-group">
                <label for="role">Роль пользователя</label>
                <select class="form-control" id="role" v-model="userRoleId" required>
                    <option v-for="role in rolesList" v-bind:value="role.id">
                        {{ role.title }}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" class="form-control" id="password" placeholder="123456" required
                    v-model="password">
            </div>
            <button v-if="!isCreateSuccess" v-on:click.prevent="sendData" class="btn btn-primary">Создать пользователя</button>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        mounted() {
            this.getRolesList();
        },
        data() {
            return {
                rolesList: [],
                username: null,
                userRoleId: null,
                userEmail: null,
                password: null,
                isCreateSuccess: false,
                hasCreateErrors: false
            }
        },
        methods: {
            sendData() {
                this.isCreateSuccess = false;
                this.hasCreateErrors = false;
                axios.post('/api/admin/user/create', {
                    username: this.username,
                    email: this.userEmail,
                    role_id: this.userRoleId,
                    password: this.password
                })
                    .then(response => {
                        this.isCreateSuccess = true;
                        let userId = response.data.id;
                        setTimeout(()=>{
                            this.$router.push({ name: 'admin.user.edit', params: {id: userId}});
                        }, 2000);
                        console.log(response);
                    })
                    .catch(error => {
                        this.hasCreateErrors = true;
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
        }
    }
</script>
