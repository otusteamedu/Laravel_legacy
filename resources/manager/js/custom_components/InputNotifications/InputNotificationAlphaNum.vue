<template>
    <slide-y-down-transition>
        <div class="text-danger">{{ $langLib({ field_name: name }).ALPHA_NUM }}</div>
    </slide-y-down-transition>
</template>

<script>
    export default {
        name: "InputNotificationAlphaNum",
        props: {
            name: {
                type: String,
                default: 'Поле'
            }
        }
    }
</script>
