<template>
    <slide-y-down-transition>
        <div class="text-danger">{{ $langLib({ field_name: name }).UNIQUE }}</div>
    </slide-y-down-transition>
</template>

<script>
    export default {
        name: "InputNotificationUnique",
        props: {
            name: {
                type: String,
                default: 'Поле'
            }
        }
    }
</script>
