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
    withIcon: {
        type: Boolean,
        default: false,
    },
    darktheme: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <Link
        :href="href"
        class="inline-flex items-center border rounded font-semibold uppercase text-xs  tracking-wider focus:outline-none focus:ring-1 focus:ring-offset-1 transition ease-in-out duration-150"
        :class="darktheme ? 'bg-gray-700 border-gray-500 text-white hover:bg-gray-500 focus:bg-gray-500 active:bg-gray-700 focus:ring-gray-700 py-2 px-2': 'bg-gray-100 border-gray-400 text-gray-600 hover:bg-gray-200 focus:bg-gray-200 active:bg-gray-300 focus:ring-gray-600 py-2 px-2'"
        title="Back"
    >
        <div class="space-x-1">
            <i v-if="withIcon" class="fa fa-arrow-left"></i>
            <span v-if="value">{{ value }}</span>
            <i class="fa fa-arrow-left" v-else-if="!withIcon"></i>
        </div>
    </Link>
</template>
