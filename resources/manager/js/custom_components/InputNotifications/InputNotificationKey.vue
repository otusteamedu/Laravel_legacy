<template>
    <slide-y-down-transition>
        <div class="text-danger">{{ $langLib({ field_name: name }).SNAKE_CASE_ALPHA_EN }}</div>
    </slide-y-down-transition>
</template>

<script>
    export default {
        name: "InputNotificationKey",
        props: {
            name: {
                type: String,
                default: 'Поле'
            }
        }
    }
</script>
