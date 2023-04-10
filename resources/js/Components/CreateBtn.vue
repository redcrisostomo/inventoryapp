<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
    href: {
        type: String,
        default: 'javascript: void(0);',
    },
    value: {
        type: String,
        default: 'Create Record'
    }
});
</script>

<template>
    <Link
        :href="href"
        class="inline-flex items-center px-4 py-2 bg-indigo-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
        title="Create new record"
    >
        {{ value }}
    </Link>
</template>
