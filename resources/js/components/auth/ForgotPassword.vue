<template>
    <div class="container">
        <div class="text-center" style="padding:50px 0">
            <div class="logo">Забыли пароль?</div>
            <div class="login-form-1">
                <form id="forgot-password-form" class="text-left">
                    <div class="etc-login-form">
                        <p>Введите Ваш email</p>
                    </div>
                    <div class="login-form-main-message"></div>
                    <div class="main-login-form">
                        <div class="login-group">
                            <div class="form-group">
                                <label for="fp_email" class="sr-only">Email</label>
                                <input type="text" class="form-control" id="fp_email" name="fp_email" placeholder="email address">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Сбросить пароль</button>
                    </div>
                    <div class="etc-login-form">
                        <p>Хотите зарегистрироваться! <router-link :to="{ name: 'registration' }">Вам сюда!</router-link></p>
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
