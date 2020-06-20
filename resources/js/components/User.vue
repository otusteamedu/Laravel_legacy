<template>
    <div>
        <div class='show-field'>
            <div class='show-field__name'>ID:</div>
            <div class='show-field__value'>{{ user.id }}</div>
        </div>
        <div class='show-field'>
            <div class='show-field__name'>{{ $t('user.name') }}:</div>
            <div class='show-field__value'>{{ user.name }}</div>
        </div>
        <div class='show-field'>
            <div class='show-field__name'>{{ $t('user.email') }}:</div>
            <div class='show-field__value'>{{ user.email }}</div>
        </div>
        <div class='show-field'>
            <div class='show-field__name'>{{ $t('user.address') }}:</div>
            <div class='show-field__value'>{{ user.address }}</div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'user',
    props: [
        'user'
    ]
}
</script>