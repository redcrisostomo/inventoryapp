<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() =>
    props.active
        ? 'block w-full pl-3 pr-4 py-2 border-r-4 border-indigo-400 text-left text-base text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out'
        : 'block w-full pl-3 pr-4 py-2 border-r-4 border-transparent text-left text-base text-gray-600 hover:text-indigo-700 hover:border-indigo-200 focus:outline-none focus:text-indigo-700 focus:bg-gray-50 focus:border-indigo-200 transition duration-150 ease-in-out'
);
</script>

<template>
    <Link :href="href" class="text-sm" :class="classes">
        <slot />
    </Link>
</template>
