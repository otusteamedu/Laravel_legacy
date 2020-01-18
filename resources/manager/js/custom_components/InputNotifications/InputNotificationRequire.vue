<template>
    <slide-y-down-transition>
        <div class="text-danger">{{ $langLib({ field_name: name }).REQUIRED }}</div>
    </slide-y-down-transition>
</template>

<script>
    export default {
        name: "InputNotificationRequire",
        props: {
            name: {
                type: String,
                default: 'Поле'
            }
        }
    }
</script>
