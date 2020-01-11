<template>
    <slide-y-down-transition>
        <div class="text-danger">{{ $langLib({ field_name: name }).NUM }}</div>
    </slide-y-down-transition>
</template>

<script>
    export default {
        name: "InputNotificationNum",
        props: {
            name: {
                type: String,
                default: 'Поле'
            }
        }
    }
</script>
