<template>
    <div class="container">
        <div class="text-center" style="padding:50px 0">
            <div class="logo">Сделай бизнес проще!</div>
            <div class="login-form-1">
                <form id="register-form" class="text-left">
                    <div class="login-form-main-message"></div>
                    <div class="main-login-form">
                        <div class="login-group">
                            <div class="form-group">
                                <label for="reg_username" class="sr-only">Имя пользователя</label>
                                <input type="text" class="form-control" id="reg_username" name="reg_username" placeholder="username">
                            </div>
                            <div class="form-group">
                                <label for="reg_password" class="sr-only">Пароль</label>
                                <input type="password" class="form-control" id="reg_password" name="reg_password" placeholder="password">
                            </div>
                            <div class="form-group">
                                <label for="reg_password_confirm" class="sr-only">Подтвержение пароля</label>
                                <input type="password" class="form-control" id="reg_password_confirm" name="reg_password_confirm" placeholder="confirm password">
                            </div>

                            <div class="form-group">
                                <label for="reg_email" class="sr-only">Email</label>
                                <input type="text" class="form-control" id="reg_email" name="reg_email" placeholder="email">
                            </div>
                            <div class="form-group">
                                <label for="reg_fullname" class="sr-only">Полное имя</label>
                                <input type="text" class="form-control" id="reg_fullname" name="reg_fullname" placeholder="full name">
                            </div>

                            <div class="form-group login-group-checkbox">
                                <input type="radio" class="" name="reg_gender" id="male" placeholder="username">
                                <label for="male">Частный предприниматель</label>

                                <input type="radio" class="" name="reg_gender" id="female" placeholder="username">
                                <label for="female">Оптовый поставщик</label>
                            </div>

                            <div class="form-group login-group-checkbox">
                                <input type="checkbox" class="" id="reg_agree" name="reg_agree">
                                <label for="reg_agree">Согласие с <router-link :to="{ name: 'terms' }">правилами пользования сервисом</router-link></label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                    </div>
                    <div class="etc-login-form">
                        <p>Уже зарегистрированы? <router-link :to="{ name: 'login' }">Войдите!</router-link></p>
                    </div>
                    <div class="etc-login-form">
                        <p><router-link :to="{ name: 'forgot-password' }">Забыли пароль?</router-link></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
