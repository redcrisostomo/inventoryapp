<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    links: Array
})
</script>
<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap -mb-1 float-right">
            <template v-for="(link, p) in links" :key="p">
                <div v-if="link.url === null" class="px-4 py-3 text-sm leading-4 text-gray-400 border"
                    v-html="link.label" />
                <Link v-else
                    class="px-4 py-3 text-sm leading-4 border hover:bg-white focus:border-indigo-500 focus:text-indigo-500"
                    :class="{ 'bg-blue-700 text-white': link.active }" :href="link.url" v-html="link.label" />
            </template>
        </div>
    </div>
</template>

