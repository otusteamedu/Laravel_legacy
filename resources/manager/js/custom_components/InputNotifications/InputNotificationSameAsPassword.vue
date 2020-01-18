<template>
    <slide-y-down-transition>
        <div class="text-danger">{{ $langLib({ field_name: '' }).SAME_AS_PASSWORD }}</div>
    </slide-y-down-transition>
</template>

<script>
    export default {
        name: "InputNotificationSameAsPassword",
    }
</script>
