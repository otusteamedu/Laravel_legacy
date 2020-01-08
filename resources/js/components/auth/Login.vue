<template>
    <div class="container">
        <div class="text-center" style="padding:50px 0">
            <div class="logo">Сделай бизнес проще!</div>
            <div class="alert alert-danger" v-if="errors">
                <p>Ошибка авторизации!</p>
                <p>{{ message }}</p>
            </div>
            <div class="login-form-1">
                <form id="register-form" @submit.prevent="login"  class="text-left">
                    <div class="login-form-main-message"></div>
                    <div class="main-login-form">
                        <div class="login-group">
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="test@gmail.com"
                                    v-model="email" required
                                >
                                <div v-if="errors && errors.email">
                                    <small class="text-danger" v-for="error in errors.email">
                                        {{ error }}
                                    </small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Пароль</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="password"
                                       v-model="password" required
                                >
                                <div v-if="errors && errors.password">
                                    <small class="text-danger" v-for="error in errors.password">
                                        {{ error }}
                                    </small>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Войти</button>
                    </div>
                    <div class="etc-login-form">
                        <p><router-link :to="{ name: 'site.forgot-password' }">Забыли пароль?</router-link></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component Login mounted.')
        },
        data() {
            return {
                email: null,
                password: null,
                errors: null,
            }
        },
        methods: {
            login() {
                this.$auth.login({
                    params: {
                        email: this.email,
                        password: this.password
                    },
                    success: function () {},
                    error: function (error) {
                        this.message = error.response.data.message;
                        this.errors = error.response.data.errors;
                    },
                    rememberMe: true,
                    redirect: '/',
                    fetchUser: true,
                });
            }
        }
    }
</script>
