<template>
    <div class='form-page-wrapper'>
        <div class='form-container'>
            <input class='form-container__input' v-model='login' :placeholder='$t("login.login")'>
            <input class='form-container__input' v-model='password' :placeholder='$t("login.password")' type='password'>
            <div class='form-container__error'>
                {{ $t('login.wrong_login_or_password') }}
            </div>
            <div class='button'>{{ $t('login.enter') }}</div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'login',
    data() {
        return {
            login: '',
            password: ''
        };
    }
}
</script>