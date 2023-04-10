<script setup>
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
const props = defineProps({
    routeName: String,
});

const isActive = route().current(props.routeName);
</script>
<template>
    <ResponsiveNavLink :href="route(props.routeName)" :active="isActive" preserve-state >
        <slot />
    </ResponsiveNavLink>
</template>
