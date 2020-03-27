<template>
    <slide-y-down-transition>
        <div class="text-danger">{{ $langLib({ field_name: name }).KEBAB_CASE_ALPHA_EN }}</div>
    </slide-y-down-transition>
</template>

<script>
    export default {
        name: "InputNotificationAlias",
        props: {
            name: {
                type: String,
                default: 'Поле'
            }
        }
    }
</script>
