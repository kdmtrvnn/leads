<script setup>
    defineProps({
        value: {
            type: String,
        },
    });
</script>

<template>
    <label class="small text-muted">
        <span v-if="value">{{ value }}</span>
        <span v-else>
            <slot />
        </span>
    </label>
</template>
