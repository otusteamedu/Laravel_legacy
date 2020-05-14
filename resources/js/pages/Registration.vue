<template>
    <div class='form-page-wrapper'>
        <div class='form-container'>
            <input class='form-container__input' v-model='login' :placeholder='$t("registration.login")'>
            <div class='form-container__error'>Error</div>
            <input class='form-container__input' v-model='email' :placeholder='$t("registration.email")' type='email'>
            <div class='form-container__error'>Error</div>
            <input class='form-container__input' v-model='first_password' :placeholder='$t("registration.password")' type='password'>
            <input class='form-container__input' v-model='second_password' :placeholder='$t("registration.second_password")' type='password'>
            <div class='form-container__error'>Error</div>
            <div class='button'>{{ $t('registration.registration') }}</div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'registration',
    data() {
        return {
            login: '',
            email: '',
            first_password: '',
            second_password: ''
        };
    }
}
</script>