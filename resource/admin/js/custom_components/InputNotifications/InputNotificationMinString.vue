<template>
    <slide-y-down-transition>
        <div class="text-danger">{{ $langLib({ field_name: name, min }).MIN_STRING }}</div>
    </slide-y-down-transition>
</template>

<script>
    export default {
        name: "InputNotificationMinString",
        props: {
            name: {
                type: String,
                default: 'Поле'
            },
            min: {
                type: Number,
                default: 2
            }
        }
    }
</script>
