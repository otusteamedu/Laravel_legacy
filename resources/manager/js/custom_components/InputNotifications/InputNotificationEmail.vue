<template>
    <slide-y-down-transition>
        <div class="text-danger">{{ $langLib({ field_name: ''}).EMAIL }}</div>
    </slide-y-down-transition>
</template>

<script>
    export default {
        name: "InputNotificationEmail"
    }
</script>
