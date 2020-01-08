<template>
    <div class="container">
        <div class="text-center" style="padding:50px 0">
            <div class="logo">Сделай бизнес проще!</div>
            <div class="alert alert-danger" v-if="errors && !success">
                <p>Ошибка! Не удалось зарегистрироваться!</p>
                <p>{{ message }}</p>
            </div>
            <div class="alert alert-success" v-if="success">
                <p>Вы успешно зарегистрировались. <router-link :to="{name:'site.login'}">Войти</router-link></p>
            </div>
            <div class="login-form-1" v-if="!success">
                <form id="register-form" class="text-left" @submit.prevent="register">
                    <div class="login-form-main-message"></div>
                    <div class="main-register-form">
                        <div class="register-group">
                            <div class="form-group">
                                <label for="email">Email</label>
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
                                <label for="password">Пароль</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="password"
                                    v-model="password" required
                                >
                                <div v-if="errors && errors.password">
                                    <small class="text-danger" v-for="error in errors.password">
                                        {{ error }}
                                    </small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirm">Подтвержение пароля</label>
                                <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="confirm password"
                                    v-model="password_confirm" required
                                >
                                <div v-if="errors && errors.password_confirm">
                                    <small class="text-danger" v-for="error in errors.password_confirm">
                                        {{ error }}
                                    </small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Название организации</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="ИП Ковалев А.А."
                                    v-model="name" required
                                >
                                <div v-if="errors && errors.name">
                                    <small class="text-danger" v-for="error in errors.name">
                                        {{ error }}
                                    </small>
                                </div>
                            </div>
                            <div class="form-group login-group-checkbox">
                                <input type="radio" name="role_id" id="private_entrepreneur"  value="1"
                                    v-model="role_id"
                                >
                                <label for="private_entrepreneur">Частный предприниматель</label>
                                <input type="radio" name="role_id" id="wholesaler" value="2"
                                       v-model="role_id"
                                >
                                <label for="wholesaler">Оптовый поставщик</label>
                                <div v-if="errors && errors.role_id">
                                    <small class="text-danger" v-for="error in errors.role_id">
                                        {{ error }}
                                    </small>
                                </div>
                            </div>

                            <div class="form-group login-group-checkbox">
                                <input type="checkbox" class="" id="terms_agree" name="terms_agree"
                                    v-model="terms_agree" required
                                >
                                <label for="terms_agree">Согласие с <router-link :to="{ name: 'site.terms' }">правилами пользования сервисом</router-link></label>
                                <div v-if="errors && errors.terms_agree">
                                    <small class="text-danger" v-for="error in errors.terms_agree">
                                        {{ error }}
                                    </small>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                    </div>
                    <div class="etc-login-form">
                        <p>Уже зарегистрированы? <router-link :to="{ name: 'site.login' }">Войдите!</router-link></p>
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
            console.log('Component Registration mounted.')
        },
        data() {
            return {
                email: null,
                password: null,
                password_confirm: null,
                name: null,
                role_id: null,
                terms_agree: null,
                errors: null,
                success: false,
                message: null,
            }
        },
        methods: {
            register() {
                this.$auth.register({
                    params: {
                        email: this.email,
                        password: this.password,
                        password_confirm: this.password_confirm,
                        name: this.name,
                        role_id: this.role_id,
                        terms_agree: this.terms_agree,
                    },
                    success: function () {
                        this.success = true;
                    },
                    error: function (error) {
                        this.message = error.response.data.message;
                        this.errors = error.response.data.errors;
                    },
                    rememberMe: true,
                    redirect: false,
                    fetchUser: true,
                });
            }
        }
    }
</script>
