<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
    href: {
        type: String,
        default: 'javascript: void(0);',
    },
    value: {
        type: String,
        default: "",
    },
});
</script>

<template>
    <Link
        :href="href"
        class="inline-flex items-center bg-indigo-100 border border-indigo-700 rounded font-semibold text-xs uppercase text-indigo-700 tracking-widest hover:bg-indigo-200 focus:bg-indigo-200 active:bg-indigo-300 focus:outline-none focus:ring-1 focus:ring-indigo-700 focus:ring-offset-1 transition ease-in-out duration-150"
        :class="'py-2 px-2'"
        title="Edit Record"
    >
        <span v-if="value">{{ value }}</span>
        <i class="fa fa-pencil" v-else></i>
    </Link>
</template>
