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
                                <label for="reg_username" class="sr-only">Имя пользователя или email</label>
                                <input type="text" class="form-control" id="reg_username" name="reg_username" placeholder="username">
                            </div>
                            <div class="form-group">
                                <label for="reg_password" class="sr-only">Пароль</label>
                                <input type="password" class="form-control" id="reg_password" name="reg_password" placeholder="password">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Войти</button>
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
