<script setup>
    defineProps({
        message: {
            type: Array,
        },
    });
</script>

<template>
    <div v-show="message">
        <p class="small text-danger">
            {{ message }}
        </p>
    </div>
</template>
